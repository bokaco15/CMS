<?php

namespace App\Repositories\Admin;

use App\Mail\AcceptComment;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class CommentsRepository
{
    public function commentUnacceptedDatatable() : JsonResponse
    {
        $comment = Comment::query()->where('status', 0);
        return DataTables::of($comment)
            ->editColumn('post_id', function ($comment) {
                return "<a href='/post/{$comment->post->id}/{$comment->post->slug}'>".$comment->post->heading."</a>";
            })
            ->editColumn('status', function ($comment) {
                return $comment->status ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-danger">Unaccepted</span>';
            })
            ->editColumn('created_at', function ($comment) {
                return $comment->created_at->format('d.m.Y');
            })
            ->editColumn('actions', function ($comment) {
                return view('admin.comments.actions.unaccepted', compact('comment'));
            })
            ->rawColumns(['post_id', 'status', 'actions'])
            ->toJson();
    }

    public function commentAcceptedDatatable() : JsonResponse
    {
        $comment = Comment::query()->where('status', 1);
        return DataTables::of($comment)
            ->editColumn('post_id', function ($comment) {
                return "<a href='/post/{$comment->post->id}/{$comment->post->slug}'>".$comment->post->heading."</a>";
            })
            ->editColumn('status', function ($comment) {
                return $comment->status ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-danger">Unaccepted</span>';
            })
            ->editColumn('created_at', function ($comment) {
                return $comment->created_at->format('d.m.Y');
            })
            ->editColumn('actions', function ($comment) {
                return view('admin.comments.actions.accepted', compact('comment'));
            })
            ->rawColumns(['post_id', 'status', 'actions'])
            ->toJson();
    }

    public function acceptComment($request) : JsonResponse
    {
        $data = $request->validated();

        $comment = Comment::findOrFail($data['id']);
        $comment->status = $data['status'];
        $comment->save();

        Mail::to($comment->email)->send(new AcceptComment($comment));

        return response()->json([
            'success' => true,
            'message' => 'Comment Accepted',
        ]);
    }

    public function deleteComment($request) : JsonResponse
    {
        $data = $request->validated();

        $comment = Comment::findOrFail($data['id']);
        $comment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Comment Deleted',
        ]);
    }
}
