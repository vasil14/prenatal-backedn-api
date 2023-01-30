<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(1)->create();

        $xml = simplexml_load_file('https://static.prenatal-services.com/rss-feed/prenatal-it/dentsu-feed.xml', 'SimpleXMLElement', LIBXML_NOCDATA);

        $products = $xml->channel->item;

        foreach ($products as $k => $v) {

            $product = Product::create([
                'id' => $v->id,
                'mpn' => (int)$v->mpn,
                'price' => (float)$v->price,
                'sale_price' => (float)$v->sale_price,
                'vip_price' => (float)$v->vip_price,
                'stock' => (int)$v->stock,
                'availability' => $v->availability,
                'taglia' => $v->taglia,
                'parent_id' => ($v->price == 0) ? 0 : $v->parent_id,
                'title' => $v->title,
                'description' => $v->description,
                'link' => $v->link,
                'image_link' => $v->image_link,
                'product_type' => $v->product_type,
                'eta' => (int)$v->eta,
                'marche' => $v->marche,
                'genere' => $v->genere,
                'personaggi' => $v->personaggi,
                'colore' => $v->colore
            ]);

            $categories = $v->categories;
            foreach ($categories as $category) {
                foreach ($category as $k1 => $v1) {
                    foreach ($v1 as $k2 => $v2) {
                        if ($k2 == 'category1') {
                            $category = Category::updateOrCreate([
                                '_id' => $v2->id,
                                'name' => $v2->name,
                                'parent_id' => null
                            ]);
                        } elseif ($k2 == 'category2') {
                            $category = Category::updateOrCreate([
                                '_id' => $v2->id,
                                'name' => $v2->name,
                                'parent_id' => $v1->category1->id
                            ]);
                        } elseif ($k2 == 'category3') {
                            $category = Category::updateOrCreate([
                                '_id' => $v2->id,
                                'name' => $v2->name,
                                'parent_id' => $v1->category2->id
                            ]);
                        } elseif ($k2 == 'category4') {
                            $category = Category::updateOrCreate([
                                '_id' => $v2->id,
                                'name' => $v2->name,
                                'parent_id' => $v1->category3->id
                            ]);
                        }


                        $product->categories()->attach($category->id);
                    }
                }
            }


            $gallery = $v->gallery;

            foreach ($gallery as $images) {
                foreach ($images as $k => $v) {
                    $image = Gallery::create([
                        'link' => $v,
                        'product_id' => $product->id
                    ]);
                }
            }
        }




        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
