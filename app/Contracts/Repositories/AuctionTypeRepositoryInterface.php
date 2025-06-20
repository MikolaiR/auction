<?php

namespace App\Contracts\Repositories;

interface AuctionTypeRepositoryInterface
{
    /**
     * Get users for admin
     * 
     * @param int $limit
     * @param array $filters
     * @return \App\Models\AuctionType
     */
    public function getAuctionTypesForAdmin(int $limit = 10, array $filters = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    /**
     * Get user for admin
     * 
     * @param string $id
     * @return \App\Models\User
     */
    public function getAuctionTypeForAdmin(string $id): \App\Models\AuctionType;

    /**
     * Delete a user
     * 
     * @param string $id
     * @return void
     */
    public function deleteAuctionType(string $id): void;

    /**
     * Send password reset link
     * 
     * @param string $id
     */
    public function createAuctionType($data): void;

    /**
     * Update user
     * 
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateAuctionType(string $id, array $data): void;
}
