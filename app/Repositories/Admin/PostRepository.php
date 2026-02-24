<?php

namespace App\Repositories\Admin;

use App\Models\Post;
use App\Traits\PostPhotoTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PostRepository
{
    use PostPhotoTrait;
    //datatable
    public function postDatatable() : JsonResponse
    {
        $post = Post::query();

        return DataTables::of($post)
            ->editColumn('preheading', function ($post) {
                return Str::words($post->preheading, 10, '...');
            })
            ->editColumn('category_id', function ($post) {
                return $post->category->name;
            })
            ->editColumn('important', function ($post) {
                return $post->important == 0 ? "<p class='text-danger'>Not important</p>" : "<p class='text-success'>Important</p>";
            })
            ->editColumn('published', function ($post) {
                return $post->published ? "<p class='text-success'>Published</p>" : "<p class='text-danger'>Not Published</p>";
            })
            ->editColumn('created_at', function ($post) {
                return $post->created_at->format('d.m.Y');
            })
            ->editColumn('actions', function ($post) {
                return view('admin.post.actions', compact('post'));
            })
            ->editColumn('image', function ($post) {
                return '<img src="' . $post->image . '" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->rawColumns(['important', 'published', 'actions', 'preheading', 'image'])
            ->toJson();
    }

    //change status
    public function postChangeStatus($request) : JsonResponse
    {
        $data = $request->validated();

        $post = Post::findOrFail($data['id']);

        $message = $data['published'] == 1 ? "You have successfully published post" : "You have not published post";

        $post->published = $data['published'];
        $post->save();
        return response()->json([
            'published' => true,
            'message' => $message,
        ]);
    }

    public function postStore($request) : RedirectResponse
    {
        $data = $request->validated();

        $baseSlug = $data['slug'];
        $slug = $baseSlug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $post = Post::create([
            'heading' => $data['heading'],
            'slug' => $slug,
            'preheading' => $data['preheading'],
            'text' => $data['text'],
            'category_id' => $data['category_id'],
            'important' => $data['important'],
            'published' => $data['published'],
            'user_id' => auth()->id(),
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $this->thumbnail($post->id . '.webp', $request->file('image'));
        }

        $post->tags()->sync($data['tags'] ?? []);
        $post->image = $imagePath;
        $post->save();

        return redirect()->back()->with('success', 'Post created successfully');
    }

    public function postUpdate($request, $post) : RedirectResponse
    {
        $data = $request->validated();

        $baseSlug = $data['slug'];
        $slug = $baseSlug;
        $counter = 1;

        while (
        Post::where('slug', $slug)
            ->where('id', '!=', $post->id)
            ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $post->update([
            'heading' => $data['heading'],
            'slug' => $slug,
            'preheading' => $data['preheading'],
            'text' => $data['text'],
            'category_id' => $data['category_id'],
            'important' => $data['important'],
            'published' => $data['published'],
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $this->thumbnail($post->id . '.webp', $request->file('image'));
            $post->image = $imagePath;
            $post->save();
        }

        $post->tags()->sync($data['tags'] ?? []);
        $post->save();

        return redirect()->back()->with('success', 'Post updated successfully');
    }

}
