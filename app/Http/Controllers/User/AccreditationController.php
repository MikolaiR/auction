<?php

namespace App\Http\Controllers\User;

use App\Enums\TypeOwners;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AccreditationRequest;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccreditationController extends Controller
{
    /**
     * Show the accreditation form.
     */
    public function showForm()
    {
        $user = Auth::user();
        $userData = UserData::where('user_id', $user->id)->first();
        $ownerTypes = TypeOwners::cases();
        
        // Get regions for the dropdown
        $regions = \App\Models\Region::all();
        
        return view('user.accreditation.form', compact('userData', 'ownerTypes', 'regions'));
    }
    
    /**
     * Process the accreditation form submission.
     */
    public function submitForm(AccreditationRequest $request)
    {
        $user = Auth::user();
        $userData = UserData::where('user_id', $user->id)->first();
        
        // Process full name into name components
        $fio = $request['fio'] ?? '';
        $nameParts = explode(' ', trim($fio));
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';
        $middleName = $nameParts[2] ?? '';
        
        // Update user data with accreditation information
        $userData->update([
            'type_owner' => TypeOwners::cases()[(int)$request['type_owner']],
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'region' => $request['region'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'passport_series' => $request['passport_series'] ?? null,
            'passport_number' => $request['passport_number'] ?? null,
            'passport_issued_by' => $request['passport_issued_by'] ?? null,
            'passport_issued_date' => $request['passport_issued_date'] ?? null,
            'unp' => $request['unp'] ?? null,
            'company_name' => $request['company_name'] ?? null,
            'info' => $request['info'] ?? null,
            'status' => 'pending', // Add status field to UserData
        ]);
        
        // Handle file uploads
        if ($request->hasFile('documents')) {
            $uploadedFiles = [];
            
            foreach ($request->file('documents') as $file) {
                $path = $file->store('user_documents/' . $user->id, 'public');
                $uploadedFiles[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ];
            }
            
            // Store document information in user_data (we'll need to create documents column)
            $userData->documents = json_encode($uploadedFiles);
            $userData->save();
        }
        
        // Redirect with success message
        return redirect()->route('user.profile')->with('success', 'Accreditation information submitted successfully. It will be reviewed by an administrator.');
    }
}
