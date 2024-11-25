<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function __construct()
    {
        $this->model = new Category;
        $this->store_request = new StoreCategoryRequest;
        $this->update_request = new UpdateCategoryRequest;
    }
}
