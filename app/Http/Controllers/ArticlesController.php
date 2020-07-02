<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('articles')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('create_article')->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }


        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = Auth::id();
        $article->save();
        foreach ($request->tags as $tag) {
            # code...
            $article->tags()->sync([$tag => ['taggable_type' => 'article']]);
        }

        return view('view_article')->with('article', $article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $article = Article::findOrFail($id);
        } catch (ModelNotFoundException  $e) {
            report($e);
            return back()->withError($e->getMessage())->withInput();
        }
        //everything went fine
        return view('view_article')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $article = Article::findOrFail($id);
        } catch (ModelNotFoundException  $e) {
            report($e);
            return back()->withError($e->getMessage())->withInput();
        }
        $tags = Tag::all();
        $article_tags = DB::table('tags')
            ->join('taggables', function ($join) use ($id) {
                $join->on('tags.id', '=', 'taggables.tag_id');
                $join->where([
                    ['taggable_id', '=', $id],
                    ['taggable_type', '=', 'article']
                ]);
            })->select('tags.id')->get()->pluck('id')->toArray();
        //everything went fine
        return view('edit_article')->with('data', ['article' => $article, 'tags' => $tags, 'article_tags' => $article_tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        try {
            $article = Article::findOrFail($id);
        } catch (ModelNotFoundException  $e) {
            report($e);
            return back()->withError($e->getMessage())->withInput();
        }
        //everything went fine
        $article->title = $request->title;
        $article->content = $request->content;

        $article->save();


        DB::table('taggables')->where('taggable_id', '=', $id)->delete();

        // $items = [];
        foreach ($request->tags as $tag) {
            # code...
            $article->tags()->sync([$tag => ['taggable_type' => 'article']]);

        }
        // // dd($items);
        // $article->tags()->sync($items);


        return view('view_article')->with('article', $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
        } catch (ModelNotFoundException  $e) {
            report($e);
            return back()->withError($e->getMessage())->withInput();
        }
        // Everything went fine
        $article->delete();
        return back()->with('msg', 'Article Deleted!');
    }
}
