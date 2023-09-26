<?php

namespace App\Services;
use App\Repositories\ArticleRepository;
use Image;

class ArticleService {
 
 	protected $articleRepo;
 	protected $uploadPath;

	public function __construct(ArticleRepository $articleRepo) {
		$this->articleRepo = $articleRepo;
		$this->uploadPath = config('constants.LOGO_UPLOAD_PATH');
	}

    /*
     * Call the repository getTags() to Get Tags
     */
	public function getTags() {
		$tags = $this->articleRepo->getTags();
		return $tags;
	}

    /*
     * Call the repository getCategories() to Get Categories
     */
	public function getCategories() {
    	$categories = $this->articleRepo->getCategories();
    	return $categories;
    }

    /*
     * Store the article details 
     */
    public function store($request) {

    	if($request->hasFile('image'))
		{
			$imgName = $this->saveFeaturedImg($request->file('image'), '');
		}
    	$articleDetails = [
            'title' => (!empty($request->title)) ? $request->title : '',
            'feature_img' => isset($imgName) ? asset($this->uploadPath.$imgName) : '',
            'description' => (!empty($request->description)) ? $request->description : '',
            'summary' => (!empty($request->summary)) ? $request->summary : '',
            'author' => (!empty($request->author)) ? $request->author : '',
            'publish_date' => (!empty($request->publish_date)) ? $request->publish_date : '',
            'status' => (!empty($request->status) && $request->status == '1') ? 1 : 0,
        ];
        $articleId = $this->articleRepo->saveArticle($articleDetails);

        if(!empty($articleId)) {
        	if(!empty($request->tags)) {
        		$this->articleRepo->saveArticleTags($articleId, $request->tags);
        	}
        	if(!empty($request->categories)) {
        		$this->articleRepo->saveArticleCategories($articleId, $request->categories);
        	}
        }
    }

    /*
     * Upload the image in the folder, unlink the old image, 
     */
    protected function saveFeaturedImg($image, $oldFeaturedImg) {
    	$extension = $image->getClientOriginalExtension();
        $fileName = 'IMG' . date('YmdHis') . uniqid() . '.' . $extension;
       /* $image->move($this->uploadPath, $fileName);*/

        $img = Image::make($image->path());
        $img->resize(480, 320)->save($this->uploadPath.'/'.$fileName);

        if(!empty($oldFeaturedImg)) {
             @unlink($this->uploadPath.$oldFeaturedImg);
        }
        return $fileName;
     
    }

    /*
     * Call the article repository find article()for find article with given id
     */
    public function findArticle($articleId) {
    	if(!empty($articleId)) {
    		return $this->articleRepo->findArticle($articleId);
    	}
    }

    /*
     * Call the article repository getArticleTags() to get article tags for given article ID
     */
    public function getArticleTags($articleId) {
    	if(!empty($articleId)) {
    		$tags = $this->articleRepo->getArticleTags($articleId);
    		return $tags;
    	}
    }

    /*
     * Call the article repository getArticleCategories() to get article categories for given article ID
     */
    public function getArticleCategories($articleId) {
    	if(!empty($articleId)) {
    		return $this->articleRepo->getArticleCategories($articleId);
    	}
    }

    /*
     * Update the article details
     */
    public function update($request, $articleId) {

        $oldFeaturedImg = '';
        $oldImg = '';
        if(!empty($request->old_feature_img)) {
            $oldFeaturedImg = $request->old_feature_img;
            $oldImg = explode('/', $oldFeaturedImg);
            $oldImg = end($oldImg);
        }

        $imgName = '';
    	if($request->hasFile('image'))
		{
			$imgName = $this->saveFeaturedImg($request->file('image'), $oldImg);
		}

    	$articleDetails = [
            'title' => (!empty($request->title)) ? $request->title : '',
            'feature_img' => empty($request->file('image')) ? $oldFeaturedImg : asset($this->uploadPath.$imgName) ,
            'description' => (!empty($request->description)) ? $request->description : '',
            'description' => (!empty($request->description)) ? $request->description : '',
            'summary' => (!empty($request->summary)) ? $request->summary : '',
            'author' => (!empty($request->author)) ? $request->author : '',
            'publish_date' => (!empty($request->publish_date)) ? $request->publish_date : '',
            'status' => (!empty($request->status) && $request->status == '1') ? 1 : 0,
        ];

        $this->articleRepo->updateArticle($articleId, $articleDetails);

        if(!empty($articleId)) {
    		$this->articleRepo->saveArticleTags($articleId, $request->tags);
    		$this->articleRepo->saveArticleCategories($articleId, $request->categories);
        }
    }

    /*
     * Delete article
     */
    public function destroy($articleID) {
        $this->articleRepo->destroy($articleID);
    }
}