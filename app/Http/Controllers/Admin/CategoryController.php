<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\AddCategoryRequest;
use App\Http\Requests\Admin\Category\ChangeCategoryStatusRequest;
use App\Http\Requests\Admin\Category\DeleteCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\Admin\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct(protected CategoryRepository $categoryRepository) {}
    public function index() : View
    {
        $categories = Category::orderBy('priority')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function resort(Request $request) : JsonResponse
    {
        return $this->categoryRepository->resort($request);
    }


    public function add(AddCategoryRequest $request) : JsonResponse
    {
        return $this->categoryRepository->addCategory($request);
    }


    public function delete(DeleteCategoryRequest $request) : JsonResponse
    {
        return $this->categoryRepository->deleteCategory($request);
    }

    public function changeStatus(ChangeCategoryStatusRequest $request) : JsonResponse
    {
        return $this->categoryRepository->changeStatus($request);
    }


    public function edit(UpdateCategoryRequest $request)
    {
        return $this->categoryRepository->updateCategory($request);
    }

}
