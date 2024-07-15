<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index()
    {
        $flatsArray = Flat::all();
        return view("admin.flats.index", compact("flatsArray"));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(Flat $flat) {
        return view("admin.flats.show", compact('flat'));
    }

    public function edit() {}
    
    public function update(Request $request) {}
}
