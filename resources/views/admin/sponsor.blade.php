@extends('layouts.admin')

@section('content')

<div class="container mt-3">
    <h2>Sponsorizza Appartamento</h2>
    
    <div class="container mt-3">
        <h2>Dettagli Appartamento</h2>
        <p>{{ $flat->name }}</p>
        <p>{{ $flat->address }}</p>
    </div>

    <form id="sponsorship-form">
        <label class="form-label" for="sponsorship">Seleziona il tipo di sponsorizzazione:</label>
        <select class="form-select" id="sponsorship" name="sponsorship">
            @foreach ($sponsorships as $sponsor)
                <option value="{{ $sponsor->price }}">{{ $sponsor->name }} - €{{ $sponsor->price }}</option>
            @endforeach
        </select>
        <input type="hidden" id="amount" value="">
        <input type="hidden" id="flatId" value="{{ $flat->id }}">
        <input type="hidden" id="planId" name="planId" value="">
    </form>
    <div id="dropin-container"></div>
    <button class="btn btn-primary mt-3" id="pay">Paga</button>

</div>
<script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.min.js"></script>

@endsection