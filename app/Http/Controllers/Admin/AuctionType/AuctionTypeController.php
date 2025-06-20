<?php

namespace App\Http\Controllers\Admin\AuctionType;
use App\Contracts\Repositories\AuctionTypeRepositoryInterface;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuctionType\CreateAdminAuctionTypeRequest;
use App\Http\Requests\AuctionType\FilterAdminAuctionTypeRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AuctionTypeController extends Controller
{
     /**
     * Instantiate new controller instance
     */
    public function __construct(protected AuctionTypeRepositoryInterface $auctiontypeRepository)
    {}

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterAdminAuctionTypeRequest $query): View
    {
        
        return view('auctiontype.admin.index', [
            'auctiontypes' => $this->auctiontypeRepository->getAuctionTypesForAdmin(10, $query->validated()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auctiontype.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\User\CreateAdminAuctionTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAdminAuctionTypeRequest $request)
    {
        $this->auctiontypeRepository->createAuctionType($request->validated());

        return redirect()->route('admin.auctiontype.index')->with('success', 'Auction Type created successfully');
    }

    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): View
    {
        return view('users.admin.show', [
            'user' => $this->userRepository->getUserForAdmin($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id): View
    {
        return view('auctiontype.admin.edit', [
            'auctiontype' => $this->auctiontypeRepository->getAuctionTypeForAdmin($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\User\UpdateAdminUserRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAdminUserRequest $request, string $id)
    {
        $this->userRepository->updateUser($id, $request->validated());

        return redirect()->route('admin.users.edit', $id)->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->userRepository->deleteUser($id);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    /**
     * Request password reset.
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestPasswordReset(string $id): RedirectResponse
    {
        $this->userRepository->sendPasswordResetLink($id);

        return redirect()->route('admin.users.edit', $id)->with('success', 'Password reset link sent to user');
    }
}
