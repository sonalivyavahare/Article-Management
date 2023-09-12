<?php
namespace App\Repositories;
use App\Models\Article;
use App\Models\Tag;
use App\Models\Category;

class ArticleRepository {
    
	public function __construct(Article $articleModel, Tag $tagModel, Category $categoryModel) {
        $this->articleModel = $articleModel;
        $this->tagModel = $tagModel;
        $this->categoryModel = $categoryModel;
    }

    /*
    * Get Tags
    */
    public function getTags() {
    	$tags = $this->tagModel::get();
    	return $tags;
    }

    /*
    * Get Categories
    */
    public function getCategories() {
    	$categories = $this->categoryModel::get();
    	return $categories;
    }

    /*
    * Store article details
    */
    public function saveArticle($articleDetails) {
    	if(isset($articleDetails)) {
    		$data = $this->articleModel->create($articleDetails);
    		return ($data->id);
    	}
    }

    /*
    * Store tags for given article ID
    */
    public function saveArticleTags($articleId, $tags) {
		$article = $this->findArticle($articleId);
		$article->tags()->sync($tags);
    }

    /*
    * Store categories for given article ID
    */
    public function saveArticleCategories($articleId, $categories) {
		$article = $this->articleModel->find($articleId);
		$article->categories()->sync($categories);
    }

    /*
    * Find article with given article ID
    */
    public function findArticle($articleId) {
    	if (!empty($articleId)) {
    		return $this->articleModel->find($articleId);
    	}
    }

    /*
    * Get tags for given article ID
    */
    public function getArticleTags($articleId) {
    	$article = $this->findArticle($articleId);
    	$articleTags = $article->tags->pluck('id');
    	return $articleTags;
    }

    /*
    * Get categories for given article ID
    */
    public function getArticleCategories($articleId) {
    	$article = $this->findArticle($articleId);
    	$articleCategories = $article->categories->pluck('id');
    	return $articleCategories;
    }

    /*
    * Update article details
    */
    public function updateArticle($articleId, $articleDetails) {
    	if(isset($articleDetails)) {
            $article = $this->findArticle($articleId);
            $article->update($articleDetails);
    	}
    }

    /*
    * Delete article
    */
    public function destroy($articleID) {
        $article = $this->findArticle($articleID);
        $article->delete();
        $article->tags()->detach();
        $article->categories()->detach();
    }
}