<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\ChangeStatusRequest;
use App\Http\Requests\Admin\Post\DeletePostRequest;
use App\Http\Requests\Admin\Post\PostUpdateRequest;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UploadMediaRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\Admin\PostRepository;
use App\Traits\PostPhotoTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    use PostPhotoTrait;

    public function __construct(protected PostRepository $postRepository){}

    public function index(): View
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function datatable(): JsonResponse
    {
        return $this->postRepository->postDatatable();
    }

    public function changeStatus(ChangeStatusRequest $request): JsonResponse
    {
        return $this->postRepository->postChangeStatus($request);
    }

    public function add(): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.add', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request) : RedirectResponse
    {
        return $this->postRepository->postStore($request);
    }

    public function uploadMedia(UploadMediaRequest $request) : Response | bool
    {
        if ($request->hasFile('upload')) {
            $fileName = $this->ckEditorUploadPhoto(uniqid() . '.webp', $request->file('upload'));

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset($fileName);
            $msg = 'Image uploaded successfully';

            $response = "<script>window.parent.CKEDITOR.tools.callFunction('$CKEditorFuncNum', '$url', '$msg');</script>";

            return response($response, 200)->header('Content-Type', 'text/html; charset=utf-8');
        }
        return false;
    }

    public function edit(Post $post, $slug) : View | RedirectResponse
    {
        if ($slug !== $post->slug)
        {
            return redirect()->route('admin.post.edit', [
                'post' => $post->id,
                'slug' => $post->slug,
            ]);
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostUpdateRequest $request, Post $post) : RedirectResponse
    {
        return $this->postRepository->postUpdate($request, $post);
    }

    public function delete(DeletePostRequest $request): JsonResponse
    {
        $post = Post::findOrFail($request->id);
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ]);
    }

}
