<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ArticlesDataTable;
use App\Services\ArticleService;
use App\Http\Requests\ArticleRequest;
use Session;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService) {
        $this->articleService = $articleService;
    }
    
    public function index(ArticlesDataTable $dataTable) {
        return $dataTable->render('admin.articles.index');
    }

    public function create() {

        $data['tags'] = $this->articleService->getTags();
        $data['categories'] = $this->articleService->getCategories();
        return view('admin.articles.create', $data);
    }

    public function store(ArticleRequest $request) {
        $this->articleService->store($request);
        Session::flash('flash_message', 'Record created successfully.');
        return redirect()->route('articles');
    }

    public function edit($articleId) {
        $data['article'] = $this->articleService->findArticle($articleId);
        $data['tags'] = $this->articleService->getTags();
        $data['categories'] = $this->articleService->getCategories();
        $data['articleTags'] = $this->articleService->getArticleTags($articleId);
        $data['articleCategories'] = $this->articleService->getArticleCategories($articleId);
        return view('admin.articles.edit', $data);
    }

    public function update(ArticleRequest $request, $articleId) {
        $this->articleService->update($request, $articleId);
        Session::flash('flash_message', 'Record updated successfully.');
        return redirect()->route('articles');
    }

    public function destroy($id) {
        if(!empty($id)) {
            $this->articleService->destroy($id);
        }
    }

    public function view($articleId){
        $data['article'] = $this->articleService->findArticle($articleId);
        $data['articleTags'] = $this->articleService->getArticleTags($articleId);
        $data['articleCategories'] = $this->articleService->getArticleCategories($articleId);
        return view('admin.articles.view', $data);
    }
}
