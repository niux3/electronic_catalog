<?php
    use App\Models\Product;

    class ProductTest extends TestCase{
        public function testShouldReturnAllProducts()
        {
            $this->get("products", []);
            $this->seeStatusCode(200);
            $this->seeJsonStructure([
                '*' => [
                    'name',
                    'sku',
                    'category',
                    'id',
                    'quantity',
                    'price',
                    'created_at',
                    'updated_at'
                ]
            ]);
        }


        public function testShouldReturnProduct()
        {
            $this->get("products/1", []);
            $this->seeStatusCode(200);
            $this->seeJsonStructure([
                '*' => [
                    'name',
                    'sku',
                    'category',
                    'id',
                    'quantity',
                    'price',
                    'created_at',
                    'updated_at'
                ]
            ]);

        }


        public function testShouldCreateProduct()
        {
            $sku = "A";
            for($i = 0, $len = 4; $i < $len; $i++){
                $sku .= mt_rand(1,9);
            }
            $parameters = [
                'name' => "quelque chose",
                'sku' => $sku,
                'category' => 1,
                'quantity' => 99,
                'price' => 99.99
            ];

            $response = $this->post("products", $parameters, []);
            $response->seeStatusCode(200);
            $this->seeJsonStructure([
                'name',
                'sku',
                'price',
                'quantity',
                'category_id',
                'updated_at',
                'created_at',
                'id'
            ]);
        }


        public function testShouldUpdateProduct()
        {
            $sku = "A";
            for($i = 0, $len = 4; $i < $len; $i++){
                $sku .= mt_rand(1,9);
            }
            $parameters = [
                'name' => "quelque chose",
                'sku' => $sku,
                'category' => 1,
                'quantity' => 99,
                'price' => 99.99
            ];
            $response = $this->put("products/2", $parameters, []);
            $response->seeStatusCode(200);
            $this->seeJsonStructure([
                'name',
                'sku',
                'price',
                'quantity',
                'category_id',
                'updated_at',
                'created_at',
                'id'
            ]);
        }


        public function testShouldDeleteProduct()
        {
            $row = current(Product::orderBy('id', 'desc')->limit(1)->get()->toArray());
            $this->delete(sprintf("products/%s", $row['id']), [], []);
            $this->seeStatusCode(200);
        }

    }
