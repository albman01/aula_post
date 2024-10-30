<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware()

    {
        return [
            new Middleware('auth', except: ['index', 'show', 'byCategory', 'byUser', 'articleSearch']),
        ];
        
    }


    public function create()
    {
        return view('articles.create');
    }
    
    public function index()
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->get();

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function byCategory(Category $category){
        $articles = $category->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->get();

        return view('articles.by-category', compact('category', 'articles'));
        }

         public function byUser(User $user){
             $articles = $user->articles()->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
             return view('article.by-user', compact('user', 'articles'));
            
         }
        public function store(Request $request)
{
    
        $request->validate([
        'title' => 'required|max:255',
        'subtitle' => 'required|max:255',
        'description' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'category' => 'required',
        'tags' => 'required'
        
    ]);

   

    
        $article = Article::create([
        'title' => $request->title,
        'subtitle' =>$request->subtitle,
        'description'=>$request->description,
        'category_id' => $request->category,
        'image' => $request->file('image')->store('images', 'public'),
        'user_id' => Auth::user()->id,
    ]);

    return redirect()->route('articles.index')->with('success', 'Articolo creato con successo!');

    $tags = explode('.', $request->tags);

    foreach($tags as $i => $tag){
        $tags[$i] = trim($tag);
    }

    foreach($tags as $tag){
        $newTag = Tag::updateOrCreate([
            'name' => strtolower($tag)
        ]);
        $article->tags()->attach($newTag);
    }
   
    
}

    public function articleSearch(Request $request){
        $query = $request->input('query');
        $articles = Article::search($query)->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('articles.search-index', compact('articles', 'query'));
    }

    public function edit(Article $article){
        if(Auth::user()->id == $article->user_id){
            return view('articles.edit', compact('article'));
        }
        return redirect()->route('homepage')->with('alert', 'Accesso non consentito');
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|min:5|unique:articles,title' . $article->id,
            'subtitle' => 'required|min:5',
            'body' => 'image',
            'category' => 'required',
            'tags' => 'required'
        ]);

        $article->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'category_id' => $request->category,
        ]);

        if($request->image){
            Storage::delete($article->image);
            $article->update([
                'image' => $request->file('image')->store('public/images')
            ]);
        }

        $tags = explode('.', $request->tags);

        foreach($tags as $i => $tag){
            $tags[$i] = trim($tag);
        }

        $newTags = [];

        foreach($tags as $tag){
            $newTag = Tag::updateOrCreate([
                'name' => strtolower($tag)
            ]);
            $newTags[] = $newTag->id;
        }
        $article->tags()->sync($newTags);
        return redirect(route('writer.dashboard'))->with('message', 'Articolo modificato con successo');
    }

    public function destroy(Article $article)
    {
        foreach ($article->tags as $tag) {
            $article->tag()->detach($tag);
        }
        $article->delete();
        return redirect()->back()->with('message', 'Articolo cancelalto con successo');
    }

}