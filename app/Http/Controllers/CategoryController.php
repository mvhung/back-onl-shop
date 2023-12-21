<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\UserIdentity;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $title = [];
        $data = Category::all();
        foreach ($data as $category) {
            $title[] = $category->title;
        }
        return response()->json($title);
    }
}
