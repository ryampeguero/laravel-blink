<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlatRequest;
use App\Http\Requests\UpdateFlatRequest;
use App\Models\Flat;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FlatController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $flatsArray = Flat::where('user_id',$user_id)->get();
        // dd($flatsArray);
        return view('admin.flats.index', compact('flatsArray'));
    }

    public function create()
    {
        $flat = Flat::all();
        $services = Service::all();

        return view(' admin.flats.create', compact('flat', 'services'));
    }

    public function store(StoreFlatRequest $request)
    {
        $data = $request->validated();
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

    public function show(Flat $flat)
    {
        return view('admin.flats.show', compact('flat'));
    }


    public function edit(Flat $flat) {
        $services = Service::all();
        return view('admin.flats.edit', compact('flat', 'services'));
    }
    
    public function update(UpdateFlatRequest $request , Flat $flat) {

        $data = $request->validated();
        // dd($data);

        // $data['slug'] = Str::slug($data);


        //controllo se nel request c'è il file dell'imaggine
        if ($request->hasFile('img_path')) {
            //controllo se il projects aveva un immagine
            if ($flat->img_path) {
                //cancello vecchia immagine
                Storage::delete($flat->img_path);
            }

            //salvo nuova immagine
            $image_path = Storage::put('flat_img', $request->img_path);
            //salvo il nuvo path nel database
            $data['img_path'] = $image_path;
        }

        if ($request->has('services')) {
            $flat->services()->sync($data['services']);
        }

        $flat->update($data);

        return redirect()->route('admin.flats.show', ['flat' => $flat->slug])->with('message', 'Appartamento '. $flat->name . ' è stato modificato');
    }


}
