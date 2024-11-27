<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\galeri;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
     /**
      * @OA\Get(
      *     path="/api/gallery",
      *     tags={"Gallery"},
      *     summary="Retrieve all gallery items",
      *     description="Get a list of all galleries stored in the database",
      *     @OA\Response(
      *         response=200,
      *         description="A list of gallery items",
      *         @OA\JsonContent(
      *             type="object",
      *             @OA\Property(property="message", type="string", example="Berhasil mengambil data gallery"),
      *             @OA\Property(property="success", type="boolean", example=true),
      *             @OA\Property(
      *                 property="data",
      *                 type="array",
      *                 @OA\Items(
      *                     type="object",
      *                     @OA\Property(property="id", type="integer", example=1),
      *                     @OA\Property(property="title", type="string", example="Gambar 1"),
      *                     @OA\Property(property="description", type="string", example="Ini adalah gambar pertama."),
      *                     @OA\Property(property="picture", type="string", example="images/gallery1.jpg"),
      *                     @OA\Property(property="created_at", type="string", format="date-time", example="2024-11-04T12:00:00Z"),
      *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-11-04T12:30:00Z")
      *                 )
      *             )
      *         )
      *     )
      * )
      */
     
      public function indexAPI()
      {
        
          // Ambil semua data gallery dari database
          $galleries = galeri::all();
          // Return data dalam format JSON
          return response()->json([
              'message' => 'Berhasil mengambil data gallery',
              'success' => true,
              'data' => $galleries
          ]);
          }

}
