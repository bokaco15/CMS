<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Front\BlogRepository;
use App\Repositories\Front\CategoryRepository;
use App\Repositories\Front\TagRepository;
use App\Repositories\Front\UserPostRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        protected BlogRepository $blogRepo,
        protected CategoryRepository $categoryRepo,
        protected TagRepository $tagRepo,
        protected UserPostRepository $userPostRepo,
    ){}

    public function blog(Request $request): View
    {
       return $this->blogRepo->index($request);
    }

    public function category(Category $category, $slug, Request $request) : View | RedirectResponse
    {
        return $this->categoryRepo->postsCategory($category, $slug, $request);
    }

    public function tag(Tag $tag, $slug, Request $request): View | RedirectResponse
    {
        return $this->tagRepo->postsTag($tag, $slug, $request);
    }

    public function userPost(User $user, $slug, Request $request) : RedirectResponse | View
    {
        return $this->userPostRepo->postsByUser($user, $slug, $request);
    }

}
