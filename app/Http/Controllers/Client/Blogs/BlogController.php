<?php

namespace App\Http\Controllers\Client\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BlogController extends Controller{

    public function __invoke(Request $request){

        $blogs = Blog::query();
        if (isset($request->search)) {
            $blogs->where('title', 'like', '%' . $request->search .'%')
            ->orWhere('short_description', 'like', '%' . $request->search .'%');
        }
        if (isset($request->category)) {
            $category_ids = $request->category;
            $blogs->whereHas('categories', function (Builder $query) use ($category_ids) {
                $query->whereIn('blog_categories.id', $category_ids);
            });
        }
        $blogs = $blogs->paginate(12);
        $categories = BlogCategory::all();
        return view('client.blogs.blogs' , compact('blogs' , 'categories'));
    }

    public function single_blog($slug){

        $blog = Blog::findWithSlug($slug)->first();
        return view('client.blogs.blog' , compact('blog'));
    }

}
