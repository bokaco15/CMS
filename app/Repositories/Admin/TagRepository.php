<?php

namespace App\Repositories\Admin;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TagRepository {

    public function dataTables() : JsonResponse
    {
        $tag = DB::table('tags');

        return DataTables::of($tag)
            ->editColumn('actions', function ($tag) {
                return view('admin.tags.table', compact('tag'));
            })
            ->toJson();
    }

    public function addTag($request) : JsonResponse
    {
        $data = $request->validated();

        $baseSlug = $data['slug'];
        $slug = $baseSlug;
        $counter = 1;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        Tag::create([
            'name' => $data['name'],
            'slug' => $slug,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tag created successfully',
        ]);
    }

    public function deleteTag($request) : JsonResponse
    {
        $data = $request->validated();

        $tag = Tag::findOrFail($data['id']);
        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tag deleted successfully',
        ]);
    }

    public function editTag($request) : JsonResponse
    {
        $data = $request->validated();

        $tag = Tag::findOrFail($data['id']);

        $baseSlug = $data['slug'];
        $slug = $baseSlug;
        $counter = 1;

        while (
        Tag::where('slug', $slug)
            ->where('id', '!=', $tag->id)
            ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $tag->name = $data['name'];
        $tag->slug = $slug;
        $tag->save();

        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully',
        ]);
    }

}
