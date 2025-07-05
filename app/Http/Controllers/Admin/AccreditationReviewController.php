<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserData;
use App\Notifications\User\AccreditationRejectedNotification;
use App\Notifications\User\AccreditationApprovedNotification;
use Illuminate\Http\Request;

class AccreditationReviewController extends Controller
{
    /**
     * Display a listing of pending accreditation requests.
     */
    public function index()
    {
        $pendingRequests = UserData::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);
            
        return view('admin.accreditation.index', compact('pendingRequests'));
    }
    
    /**
     * Display a listing of approved and rejected accreditation requests.
     */
    public function history()
    {
        $processedRequests = UserData::with('user')
            ->whereIn('status', ['approved', 'rejected'])
            ->latest()
            ->paginate(15);
            
        return view('admin.accreditation.history', compact('processedRequests'));
    }
    
    /**
     * Show accreditation details for review.
     */
    public function show($id)
    {
        $userData = UserData::with('user')->findOrFail($id);
        
        return view('admin.accreditation.review', compact('userData'));
    }
    
    /**
     * Approve an accreditation request.
     */
    public function approve(Request $request, $id)
    {
        $userData = UserData::with('user')->findOrFail($id);
        $userData->status = 'approved';
        $userData->admin_comment = $request->comment;
        $userData->save();
        
        // Notify user about approval
        $userData->user->notify(new AccreditationApprovedNotification($userData->user));
        
        return redirect()->route('admin.accreditation.index')
            ->with('success', 'Accreditation for ' . $userData->user->name . ' has been approved.');
    }
    
    /**
     * Reject an accreditation request.
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|min:10'
        ], [
            'comment.required' => 'You must provide a reason for rejection',
            'comment.min' => 'Please provide a more detailed explanation for the rejection'
        ]);
        
        $userData = UserData::with('user')->findOrFail($id);
        $userData->status = 'rejected';
        $userData->admin_comment = $request->comment;
        $userData->save();
        
        // Notify user about rejection
        $userData->user->notify(new AccreditationRejectedNotification($userData->user));
        
        return redirect()->route('admin.accreditation.index')
            ->with('success', 'Accreditation for ' . $userData->user->name . ' has been rejected.');
    }
}
