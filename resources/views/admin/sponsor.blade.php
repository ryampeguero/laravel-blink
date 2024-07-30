@extends('layouts.admin')

@section('content')
    <div class="container mt-5 ms_shadow ms_border p-3">
        <h2>Sponsorizza Appartamento</h2>

        <div class="row">
            <div class="col">
                <div class="">
                    <span class="d-flex gap-3">
                        <h4>Appartamento:</h4>{{ $flat->name }}
                    </span>
                </div>
                <div class="">
                    <span class="d-flex gap-3">
                        <h4>Indirizzo:</h4>{{ $flat->address }}
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="ms_card p-4 h-100 border_basic">
                    <h4>Piano Base</h4>
                    <h5>3 giorni</h5>
                    <p>Dalla data e ora di pagamento</p>
                </div>
            </div>
            <div class="col">
                <div class="ms_card p-4 h-100 border_intermediate">
                    <h4>Piano Pro</h4>
                    <h5>7 giorni</h5>
                    <p>Dalla data e ora di pagamento</p>
                </div>
            </div>
            <div class="col ">
                <div class="ms_card p-4 h-100 border_premium">
                    <h4>Piano Premium</h4>
                    <h5>1 mese</h5>
                    <p>L'appartamento apparirà in evidenza</p>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col p-3">
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

                <div id="dropin-container" class="mt-3"></div>

                <button class="ms_button mt-3" id="pay">Paga</button>
            </div>
        </div>
    </div>

    <script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.min.js"></script>
@endsection
