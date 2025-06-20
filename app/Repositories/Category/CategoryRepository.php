<?php

namespace App\Repositories\Category;

use App\Abstracts\BaseCrudRepository;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
class CategoryRepository extends BaseCrudRepository implements CategoryRepositoryInterface
{
    /**
     * The fields that should be filtered.
     * 
     * @var array
     */
    protected array $filterable = [
        'name',
        'slug',
    ];

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Get the categories with sub categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSubCategories(string $slug): Collection
    {
        return $this->model->where('slug', $slug)->with('subCategories')->get();
    }

    /**
     * Get primary categories.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPrimaryCategories(): Collection
    {
        return $this->model->whereNull('parent_id')->select('id', 'name', 'slug', 'icon', 'image')->get();
    }

    /**
     * Find a category by slug.
     * 
     * @param string $slug
     * @return \App\Models\Category
     */
    public function findBySlug(string $slug): Category
    {
        return $this->findBy('slug', $slug, function () {
            throw new \Exception('Category not found.');
        });
    }

     /**
     * Get users for admin
     * 
     * @param int $limit
     * @param array $filters
     * @return \App\Models\Category
     */
    public function getCategoriesForAdmin(int $limit = 10, array $filters = []): LengthAwarePaginator
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
    public function getCategoryForAdmin(string $id): \App\Models\Category
    {
        return $this->model->query()->where('id', $id)->firstOr(function () {
            throw new \Exception('Category not found.');
        });
    }

    /**
     * Get user for profile
     * 
     * @param array $data
     * @return void
     */
    public function createCategory($data): void
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
    public function updateCategory(string $id, array $data): void
    {
        $category = $this->model->query()->where('id', $id)->firstOr(function () {
            throw new \Exception('Category not found.');
        });

        $category->update([
            'name' => $data['first_name'],
            
        ]);
    }

    /**
     * Delete a user
     * 
     * @param string $id
     * @return void
     */
    public function deleteCategory(string $id): void
    {
        $this->model->query()->where('id', $id)->delete();
    }

}