<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flat;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FlatController extends Controller
{
    public function index()
    {
        $flatsArray = Flat::all();
        return view("admin.flats.index", compact("flatsArray"));
    }

    public function create()
    {
        $flat = Flat::all();
        $service = Service::all();

        return view(' admin.flats.create', compact('flat', 'service'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('img_path')) {
            $image_path = Storage::put('img_path', $request->file('img_path'));
            $data['img_path'] = $image_path;
        }
        $data['slug'] = Str::slug($data['name']).auth()->id();
        $data['user_id'] = auth()->id();
        $flat = new Flat();
        $flat->fill($data);
        $flat->save();

        return redirect()->route('admin.flats.show', $flat->slug);

    }

    public function show(Flat $flat) {
        return view("admin.flats.show", compact('flat'));
    }

    public function edit() {}

    public function update(Request $request) {}
}
