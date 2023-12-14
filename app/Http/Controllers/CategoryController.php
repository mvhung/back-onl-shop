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
        $data = Category::query()->paginate(10, ['*'], 'page', $request->page ?? 0);
        return response()->json($data);
    }
}
