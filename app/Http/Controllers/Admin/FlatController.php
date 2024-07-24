<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlatRequest;
use App\Http\Requests\UpdateFlatRequest;
use App\Models\Flat;
use App\Models\Plan;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FlatController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $flatsArray = Flat::where('user_id', $user_id)->get();
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
        $data['slug'] = Str::slug($data['name']) . auth()->id();
        $data['user_id'] = auth()->id();
        $flat = new Flat();
        $flat->fill($data);
        $flat->save();

        return redirect()->route('admin.flats.show', $flat->slug);
    }

    public function show(Flat $flat)
    {
        $slug = $flat->slug;
        return view('admin.flats.show', compact('flat', 'slug'));
    }


    public function edit(Flat $flat)
    {
        $services = Service::all();
        return view('admin.flats.edit', compact('flat', 'services'));
    }

    public function update(UpdateFlatRequest $request, Flat $flat)
    {

        // dd($request);
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

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

        //services
        if ($request->has('services')) {
            $flat->services()->sync($data['services']);
        }else{
            $flat->services()->detach();
        }

        // coordinate
        if ($request->has('latitude') && $request->has('longitude')) {
            $data['latitude'] = $request->latitude;
            $data['longitude'] = $request->longitude;
        }

        $flat->update($data);

        return redirect()->route('admin.flats.show', ['flat' => $flat->slug])->with('message', 'Appartamento ' . $flat->name . ' è stato modificato');
    }

    public function showSponsorPage(String $slug)
    {
        // dd($flat);
        // dd($slug);

        

        $flat = Flat::where('slug', $slug)->first();
        // dd($flat);

        $sponsorships = Plan::all();
        

        // return view('admin.sponsor', compact('sponsorships', 'flat', 'slug'));
        return view('admin.sponsor', [
            'sponsorships' => $sponsorships,
            'flat' => $flat,
            'slug' => $slug
        ]);
    }
}
