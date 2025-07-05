<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccreditationController extends Controller
{
    /**
     * Display a list of pending accreditation requests
     */
    public function index()
    {
        $pendingRequests = UserData::where('status', 'pending')
            ->with('user')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('admin.accreditation.index', [
            'active' => 'accreditation.pending',
            'requests' => $pendingRequests
        ]);
    }

    /**
     * Display accreditation history (approved and rejected)
     */
    public function history()
    {
        $history = UserData::whereIn('status', ['approved', 'rejected'])
            ->with('user')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('admin.accreditation.history', [
            'active' => 'accreditation.history',
            'requests' => $history
        ]);
    }

    /**
     * Show the accreditation request details for review
     */
    public function review($id)
    {
        $userData = UserData::with('user')->findOrFail($id);

        return view('admin.accreditation.review', [
            'active' => 'accreditation.pending',
            'userData' => $userData
        ]);
    }

    /**
     * Approve an accreditation request
     */
    public function approve($id)
    {
        $userData = UserData::findOrFail($id);
        $userData->status = 'approved';
        $userData->save();

        return redirect()->route('admin.accreditation.index')
            ->with('success', 'User accreditation has been approved.');
    }

    /**
     * Reject an accreditation request
     */
    public function reject(Request $request, $id)
    {
        $userData = UserData::findOrFail($id);
        $userData->status = 'rejected';
        $userData->rejection_reason = $request->reason;
        $userData->save();

        return redirect()->route('admin.accreditation.index')
            ->with('success', 'User accreditation has been rejected.');
    }
}
