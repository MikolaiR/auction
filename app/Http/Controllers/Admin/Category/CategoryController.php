<?php

namespace App\Http\Controllers\Admin\Category;
use App\Contracts\Repositories\CategoryRepositoryInterface;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateAdminCategoryRequest;
use App\Http\Requests\Category\FilterAdminCategoryRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
     /**
     * Instantiate new controller instance
     */
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {}

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterAdminCategoryRequest $query): View
    {
        
        return view('category.admin.index', [
            'auctiontypes' => $this->categoryRepository->getCategoriesForAdmin(10, $query->validated()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\User\CreateAdminCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAdminCategoryRequest $request)
    {
        $this->categoryRepository->createCategory($request->validated());

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
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
