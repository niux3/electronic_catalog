<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\Validator;
    use App\Models\Category;

    class ValidatorServiceProvider extends ServiceProvider{
        public function boot()
        {
            Validator::extend('check_category_exist', function($attr, $value, $params){
                return !is_null(Category::find($value));
            });
        }


        public function register()
        {
            //
        }
    }
