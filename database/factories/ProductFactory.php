<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    use FileUploadTrait;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private $imageStoringPath = 'uploads/image/product/';
    public function definition(): array
    {
        File::cleanDirectory(public_path($this->imageStoringPath));

        return [
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'thumbnail_path' => 'soon to be changed',
            'description' => fake()->paragraph(),
            'qty'  => fake()->numberBetween(5, 15),
            'price' => fake()->randomFloat(2, 20, 100),
            'discounted_price' => fake()->randomFloat(2, 5, 50),
            'category_id' => Category::inRandomOrder()->first(),
            'is_visible' => fake()->boolean(),
        ];
    }

    function getRandomImagesFromFolder($count)
    {
        $imageFolder = public_path('factory/image/product/');
        $images = glob($imageFolder . '/*.{jpg,png,gif}', GLOB_BRACE);

        return array_slice($images, 0, $count);
    }

    public function withRandomThumbnail()
    {
        return $this->afterCreating(function (Product $product) {

            $imagePath = $this->getRandomImagesFromFolder(1)[0];

            $imageName = Str::random(10) . '.' . pathinfo($imagePath, PATHINFO_EXTENSION);
            $destinationPath = public_path($this->imageStoringPath . $imageName);

            File::ensureDirectoryExists(public_path($this->imageStoringPath));

            copy($imagePath, $destinationPath);

            $path = $this->imageStoringPath . $imageName;

            $product->update([
                'thumbnail_path' => $path
            ]);
        });
    }
    public function withRandomGallerys()
    {
        return $this->afterCreating(function (Product $product) {

            $imagePaths = $this->getRandomImagesFromFolder(5);

            foreach ($imagePaths as $imagePath) {

                $imageName = Str::random(10) . '.' . pathinfo($imagePath, PATHINFO_EXTENSION);
                $destinationPath = public_path($this->imageStoringPath . $imageName);

                File::ensureDirectoryExists(public_path($this->imageStoringPath));

                // Copy the file to the destination directory error need to debug
                copy($imagePath, $destinationPath);

                $path = $this->imageStoringPath . $imageName;

                $product->galleries()->create([
                    "path" => $path,
                ]);
            }
        });
    }
}
