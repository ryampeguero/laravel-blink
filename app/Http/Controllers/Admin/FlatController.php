<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlatRequest;
use App\Http\Requests\UpdateFlatRequest;
use App\Models\Flat;
use App\Models\Message;
use App\Models\Plan;
use App\Models\Service;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Session;

class FlatController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $flatsArray = Flat::where('user_id', $user_id)->get();
        // dd($flatsArray);
        $user = Auth::user();
        return view('admin.flats.index', compact('flatsArray', 'user'));
    }

    public function create()
    {
        $flat = Flat::all();
        $services = Service::all();
        $user = Auth::user();

        return view(' admin.flats.create', compact('flat', 'services', 'user'));
    }

    public function store(StoreFlatRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('img_path')) {
            $image_path = Storage::put('flat_img', $request->file('img_path'));
            $data['img_path'] = $image_path;
        }


        $data['slug'] = Str::slug($data['name']) . auth()->id();
        $data['user_id'] = auth()->id();
        $flat = new Flat();
        $flat->fill($data);
        $flat->save();

        //services
        if ($request->has('services')) {
            $flat->services()->sync($data['services']);
        }

        return redirect()->route('admin.flats.show', $flat->slug);
    }

    public function show(Flat $flat)
    {
        $slug = $flat->slug;

        $user = Auth::user();

        $views = View::where('flat_id', $flat->id)->count();

        $messages = Message::where('flat_id', $flat->id)->paginate(2);
        // dd($messages);
        return view('admin.flats.show', compact('flat', 'slug', 'views', 'user', 'messages'));
    }


    public function edit(Flat $flat)
    {
        $services = Service::all();
        $user = Auth::user();

        return view('admin.flats.edit', compact('flat', 'services', 'user'));
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
        } else {
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

    public function destroy(Flat $flat)
    {
        // dd('ciao');

        //controllo user 
        if ($flat->user_id !== Auth::id()) {
            abort(404);
        }

        //controllo img
        if ($flat->img_path) {
            Storage::delete($flat->img_path);
        }

        $flat->services()->detach();
        $flat->delete();

        return redirect()->route('admin.flats.index')->with('message', 'Appartamento ' . $flat->name . ' è stato eliminato');
    }

    public function showSponsorPage(String $slug)
    {

        $flat = Flat::where('slug', $slug)->first();

        $sponsorships = Plan::all();
        $user = Auth::user();

        $plansInfo = [
            '1'=>'',
        ];
        return view('admin.sponsor', compact('sponsorships', 'flat', 'slug', 'user'));
    }
}
