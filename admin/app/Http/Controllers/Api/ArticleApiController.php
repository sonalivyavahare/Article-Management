<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;

class ArticleApiController extends Controller
{

    public function __construct() {

        $this->query = Article::query()->with(['tags', 'categories']);
    }

    public function getArticles(Request $request) {

        $title = $request->input('title');
        $limit = $request->input('limit');
        $sortingColumn = $request->input('sorting_column');
        $order = $request->input('order');
        $offset = $request->input('offset');
        $categories = $request->input('categories');
        $tags = $request->input('tags');

        if (!empty($title)) {
            $this->query->where('title', 'like', '%' . $title . '%');
        }

        if (!empty($offset) && !empty($limit)) {
            $this->query->skip($offset);
        }
        else if(!empty($offset) && empty($limit)) {
            return response()->json(['error'=> 'Please add limit if you have to use offset']);
        }

        if (!empty($limit)) {
            $this->query->take($limit);
        }

        if (!empty($order) && !empty($sortingColumn)) {
            $this->query->orderBy($sortingColumn,$order);
        } else if(empty($order) && !empty($sortingColumn)) {
            $this->query->orderBy($sortingColumn, 'ASC');
        } else if(!empty($order)){
            return response()->json(['error'=> 'Please add sorting column name if you have to order records with give order']);
        }

        if(!empty($categories)) {
            $this->query->whereHas('categories', function($q) use($categories) {
                $q->whereIn('name', $categories);
            });
        }

        if(!empty($tags)) {
            $this->query->whereHas('tags', function($q) use($tags) {
                $q->whereIn('name', $tags);
            });
        }

        $articles = $this->query->get();

        $data['success'] = 1;
        $data['message'] = "Data fetched.";
        $data['data']    = $articles;

        return $data;
    }

    public function getArticleDetailsByID(Request $request) {

        $id = $request->input('id');

        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            
            if(!empty($id)) {
                $details = $this->query->find($id);
            }

            $data['success'] = 1;
            $data['message'] = "Data fetched.";
            $data['data']    = $details;

            return $data;
        }
    }

}
