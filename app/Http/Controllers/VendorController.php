<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the search query
        $search = $request->input('search');
        $vendors = Vendor::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%");
        })->orderBy('id', 'desc')
            ->paginate(20)->withQueryString();
        $pageTitle = 'Brands';

        return view('admin.vendors.index', compact('vendors', 'search', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Brand';

        return view('admin.vendors.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:20',
            'address' => 'nullable|max:255',
            'website' => 'nullable|url',
            'show_in_front' => 'required|boolean',
            'home_page_title' => 'nullable|max:255',
            'logo_src' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // start a transaction
            $logoName = null;
            $vendor = new Vendor;
            $vendor->name = $request->name;
            $vendor->slug = Str::slug($request->name);
            $vendor->description = $request->description;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->address = $request->address;
            $vendor->website = $request->website;
            $vendor->show_in_front = $request->show_in_front;
            $vendor->home_page_title = $request->home_page_title;
            $vendor->status = $request->status;
            if ($request->hasFile('logo_src')) {
                $vendor->logo_src = $request->file('logo_src')->store('vendors', 'public');
            }
            $vendor->save();
            DB::commit();

            return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', 'Something went wrong. '.$e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        $pageTitle = 'Edit Brand: '.$vendor->name;

        return view('admin.vendors.edit', compact('vendor', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:20',
            'address' => 'nullable|max:255',
            'website' => 'nullable|url',
            'show_in_front' => 'required|boolean',
            'home_page_title' => 'nullable|max:255',
            'logo_src' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // start a transaction
            $vendor->name = $request->name;
            $vendor->slug = Str::slug($request->name);
            $vendor->description = $request->description;
            $vendor->email = $request->email;
            $vendor->phone = $request->phone;
            $vendor->address = $request->address;
            $vendor->website = $request->website;
            $vendor->show_in_front = $request->show_in_front;
            $vendor->home_page_title = $request->home_page_title;
            $vendor->status = $request->status;
            if ($request->hasFile('logo_src')) {
                // Delete the old featured image
                if ($vendor->logo_src) {
                    Storage::disk('public')->delete($vendor->logo_src);
                }
                $vendor->logo_src = $request->file('logo_src')->store('vendors', 'public');
            }
            $vendor->save();

            DB::commit();

            return redirect()->route('vendors.index')->with('success', 'Brand updated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', 'Something went wrong. '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
