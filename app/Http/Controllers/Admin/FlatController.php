<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFlatRequest;
use App\Models\Flat;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index() {}

    public function create() {}

    public function store(Request $request) {}

    public function show(string $slug) {}

    public function edit(Flat $flat) {
        return view('admin.flats.edit', compact('flat'));
    }
    
    public function update(UpdateFlatRequest $request , Flat $flat) {
        $data = $request->validated();

        return redirect()->route('admin.flats.index')->with('message', 'Appartamento '. $flat->name . ' è stato modificato');
    }
}
