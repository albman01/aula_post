<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function dashboard(){
        $articles = Auth::user()->articles()->orderBy('created_at', 'desc')->get();
        $acceptedArticles = $articles->where('is_accepted', true);
        $rejectedArticles = $articles->where('is_accepted', false);
        $unrevisionedArticles = $articles->where('is_accepted' , NULL);

        return view('writer.dashboard'. compact('acceptedArticles', 'rejectedArticles', ' unrevisionedArticles'));
    }
}
