<?php
namespace App\Repositories;
use App\Models\Article;

class FrontRepository {

	public function __construct(Article $articleModel) {
        $this->articleModel = $articleModel;
    }

    /*
     * Get All Articles
    */
    public function getArticles() {
    	$articles = $this->articleModel->orderBy('id', 'desc')->paginate(9);
    	return $articles;
    }

    /*
     * Get Article details by slug
    */
    public function getArticleDetails($slug) {
    	$articleDetails = $this->articleModel->with(['tags','categories'])->where('slug', $slug)->first();
    	return $articleDetails;
    }
}