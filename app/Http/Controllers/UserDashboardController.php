<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\AgendaKajian;
class UserDashboardController extends Controller
{
    public function index()
    {
        return view('users.dashboard');
    }

     public function articles()
    {
        $articles = Article::with('user')->latest()->paginate(10);
        return view('users.articles.index', compact('articles'));
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug',$slug)->with('user')->firstOrFail();
        return view('users.articles.show', compact('article'));
    }

    public function kajianIndex()
    {
        $kajians = AgendaKajian::with('ustadz')
            ->orderBy('tanggal','desc')
            ->paginate(10);

        return view('users.agenda-kajian.index', compact('kajians'));
    }

    public function kajianShow($slug)
    {
        $kajian = AgendaKajian::where('slug',$slug)->with('ustadz')->firstOrFail();
        return view('users.agenda-kajian.show', compact('kajian'));
    }

}

