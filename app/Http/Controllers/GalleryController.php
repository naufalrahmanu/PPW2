<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class GalleryController extends Controller
{
    public function index()
    {
        $data = array(
            'id' => "post",
            'menu' => "Gallery",
            'galleries' => Buku::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->paginate(20),
        );

        return view('gallery.index')->with($data);
    }
}
