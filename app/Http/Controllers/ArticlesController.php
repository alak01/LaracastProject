<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        if(request('tag')){
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        }else {
            $articles = Article::all();
        }

        return view('articles.index', ['articles' => $articles]);
    }

    public function show(Article $article)
    {
        // return view($article->path());
        return view('articles.show', ['article' => $article]);
    }
    // public function show($id)
    // {
    //     $article = Article::find($id);
    //     return view('articles.show', ['article' => $article]);
    // }

    public function create()
    {
        // show a view to create a new resource
        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    public function store()
    {
        $this->validateArticle();

        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1;  // auth()->id()
        $article->save();

        $article->tags()->attach(request('tags'));

        return redirect(route('articles.index'));
        ///--------------------------------------------
 
        // Article::create($this->validateArticle());
        // return redirect('/articles');

        ///--------------------------------------------
        // Handle the submission of the create form => Persist the new resource    
        // die('hello');
        // dump(request()->all());
        // request()->validate([
        //     'title' => 'required',
        //     'excerpt' => 'required',
        //     'body' => 'required'
        // ]);

        // $article = new Article();

        // $article->title = request()->title;
        // $article->excerpt = request()->excerpt;
        // $article->body = request()->body;
        // $article->save();

        // return redirect('/articles');
        ///--------------------------------------------
    }

    public function edit(Article $article)
    {
        // $article = Article::find($id);

        return view('articles.edit', compact('article'));
    }

    public function update(Article $article)
    {
        $article->update($this->validateArticle());

        // request()->validate([
        //     'title' => 'required',
        //     'excerpt' => 'required',
        //     'body' => 'required'
        // ]);

        // // $article = Article::find($id);

        // $article->title = request()->title;
        // $article->excerpt = request()->excerpt;
        // $article->body = request()->body;
        // $article->save();

        return redirect($article->path());
        // return redirect(route('articles.show', $article->id));
        // return redirect('/articles/' . $article->id);
    } 

    public function destroy()
    {
        
    }

    protected function validateArticle()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'tags' => 'exists:tags,id'  // exists in the tags table, looking at col id
        ]);
    }
    
}
