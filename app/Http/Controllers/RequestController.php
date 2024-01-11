<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequestRequest;
use App\Models\Item;
use App\Models\Request as Req;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:donor|admin', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $reqs = Req::all();
            $items = Item::all();
        } else {
            $reqs = Req::whereHas('item', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
            $items = Item::where('user_id', $user->id)->get();
        }

        return view('pages.requests.index', compact('reqs', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        return view('pages.requests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate the form data
            $request->validate([
                'status' => 'required|string|max:255',
                'description' => 'required|string|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size
                'item_id' => 'required|exists:items,id',
            ]);

            // Handle file upload
            $imagePath = $request->file('image')->store('images', 'public');


            $req = \App\Models\Request::create([
                'status' => $request->input('status'),
                'description' => $request->input('description'),
                'proof' => $imagePath,
                'user_id' => Auth::id(),
                'item_id' => $request->input('item_id'),
            ]);

            return redirect()->route('requests.index')->with('success','Request has been created successfully.');
        } catch (ValidationException $e) {
            // Validation failed
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error creating request: ' . $e->getMessage());

            // Redirect with an error message
            return redirect()->route('requests.index')->with('error', 'Error creating request. Please try again.');
        }
    }


    public function storeFromItems(Request $request): RedirectResponse
    {
        try {
            // Validate the form data
            $request->validate([
                'description' => 'required|string|max:100',
                'email' => 'required|email',
                'phone' => 'required',
                'image' => 'required|image|sometimes|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size
                'item_id' => 'required|exists:items,id',
            ]);

            // Handle file upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            } else {
                $imagePath = null;
            }


            $req = \App\Models\Request::create([
                'status' => 'pending',
                'description' => $request->input('description'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'proof' => $imagePath,
                'user_id' => Auth::id(),
                'item_id' => $request->input('item_id'),
            ]);

            return redirect()->route('donated-items')->with('success','Your Request has been submitted successfully.');
        } catch (ValidationException $e) {
            // Validation failed
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error creating request: ' . $e->getMessage());

            // Redirect with an error message
                return redirect()->route('donated-items')->with('error', 'Error submitting request. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Req $req
     * @return JsonResponse
     */
    public function show(string $req): \Illuminate\Http\JsonResponse
    {
        try {
            $req = \App\Models\Request::findOrFail($req);

            // You can customize the data you want to return to the frontend
            $reqData = [
                'id' => $req->id,
                'description' => $req->description,
                'email' => $req->email,
                'phone' => $req->phone,
                'status' => $req->status,
                'proof' => $req->proof,
            ];
            return response()->json($reqData);

        } catch (\Exception $e) {
            // Handle the case where the item with the given ID is not found
            return response()->json(['error' => 'Request not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Req $req
     * @return Application|Factory|\Illuminate\Contracts\Foundation\Application|View
     */
    public function edit(\App\Models\Request $req): View|Factory|Application|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.requests.edit',compact('req'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequestRequest $request
     * @param Req $req
     * @return RedirectResponse
     */
    public function update(UpdateRequestRequest $request, string $req): RedirectResponse
    {
        $input = $request->all();
        $req = \App\Models\Request::findOrFail($req);

        // Handle file upload (if a new file is provided)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $input['image'] = $imagePath;
        } else {
            $input['image'] = $req->proof;
        }

        $req->update($input);

        return redirect()->route('requests.index')->with('success','Request Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Req $req
     * @return RedirectResponse
     */
    public function destroy(string $req): RedirectResponse
    {
        $req = \App\Models\Request::findOrFail($req);
        $req->delete();
        return redirect()->route('requests.index')->with('success','Request has been deleted successfully');
    }
}
