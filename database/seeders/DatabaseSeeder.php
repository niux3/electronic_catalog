<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \App\Models\Category;
use \App\Models\Product;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents('./mock.json'));
        foreach($data as $k => $rows){
            if($k === 'products'){
                foreach($rows as $row){
                    $post_row = Category::where('name', $row->category)->select('id', 'name')->get();
                    if(count($post_row) === 0){
                        $post_row = new Category();
                        $post_row->name = $row->category;
                        $post_row->save();
                        $id_cat = $post_row->id;
                    }else{
                        $id_cat = $post_row[0]->id;
                    }

                    $product = new Product();
                    $product->name = $row->name;
                    $product->sku = $row->sku;
                    $product->price = $row->price;
                    $product->quantity = $row->quantity;
                    $product->category_id = $id_cat;
                    $product->save();
                }
            }

            if($k === 'users'){
                foreach($rows as $row){
                    $user = new User();
                    $user->name = $row->name;
                    $user->email = $row->email;
                    $user->save();
                }
            }
        }
    }
}
