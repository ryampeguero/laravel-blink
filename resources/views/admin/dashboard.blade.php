@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1>Dashboard</h1>
</div>
<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <div class="col">
            <div class="container-fluid ms_card p-4 h-100">
                <h4>Stats</h4>
                <h1>5264</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <div class="col">
            <div class="container-fluid ms_card p-4 h-100">
                <h4>Stats</h4>
                <h1>1820</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
        <div class="col">
            <div class="container-fluid ms_card p-4 h-100">
                <h4>Stats</h4>
                <h1>3212</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>
</div>
@endsection
