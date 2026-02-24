<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tags\AddTagRequest;
use App\Http\Requests\Admin\Tags\DeleteTagRequest;
use App\Http\Requests\Admin\Tags\EditTagRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Repositories\Admin\TagRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{
    public function __construct(protected TagRepository $tagRepo){}
    public function index(): View
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function datatable() : JsonResponse
    {
        return $this->tagRepo->dataTables();
    }

    public function add(AddTagRequest $request) : JsonResponse
    {
        return $this->tagRepo->addTag($request);
    }

    public function delete(DeleteTagRequest $request) : JsonResponse
    {
        return $this->tagRepo->deleteTag($request);
    }

    public function edit(EditTagRequest $request)
    {
        return $this->tagRepo->editTag($request);
    }

}
