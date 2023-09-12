<?php

namespace App\Services;
use App\Repositories\FrontRepository;

class FrontService {

	public function __construct(FrontRepository $frontRepo) {
        $this->frontRepo = $frontRepo;
    }

    /*
     * Call FrontRepository getArticles function to get all articles
    */
    public function getArticles() {
    	$articles = $this->frontRepo->getArticles();
    	return $articles;
    }

    /*
     * Call FrontRepository getArticleDetails function to get article details using slug
    */
    public function getArticleDetails($slug) {
    	$articleDetails = $this->frontRepo->getArticleDetails($slug);
    	return $articleDetails;
    }
}