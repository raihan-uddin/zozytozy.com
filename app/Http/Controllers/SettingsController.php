<?php

namespace App\Http\Controllers;

use App\Helpers\SettingsHelper;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all settings for the view
        $settings = Setting::all();
        $pageTitle = 'Settings';

        return view('admin.settings.index', compact('settings', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Setting';

        return view('admin.settings.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:settings',
            'value' => 'nullable',
            'type' => 'required|string',
        ]);

        $setting = new Setting;
        $setting->key = $request->key;
        $setting->type = $request->type;

        // Handle file uploads
        if ($request->type === 'file' && $request->hasFile('value')) {
            $filePath = $request->file('value')->store('settings', 'public');
            $setting->value = $filePath;
        } else {
            $setting->value = $request->value;
        }

        $setting->save();

        // Clear cache for the new setting
        SettingsHelper::flushCache();

        return response()->json(['message' => 'Setting created successfully!'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $setting = Setting::find($id);
        $pageTitle = 'Edit Setting: '.$setting->key;

        return view('admin.settings.edit', compact('setting', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'value' => 'nullable',
            'type' => 'required|string',
        ]);

        // Handle file uploads
        if ($request->type === 'file' && $request->hasFile('value')) {
            // Delete the old file if it exists
            if ($setting->value && Storage::exists($setting->value)) {
                Storage::delete($setting->value);
            }
            $filePath = $request->file('value')->store('settings', 'public');
            $setting->value = $filePath;
        } else {
            $setting->value = $request->value;
        }

        $setting->type = $request->type;
        $setting->save();

        // Clear cache for the updated setting
        SettingsHelper::flushCache();

        return response()->json(['message' => 'Setting updated successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);

        // If the setting type is a file, delete the file
        if ($setting->type === 'file' && Storage::exists($setting->value)) {
            Storage::delete($setting->value);
        }

        $setting->delete();

        // Clear cache for the deleted setting
        SettingsHelper::flushCache();

        return redirect()->route('settings.index')->with('success', 'Setting deleted successfully!');
    }
}
