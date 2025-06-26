<?php

namespace Database\Factories;

use App\Enums\MediaType;
use App\Enums\StorageDiskType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = rand(21, 23);
        return [
            'name' => $this->faker->name,
            'type' => MediaType::IMAGE,
            'path' => 'assets/images/blog/recent'.$randomNumber.'.png',
            'url' => 'https://mylot.by/assets/images/blog/recent'.$randomNumber.'.png',
            'extension' => 'png',
            'mime_type' => 'image/png',
            'size' => $this->faker->numberBetween(1024, 3072),
            'storage' => StorageDiskType::LOCAL,
            'is_featured' => false,
        ];
    }
}
