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
            'name' => fake()->words(5, true),
            'slug' => fake()->slug(),
            'thumbnail_path' => 'soon to be changed',
            'description' => fake()->paragraph(),
            'qty'  => fake()->numberBetween(5, 15),
            'price' => fake()->randomFloat(2, 20, 100),
            'group' => fake()->randomElement(['man', 'women']),
            'discounted_price' =>  fake()->boolean(40) ?  fake()->randomFloat(2, 5, 50) : NULL ,
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

            $imagePath = $this->getRandomImagesFromFolder(100)[rand(1,10)];

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


    public function withSizes() {
        return $this->afterCreating(function (Product $product){

          $sizes =  ['S', 'M', 'L', 'XL', 'XXL'];

            foreach ($sizes as $key => $size) {
                $product->sizes()->create([
                    "name" => $size,
                    "slug" => Str::slug($size),
                ]);
            }
        });
    }

    public function withDetails(){

        return $this->afterCreating(function (Product $product){
            $product->details()->create([
                'data' => '<p> </p><h4>Details :<br></h4><p>Spice up your style with the Alisa Maxi Dress! Flaunting a sweetheart 
                            neckline, thin adjustable shoulder straps and a tiered skirt, this dress
                             turns heads with its bold feminine flair and curve-loving design.<br>
                            <br>
                            Key Features Include:<br>
                            - Sweetheart neckline <br>
                            - Thin adjustable shoulder straps<br>
                            -Ruched drawcord tie front detail<br>
                            - Shirred bodice with frilled edge<br>
                            - Tiered skirt<br>
                            - Fully lined<br>
                            - Maxi length<br>
                            <br>
                            Complement with neutral-toned strappy heels.<br><br></p><h4>Fabric : </h4><h4><br><strong>Content</strong> </h4><div class="content">Main: 80% Viscose, 20% Nylon
                            Lining: 100% Viscose</div><br>  <strong> Care</strong> <div class="care">Cold machine wash • Do not bleach • Do not tumble dry • Cool iron •  Do not dry clean</div>'
            ]);
        });
        
    }
}
