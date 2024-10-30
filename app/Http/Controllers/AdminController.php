<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $adminRequests = User::where('is_admin', NULL)->get();
        $revisorRequests = User::where('is_revisor', NULL)->get();
        $writerRequests = User::where('is_writer', NULL)->get();
        $tags = Tag::all();
        return view('admin.dashboard', compact('adminRequests', 'revisorRequests', 'writerRequests' , 'tags'));
    
    }

    public function setAdmin(User $user){
        $user->is_admin = true;
        $user->save();
        return redirect(route('admin.dashboard'))->with('message', "Hai reso $user->name amministratore");
    }
    public function setRevisor(User $user){
        $user->is_revisor = true;
        $user->save();
        return redirect(route('admin.dashboard'))->with('message', "Hai reso $user->name revisore");
    }
    public function setWriter(User $user){
        $user->is_writer = true;
        $user->save();
        return redirect(route('admin.dashboard'))->with('message', "Hai reso $user->name redattore");
    }

    public function editTag(Request $request, Tag $tag){
        $request->validate([
            'name' => 'required|unique:tags',
        ]);
        $tag->update([
            'name' => strtolower($request->name),
        ]);
        return redirect()->back()->with('message', 'Tag aggiornato correttamente');
    }

    public function deleteTag(Tag $tag){
        foreach($tag->articles as $article){
            $article->tag()->detach($tag);
        }

        $tag->delete();
        return redirect()->back()->with('message', 'Tag eliminato  correttamente');
    }

    public function editCategory(Request $request, Category $category){
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $category->update([
            'name' => strtolower($request->name),
        ]);

        return redirect()->back()->with('message', 'Categoria aggiornata corretamente');
    }

    public function deleteCategory(Category $category){
        $category->delete();
        return redirect()->back()->with('message', 'Categoria eliminata correttamente');
    }

    public function storeCategory(Request $request){
        Category::create([
            'name' => strtolower($request->name),
        ]);

        return redirect()->back()->with('message', 'Categoria inserita correttamente');
    }

}

