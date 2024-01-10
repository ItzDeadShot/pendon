<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['image'] = $request->file('image')->store('images');
        $data = Image::create($validatedData);

        return response()->json([
            'data' => $data,
            'message' => 'Image uploaded successfully'
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Return the Image file.
     */
    public function showFile(string $file)
    {
        $path = storage_path('app/public/images/' . $file);
        if (file_exists($path)) {
            return response()->file($path, array('Content-Type' => 'image/jpeg'));
        }

        return response()->json([
            'message' => 'Image not found'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
