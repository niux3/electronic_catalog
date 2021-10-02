<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class CategoriesController extends Controller
{

    public function index()
    {
        Log::info(sprintf("display categories by : %s", request()->ip()));
        return response()->json(Category::get());
    }

}
