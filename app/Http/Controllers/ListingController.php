<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'listings' => Listings::latest()->filter(request(['tag', 'search']))->simplePaginate(10),
        ]);
    }

    public function show(Listings $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listings::create($formFields);

        return redirect('/')->with('message', 'Listing created');
    }

    public function edit(Listings $listing)
    {
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    public function update(Request $request, Listings $listing)
    {

        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated');
    }


    public function destroy(Listings $listing)
    {
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        
        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted');
    }

    public function manage(){
        return view('listings.manage', [
            // 'listings' => auth()->user()->listings()->get()
            'listings' => User::find(auth()->id())->listings
        ]);
    }
}