<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroBannerController extends Controller
{
    public function index()
    {
        $banners = HeroBanner::all();
        return view('admin.hero_banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.hero_banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_utama' => 'required|string|max:255',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('gambar')->store('banner', 'public');

        HeroBanner::create([
            'judul_utama' => $request->judul_utama,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $path,
        ]);

        return redirect()->route('admin.hero-banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(HeroBanner $heroBanner)
    {
        return view('admin.hero_banner.edit', compact('heroBanner'));
    }

    public function update(Request $request, HeroBanner $heroBanner)
    {
        $request->validate([
            'judul_utama' => 'required|string|max:255',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['judul_utama', 'judul', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            if ($heroBanner->gambar && Storage::disk('public')->exists($heroBanner->gambar)) {
                Storage::disk('public')->delete($heroBanner->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('banner', 'public');
        }

        $heroBanner->update($data);

        return redirect()->route('admin.hero-banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(HeroBanner $heroBanner)
    {
        if ($heroBanner->gambar && Storage::disk('public')->exists($heroBanner->gambar)) {
            Storage::disk('public')->delete($heroBanner->gambar);
        }

        $heroBanner->delete();

        return back()->with('success', 'Banner berhasil dihapus.');
    }
}