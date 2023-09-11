<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\DataTables\TagsDataTable;
use App\Models\Tag;
use Session;

class TagController extends Controller
{
    protected $tagModel;
    public function __construct(Tag $tagModel) {
        $this->tagModel = $tagModel;
    }

    /**
     * Render the tags datable for listing the tags
     */
    public function index(TagsDataTable $dataTable, Request $request) {
        return $dataTable->render('admin.tags.index');
    }

    /**
     * Render create view
     */
    public function create() {
        return view('admin.tags.create');
    }

    /**
     * Store Tag details
     */
    public function store(TagRequest $request) {
        $this->tagModel->create(['name' => $request->tag_name]);
        return response()->json(['message' => 'Record Inserted Successfully!']);
    }

    /**
     * Render update view
     */
    public function edit($id) {

        $data['tagDetails'] = $this->tagModel->find($id);
        return view('admin.tags.edit', $data);
    }

    /**
     * Update Tag details
     */
    public function update($id, TagRequest $request) {
        $this->tagModel->where('id', $id)->update(['name' => $request->tag_name]);
        return response()->json(['message' => 'Record Updated Successfully!']);
    }

    /**
     * Delete tag with given id
     */
    public function destroy($id) {
        $tag = $this->tagModel->find($id);
        $tag->delete();
        $tag->articles()->detach();
    }
}
