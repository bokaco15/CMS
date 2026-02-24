<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Post\StoreCommentRequest;
use App\Mail\CommentReceivedMail;
use App\Models\Comment;
use App\Models\Post;
use App\Repositories\Front\PostRepository;
use App\Rules\ReCaptcha;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(protected PostRepository $postRepo){}
    public function index(Post $post, $slug): View|RedirectResponse
    {
        return $this->postRepo->index($post, $slug);
    }

    public function storeComment(StoreCommentRequest $request): JsonResponse
    {
        return $this->postRepo->storeComment($request);
    }

}
