<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->latest()->paginate(3);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        Article::create([
            'user_id'   => auth()->id(),
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'content'   => $request->content,
            'thumbnail' => null, // sementara kosong
        ]);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Artikel berhasil ditambahkan');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        $article->update([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'content'   => $request->content,
            'thumbnail' => $request->thumbnail, // nanti bisa diganti file upload
        ]);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()
            ->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus');
    }
}
