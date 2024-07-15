@extends('layouts.admin')

@section('content')
    <div class="ms_shadow mt-4 container ms_border p-4">
        <div class="d-flex justify-content-between mb-3 gap-3">
            <div class="card container-fluid ms_border p-4">
                <h1>stats</h1>
                <h3>Number</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <div class="card container-fluid ms_border p-4" >
                <h1>stats</h1>
                <h3>Number</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <div class="card container-fluid ms_border p-4">
                <h1>stats</h1>
                <h3>Number</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <table class="ms_table">
            <thead>
                <tr class="ms_tr">
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">N° Stanze</th>
                    <th scope="col">N° Bagni</th>
                    <th scope="col">N° Letti</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flatsArray as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->rooms }}</td>
                        <td>{{ $item->bathrooms }}</td>
                        <td>{{ $item->beds }}</td>
                        <td>{{ $item->address }}</td>
                        <td>
                            <a href="{{ route("admin.flats.show", ["flat"=>$item->slug]) }}"> ciao</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
