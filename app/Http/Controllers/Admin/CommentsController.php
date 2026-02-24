<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\AcceptCommentRequest;
use App\Http\Requests\Admin\Comment\DeleteCommentRequest;
use App\Repositories\Admin\CommentsRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;


class CommentsController extends Controller
{
    public function __construct(protected CommentsRepository $commentRepo){}
    public function index() : View
    {
        return view('admin.comments.index');
    }

    public function unacceptedDatatable() : JsonResponse
    {
        return $this->commentRepo->commentUnacceptedDatatable();
    }

    public function acceptedDatatable() : JsonResponse
    {
        return $this->commentRepo->commentAcceptedDatatable();
    }

    public function accept(AcceptCommentRequest $request) : JsonResponse
    {
        return $this->commentRepo->acceptComment($request);
    }

    public function delete(DeleteCommentRequest $request) {
        return $this->commentRepo->deleteComment($request);
    }
}
