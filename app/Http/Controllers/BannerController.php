<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all banners with pagination and search functionality
        $banners = Banner::when($request->search, function ($query) use ($request) {
            return $query->where('title', 'like', "%{$request->search}%")
                ->orWhere('description', 'like', "%{$request->search}%");
        })->orderBy('id', 'desc')->paginate(10)->withQueryString();

        $pageTitle = 'Banners';

        return view('admin.banners.index', compact('banners', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Banner';

        return view('admin.banners.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:5120',
            'link' => 'nullable|url',
            'section' => 'required|string|max:255',
            'order_column' => 'required|integer',
            'bg_color' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);


        try {
            $banner = new Banner;
            $banner->title = $request->title;
            if ($request->hasFile('image')) {
                $banner->image = $request->file('image')->store('banners', 'public');
            }
            $banner->link = $request->link;
            $banner->section = $request->section;
            $banner->order_column = $request->order_column;
            $banner->is_active = $request->is_active;
            $banner->bg_color = $request->bg_color;
            $banner->created_by = auth()->id();
            $banner->save();

            // call cachedBanner method to remove old cached data & cache new data
            $this->cachedBanner();

            return url()->previous() 
                ? redirect()->back()->with('success', 'Banner created successfully.') 
                : redirect()->route('banners.index')->with('success', 'Banner created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        $pageTitle = 'Show Banner'.$banner->title;

        return view('admin.banners.show', compact('pageTitle', 'banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $pageTitle = 'Edit Banner: '.$banner->title;

        return view('admin.banners.edit', compact('pageTitle', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'link' => 'nullable|url',
            'section' => 'nullable|string|max:255',
            'bg_color' => 'nullable|string|max:255',
            'order_column' => 'integer',
            'is_active' => 'boolean',
        ]);

        try {
            $banner->title = $request->title;
            if ($request->hasFile('image')) {
                $banner->image = $request->file('image')->store('banners', 'public');
            }
            $banner->link = $request->link;
            $banner->section = $request->section;
            $banner->order_column = $request->order_column;
            $banner->is_active = $request->is_active;
            $banner->bg_color = $request->bg_color;
            $banner->updated_by = auth()->id();
            $banner->save();

            // call cachedBanner method to remove old cached data & cache new data
            $this->cachedBanner();

            return url()->previous() 
                ? redirect()->back()->with('success', 'Banner updated successfully.') 
                : redirect()->route('banners.index')->with('success', 'Banner updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        try {
            $banner->deleted_by = auth()->id();
            $banner->save();
            $banner->delete();

            // call cachedBanner method to remove old cached data & cache new data
            $this->cachedBanner();

            return url()->previous() 
                ? redirect()->back()->with('success', 'Banner deleted successfully.') 
                : redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove all old cached data & cache new data.
     */
    public function cachedBanner()
    {
        $banners = Banner::where('is_active', true)->orderBy('order_column')->get();
        cache()->forget('banners');
        cache()->rememberForever('banners', function () use ($banners) {
            return $banners;
        });
    }
}
