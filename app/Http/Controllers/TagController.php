<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tags = Tag::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        })->orderBy('name')->paginate(50)->withQueryString();

        $pageTitle = 'Tags';

        return view('admin.tags.index', compact('tags', 'search', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Tag';

        return view('admin.tags.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255',
            'slug' => 'required|unique:tags|max:255',
        ]);

        Tag::create($request->all());

        // Clear and refresh the cache after storing a new 
        Cache::forget('tags');
        getAllTags();

        return url()->previous() 
            ? redirect()->back()->with('success', 'Tag created successfully.') 
            : redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        // page title with tag name
        $pageTitle = 'Edit Tag: '.$tag->name;

        return view('admin.tags.edit', compact('tag', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|max:255|unique:tags,name,'.$tag->id,
            'slug' => 'required|max:255|unique:tags,slug,'.$tag->id,
        ]);

        $tag->update($request->all());

        // Clear and refresh the cache after storing a new 
        Cache::forget('tags');
        getAllTags();

        return url()->previous() 
            ? redirect()->back()->with('success', 'Tag updated successfully.') 
            : redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        // Clear and refresh the cache after storing a new 
        Cache::forget('tags');
        getAllTags();
        
        return url()->previous() 
            ? redirect()->back()->with('success', 'Tag deleted successfully.') 
            : redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
