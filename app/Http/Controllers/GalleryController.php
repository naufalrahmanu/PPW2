<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\galeri;
use Illuminate\Support\Facades\File;


class GalleryController extends Controller
{
    public function index()
    {
        $data = array(
            'id' => "posts",
            'menu' => "Gallery",
            'galleries' => galeri::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->paginate(30)
        );

        return view('gallery.index')->with($data);
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'description' => 'required',
            'picture' => 'nullable|image|max:1999'
        ]);
        if($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . time();
            $smallFilename = "small {$basename}.{$extension}";
            $mediumFilename = "medium {$basename}.{$extension}";
            $largeFilename = "large {$basename}.{$extension}";
            $filenameSimpan = "$basename}.{$extension}";
            $path = $request->file('picture')->storeAs('post_image', $filenameSimpan);
        }
        else {
            $filenameSimpan = 'noimage.png';
        }
        $galeri = new galeri();
        $galeri->picture = $filenameSimpan;
        $galeri->title = $request->input('title');
        $galeri->description = $request->input('description');
        $galeri->save();
        return redirect()->route('gallery.index') -> with('success', 'Berhasil menambahkan data baru');
    }

    public function edit(string $id) {
        $galeri = galeri::find($id);
    
        if (!$galeri) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    
        return view('gallery.edit', compact('gallery'));
    }

    public function update(Request $request, string $id) {
        $galeri = galeri::find($id);
    
        if (!$galeri) {
            return redirect('gallery')->with('error', 'Data tidak ditemukan');
        }
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        
        $galeri->title = $request->title;
        $galeri->description = $request->description;
    
        
        if ($request->hasFile('picture')) {
            
            $oldFile = public_path('storage/post_image/' . $galeri->picture);
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }
    
            
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
    
            
            $basename = uniqid() . time();
            $filenameSimpan = "{$basename}.{$extension}";
    
            
            $path = $request->file('picture')->storeAs('post_image', $filenameSimpan, 'public');
            $path2 = $request->file('picture')->storeAs($filenameSimpan);
    
            
            $galeri->picture = $path2;
        }
    
        $galeri->save();
    
        return redirect('gallery')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $id) {
        $galeri = galeri::find($id);
    
        if (!$galeri) {
            return redirect('gallery')->with('error', 'Data tidak ditemukan');
        }
    
        // Mendapatkan path file foto
        $file = public_path('storage/post_image/' . $galeri->picture);
    
        try {
            // Hapus file foto jika ada
            if (File::exists($file)) {
                File::delete($file);
            }
    
            // Hapus user dari database
            $galeri->delete();
    
            return redirect()->back()->with('success', 'Berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete user: ' . $th->getMessage());
        }
    }
}
