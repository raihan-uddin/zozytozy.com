<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = State::all();
        $pageTitle = 'States';
        return view('admin.states.index', 
        [
            'states' => $states,
            'pageTitle' => $pageTitle,
            'filters' => $request->get('filter', []), // To maintain the filter state in the view
        ]);
    }

    public function create()
    {
        $countries = Country::active()->get();
        $pageTitle = 'Create State';
        return view('admin.states.create', compact('pageTitle', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'state' => 'required|string|max:255',
            'country_id' => 'required|integer',
            'tax_rate' => 'required|numeric',
            'delivery_fee' => 'required|numeric',
        ]);

        // start a transaction
        DB::beginTransaction();
        try {
            $state = new State();
            $state->state = $request->state;
            $state->country_id = $request->country_id;
            $state->tax_rate = $request->tax_rate;
            $state->delivery_fee = $request->delivery_fee;
            $state->status = 'active';
            $state->save();
            DB::commit();
            return redirect()->route('states.index')
                ->with('success', 'State created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('states.create')
                ->with('error', 'An error occurred while creating the state.');
        }
    }

    public function edit(State $state)
    {
        $countries = Country::active()->get();
        $pageTitle = 'Edit State: ' . $state->state;
        return view('admin.states.edit', compact('state', 'countries', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'state' => 'required|string|max:255',
            'country_id' => 'required|integer',
            'tax_rate' => 'required|numeric',
            'delivery_fee' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);


        // start a transaction
        DB::beginTransaction();
        try {
            $state = State::findOrFail($id);
            $state->state = $request->state;
            $state->country_id = $request->country_id;
            $state->tax_rate = $request->tax_rate;
            $state->delivery_fee = $request->delivery_fee;
            $state->status = $request->status;
            $state->save();
            DB::commit();
            return redirect()->route('states.index')
                ->with('success', 'State updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('states.edit', $state)
                ->with('error', 'An error occurred while updating the state.');
        }
    }

    public function destroy(State $state)
    {
        // start a transaction
        DB::beginTransaction();
        try {
            $state->delete();
            DB::commit();
            return redirect()->route('states.index')
                ->with('success', 'State deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('states.index')
                ->with('error', 'An error occurred while deleting the state.');
        }
    }
}
