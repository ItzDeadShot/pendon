<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Http\Requests\StoreItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $items = Item::all()->except(Auth::id());
        return view('pages.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('pages.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:100',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size
        ]);

        // Handle file upload
        $imagePath = $request->file('image')->store('images', 'public');
//        dd((float) $request->input('price'));
        $item = Item::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => (float) $request->input('price'),
            'photo_path' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('items.index')->with('success','Item has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Item $item): \Illuminate\Http\JsonResponse
    {
        try {
            // You can customize the data you want to return to the frontend
            $itemData = [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'price' => $item->price,
                'photo_path' => $item->photo_path,
            ];
            return response()->json($itemData);

        } catch (\Exception $e) {
            // Handle the case where the item with the given ID is not found
            return response()->json(['error' => 'Item not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return Application|Factory|\Illuminate\Contracts\Foundation\Application|View
     */
    public function edit(Item $item): View|Factory|Application|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.items.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItemRequest $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function update(UpdateItemRequest $request, Item $item): RedirectResponse
    {
        $input = $request->all();

        // Handle file upload (if a new file is provided)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $input['photo_path'] = $imagePath;
        } else {
            $input['photo_path'] = $item->photo_path;
        }

        $item->update($input);

        return redirect()->route('items.index')->with('success','Item Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return RedirectResponse
     */
    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();
        return redirect()->route('items.index')->with('success','Item has been deleted successfully');
    }
}
