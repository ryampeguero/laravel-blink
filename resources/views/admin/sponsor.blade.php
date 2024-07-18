@extends('layouts.admin')

@section('content')

<div class="container mt-3">
    <h2>Pagamento</h2>

    <form id="sponsorship-form">
        <label class="form-label" for="sponsorship">Seleziona il tipo di sponsorizzazione:</label>
        <select class="form-select" id="sponsorship" name="sponsorship">
            @foreach ($sponsorships as $type => $price)
                <option value="{{ $price }}">{{ ucfirst($type) }} - €{{ $price }}</option>
            @endforeach
        </select>
        <input type="hidden" id="amount" value="">
    </form>
    <div id="dropin-container"></div>
    <button class="btn btn-primary mt-3" id="pay">Paga</button>

</div>
<script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.min.js"></script>

@endsection