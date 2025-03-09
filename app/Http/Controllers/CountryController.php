<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Initialize the query
        $query = Country::query();

        // Filters
        if ($request->has('filter')) {
            $filters = $request->get('filter');

            // Filter by name
            if (! empty($filters['name'])) {
                $query->where('name', 'like', '%'.$filters['name'].'%');
            }

            // Filter by country code
            if (! empty($filters['country_code'])) {
                $query->where('country_code', 'like', '%'.$filters['country_code'].'%');
            }

            // Filter by ISO 3166-2
            if (! empty($filters['iso_3166_2'])) {
                $query->where('iso_3166_2', 'like', '%'.$filters['iso_3166_2'].'%');
            }

            // Filter by ISO 3166-3
            if (! empty($filters['iso_3166_3'])) {
                $query->where('iso_3166_3', 'like', '%'.$filters['iso_3166_3'].'%');
            }
        }
        // Sorting (optional)
        if ($request->has('sort_by') && ! empty($request->get('sort_by'))) {
            $validSortColumns = ['name', 'country_code', 'iso_3166_2', 'iso_3166_3', 'created_at']; // Define valid columns for sorting
            $sortBy = $request->get('sort_by');
            if (in_array($sortBy, $validSortColumns)) {
                $query->orderBy($sortBy, 'asc');
            }
        }

        // Get the countries
        $countries = $query->paginate(100);

        $pageTitle = 'Countries';
        return view('admin.countries.index', 
        [
            'countries' => $countries,
            'pageTitle' => $pageTitle,
            'filters' => $request->get('filter', []), // To maintain the filter state in the view
        ]
    );
    }

    public function create()
    {
        $pageTitle = 'Create Country';
        return view('admin.countries.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'capital' => 'nullable|string|max:255',
            'citizenship' => 'nullable|string|max:255',
            'country_code' => 'required|string|max:3',
            'currency' => 'nullable|string|max:255',
            'currency_code' => 'nullable|string|max:255',
            'currency_sub_unit' => 'nullable|string|max:255',
            'currency_symbol' => 'nullable|string|max:3',
            'currency_decimals' => 'nullable|integer',
            'full_name' => 'nullable|string|max:255',
            'iso_3166_2' => 'required|string|max:2',
            'iso_3166_3' => 'required|string|max:3',
            'name' => 'required|string|max:255',
            'region_code' => 'required|string|max:3',
            'sub_region_code' => 'required|string|max:3',
            'eea' => 'required|boolean',
            'calling_code' => 'nullable|string|max:3',
        ]);

        // start a transaction
        DB::beginTransaction();

        try {
            $country = new Country();
            $country->capital = $request->input('capital');
            $country->citizenship = $request->input('citizenship');
            $country->country_code = $request->input('country_code');
            $country->currency = $request->input('currency');
            $country->currency_code = $request->input('currency_code');
            $country->currency_sub_unit = $request->input('currency_sub_unit');
            $country->currency_symbol = $request->input('currency_symbol');
            $country->currency_decimals = $request->input('currency_decimals');
            $country->full_name = $request->input('full_name');
            $country->iso_3166_2 = $request->input('iso_3166_2');
            $country->iso_3166_3 = $request->input('iso_3166_3');
            $country->name = $request->input('name');
            $country->region_code = $request->input('region_code');
            $country->sub_region_code = $request->input('sub_region_code');
            $country->eea = $request->input('eea');
            $country->calling_code = $request->input('calling_code');
            if(!$country->save()) {
                throw new \Exception('Country creation failed.');
            }

            // commit the transaction
            DB::commit();

        } catch (\Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return url()->previous() 
                ? redirect()->back()->with('error', 'Country creation failed. ' . $e->getMessage()) 
                : redirect()->route('countries.index')->with('error', 'Country creation failed. ' . $e->getMessage());
        }

        return url()->previous() 
            ? redirect()->back()->with('success', 'Country created successfully.') 
            : redirect()->route('countries.index')->with('success', 'Country created successfully.');
    }


    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $pageTitle = 'Edit Country: ' . $country->name;
        return view('admin.countries.edit', compact('country', 'pageTitle'));
    }  

    public function update(Request $request, $id)
    {
        // validate the input data
        $request->validate([
            'capital' => 'nullable|string|max:255',
            'citizenship' => 'nullable|string|max:255',
            'country_code' => 'required|string|max:3',
            'currency' => 'nullable|string|max:255',
            'currency_code' => 'nullable|string|max:255',
            'currency_sub_unit' => 'nullable|string|max:255',
            'currency_symbol' => 'nullable|string|max:3',
            'currency_decimals' => 'nullable|integer',
            'full_name' => 'nullable|string|max:255',
            'iso_3166_2' => 'required|string|max:2',
            'iso_3166_3' => 'required|string|max:3',
            'name' => 'required|string|max:255',
            'region_code' => 'required|string|max:3',
            'sub_region_code' => 'required|string|max:3',
            'eea' => 'required|boolean',
            'calling_code' => 'nullable|string|max:3',
            'status' => 'required|string|max:20',
        ]);
        
        // start a transaction
        DB::beginTransaction();

        try {
            $country = Country::findOrFail($id);
            $country->capital = $request->input('capital');
            $country->citizenship = $request->input('citizenship');
            $country->country_code = $request->input('country_code');
            $country->currency = $request->input('currency');
            $country->currency_code = $request->input('currency_code');
            $country->currency_sub_unit = $request->input('currency_sub_unit');
            $country->currency_symbol = $request->input('currency_symbol');
            $country->currency_decimals = $request->input('currency_decimals');
            $country->full_name = $request->input('full_name');
            $country->iso_3166_2 = $request->input('iso_3166_2');
            $country->iso_3166_3 = $request->input('iso_3166_3');
            $country->name = $request->input('name');
            $country->region_code = $request->input('region_code');
            $country->sub_region_code = $request->input('sub_region_code');
            $country->eea = $request->input('eea');
            $country->calling_code = $request->input('calling_code');
            $country->status = $request->input('status');
            $country->save();
            // commit the transaction
            DB::commit();

            return url()->previous() 
                ? redirect()->back()->with('success', 'Country updated successfully.') 
                : redirect()->route('countries.index')->with('success', 'Country updated successfully.');

        } catch (\Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return url()->previous() 
                ? redirect()->back()->with('error', 'Country update failed. ' . $e->getMessage()) 
                : redirect()->route('countries.edit')->with('error', 'Country update failed. ' . $e->getMessage());
        }

    }

    public function destroy($id)
    {
        
        // start a transaction
        DB::beginTransaction();
        try {
            $country = Country::findOrFail($id);
            if(!$country->delete()) {
                throw new \Exception('Country deletion failed.');
            }

            // commit the transaction
            DB::commit();

        } catch (\Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return url()->previous() 
                ? redirect()->back()->with('error', 'Country deletion failed. ' . $e->getMessage()) 
                : redirect()->route('countries.index')->with('error', 'Country deletion failed. ' . $e->getMessage());
        }

        return url()->previous() 
            ? redirect()->back()->with('success', 'Country deleted successfully.') 
            : redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'countries' => 'required|array',
        ]);

        // start a transaction
        DB::beginTransaction();

        try {
            $countries = Country::whereIn('id', $request->input('countries'))->get();
            foreach ($countries as $country) {
                $country->status = $request->input('status');
                if(!$country->save()) {
                    throw new \Exception('Country status update failed.');
                }
            }
            
            // commit the transaction
            DB::commit();

        } catch (\Exception $e) {
            // rollback the transaction
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Country status update failed. ' . $e->getMessage(),
            ]);
        }

        // return json
        return response()->json([
            'status' => 'success',
            'message' => 'Country status updated successfully.',
        ]);
    }
}
