<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FrontService;

class ArticleController extends Controller
{
    public function __construct(FrontService $frontService) {
        $this->frontService = $frontService;
    }

    /*
     * Get Articles and passed it to the article list view
    */
    public function index() {
        $data['articles'] = $this->frontService->getArticles();
        return view('user.articles.list', $data);
    }

    /*
     * Get Articles details  by using slug and passed it to the article details view
    */
    public function getArticleDetails($slug) {
        $data['article'] = $this->frontService->getArticleDetails($slug);
        return view('user.articles.details', $data);
    }
}