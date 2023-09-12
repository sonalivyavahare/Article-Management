<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CategoriesDataTable;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    protected $categoryModel;

    public function __construct(Category $categoryModel) {
        $this->categoryModel = $categoryModel;
    }

    public function index(CategoriesDataTable $dataTable) {
        return $dataTable->render('admin.categories.index');
    }

    public function create() {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request) {
        $this->categoryModel->create(['name' => $request->category_name]);
        return response()->json(['message' => 'Record Inserted Successfully!']);
    }

    public function edit($id) {
        $data['catDeatils'] = $this->categoryModel->find($id);
        return view('admin.categories.edit', $data);
    }

    public function update(CategoryRequest $request, $id) {
        $this->categoryModel->where('id', $id)->update(['name' => $request->category_name]);
        return response()->json(['message' => 'Record Updated Successfully!']);
    }

    public function destroy($id) {
        $category = $this->categoryModel->find($id);
        $category->delete();
        $category->articles()->detach();
    }
}
