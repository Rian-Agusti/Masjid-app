<?php

namespace App\Http\Controllers;

use App\Models\PengumumanMasjid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengumumanMasjidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumuman = PengumumanMasjid::latest('created_at')
            ->paginate(10);

        return view(
            'admin.pengumuman-masjid.index',
            compact('pengumuman')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengumuman-masjid.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail')
                ->store('pengumuman', 'public');
        }

        PengumumanMasjid::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'thumbnail' => $thumbnail,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()
            ->route('admin.pengumuman-masjid.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengumumanMasjid $pengumumanMasjid)
    {
        return view(
            'admin.pengumuman-masjid.show',
            [
                'pengumuman' => $pengumumanMasjid,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengumumanMasjid $pengumumanMasjid)
    {
        return view(
            'admin.pengumuman-masjid.edit',
            [
                'pengumuman' => $pengumumanMasjid,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        PengumumanMasjid $pengumumanMasjid
    ) {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $thumbnail = $pengumumanMasjid->thumbnail;

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail')
                ->store('pengumuman', 'public');
        }

        $pengumumanMasjid->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title')),
            'content' => $request->input('content'),
            'thumbnail' => $thumbnail,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()
            ->route('admin.pengumuman-masjid.index')
            ->with('success', 'Pengumuman berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengumumanMasjid $pengumumanMasjid)
    {
        $pengumumanMasjid->delete();

        return redirect()
            ->route('admin.pengumuman-masjid.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
    public function userIndex()
    {
        $pengumuman = PengumumanMasjid::where('is_published', true)
            ->latest()
            ->paginate(3);

        return view(
        'users.pengumuman.index',
            [
                'pengumuman' => $pengumuman
            ]
        );
    }

    public function userShow($slug)
{
    $pengumuman = PengumumanMasjid::where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    return view(
        'users.pengumuman.show',
        [
            'pengumuman' => $pengumuman
        ]
    );
    }
}
