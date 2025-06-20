<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    /**
     * Get the categories with sub categories.
     * 
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSubCategories(string $slug): Collection;

    /**
     * Get primary categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPrimaryCategories(): Collection;

    /**
     * Get users for admin
     * 
     * @param int $limit
     * @param array $filters
     * @return \App\Models\AuctionType
     */
    public function getCategoriesForAdmin(int $limit = 10, array $filters = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Get user for admin
     * 
     * @param string $id
     * @return \App\Models\User
     */
    public function getCategoryForAdmin(string $id): \App\Models\Category;

    /**
     * Delete a user
     * 
     * @param string $id
     * @return void
     */
    public function deleteCategory(string $id): void;

    /**
     * Send password reset link
     * 
     * @param string $id
     */
    public function createCategory($data): void;

    /**
     * Update user
     * 
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateCategory(string $id, array $data): void;
}