<?php

namespace App\Repositories\AuctionType;

use App\Abstracts\BaseCrudRepository;
use App\Models\AuctionType;
use App\Contracts\Repositories\AuctionTypeRepositoryInterface;
use App\Exceptions\AuctionTypeException;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuctionTypeRepository extends BaseCrudRepository implements AuctionTypeRepositoryInterface
{
    public function __construct(AuctionType $model)
    {
        parent::__construct($model);
    }

    /**
     * Get users for admin
     * 
     * @param int $limit
     * @param array $filters
     * @return \App\Models\AuctionType
     */
    public function getAuctionTypesForAdmin(int $limit = 10, array $filters = []): LengthAwarePaginator
    {
        return $this->model->query()->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * Get user for admin
     * 
     * @param string $id
     * @return \App\Models\User
     */
    public function getAuctionTypeForAdmin(string $id): \App\Models\AuctionType
    {
        return $this->model->query()->where('id', $id)->firstOr(function () {
            throw new AuctionTypeException('Auction Type not found.');
        });
    }

    /**
     * Get user for profile
     * 
     * @param array $data
     * @return void
     */
    public function createAuctionType($data): void
    {
       
        $this->model->query()->create([
            'name' => $data['name'],
            
        ]);
    }

    
    /**
     * 
     * Update user
     * 
     * @param string $id
     * @param array $data
     * @return void
     */
    public function updateAuctionType(string $id, array $data): void
    {
        $auctiontype = $this->model->query()->where('id', $id)->firstOr(function () {
            throw new AuctionTypeException('Auction Type not found.');
        });

        $auctiontype->update([
            'name' => $data['first_name'],
            
        ]);
    }

    /**
     * Delete a user
     * 
     * @param string $id
     * @return void
     */
    public function deleteAuctionType(string $id): void
    {
        $this->model->query()->where('id', $id)->delete();
    }
}
