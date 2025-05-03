<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{
    public function __construct()
    {
        $this->model = new Article;
        $this->store_request = new StoreArticleRequest;
        $this->update_request = new UpdateArticleRequest;
    }
}
