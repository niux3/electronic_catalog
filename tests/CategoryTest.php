<?php
    class CategoryTest extends TestCase{
        public function testShouldReturnAllCategories()
        {
            $this->get("categories", []);
            $this->seeStatusCode(200);
            $this->seeJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                ]
            ]);
        }
    }
