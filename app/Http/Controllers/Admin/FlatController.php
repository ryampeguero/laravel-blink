<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Service;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function index() {}

    public function create()
    {
        $flat = Flat::all();
        $service = Service::all();

        return view(' admin.flats.create', compact('flat', 'service'));
    }

    public function store(Request $request) {}

    public function show(string $slug) {}

    public function edit() {}

    public function update(Request $request) {}
}
