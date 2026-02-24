<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryRepository
{
    public function resort($request) : JsonResponse
    {
        $sortArr = explode(',',$request->resort);
        if ($sortArr) {
            foreach ($sortArr as $sortPosition => $id) {
                $category = Category::find($id);
                $category->priority = $sortPosition + 1;
                $category->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'You have been resorted categories',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => "You should change the order!"
        ]);
    }

    public function addCategory($request) : JsonResponse
    {
        $data = $request->validated();

        $baseSlug = $data['slug'];
        $slug = $baseSlug;
        $counter = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $highestPriority = Category::max('priority');
        $priority = ($highestPriority ?? 0) + 1;

        Category::create([
            'name' => $data['name'],
            'slug' => $slug,
            'show_on_index' => $data['show_on_index'] ?? 0,
            'priority' => $priority,
        ]);

        $categories = Category::orderBy('priority')->get();

        return response()->json([
            'success' => true,
            'message' => "Category was created successfully.",
            'html' => view('admin.category.table', compact('categories'))->render()
        ]);
    }

    public function deleteCategory($request) : JsonResponse
    {
        $category = Category::findOrFail($request->id);
        $category->delete();

        $categories = Category::orderBy('priority')->get();

        return response()->json([
            'success' => true,
            'message' => "Category was deleted successfully.",
            'html' => view('admin.category.table', compact('categories'))->render()
        ]);
    }

    public function changeStatus($request) : JsonResponse
    {
        $data=$request->validated();

        $show_on_index=$data['show_on_index'];
        $category = Category::findOrFail($data['id']);

        if ($show_on_index==1) {
            $category->show_on_index = 1;
            $category->save();
            $categories = Category::orderBy('priority')->get();

            return response()->json([
                'success' => true,
                'message' => "Category was activated successfully.",
                'html' => view('admin.category.table', compact('categories'))->render()
            ]);
        } else {
            $category->show_on_index = 0;
            $category->save();
            $categories = Category::orderBy('priority')->get();

            return response()->json([
                'success' => true,
                'message' => "Category was deactivated successfully.",
                'html' => view('admin.category.table', compact('categories'))->render()
            ]);
        }
    }

    public function updateCategory($request) : JsonResponse
    {
        $data = $request->validated();


        $category = Category::findOrFail($data['id']);

        $baseSlug = $data['slug'];
        $slug = $baseSlug;
        $counter = 1;

        while (
        Category::where('slug', $slug)
            ->where('id', '!=', $category->id)
            ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $category->name = $data['name'];
        $category->slug = $slug;
        $category->save();

        $categories = Category::orderBy('priority')->get();

        return response()->json([
            'success' => true,
            'message' => "Category was updated successfully.",
            'html' => view('admin.category.table', compact('categories'))->render()
        ]);
    }
}
