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
    <div class="ms_shadow mt-4 container ms_border p-4">
        <div class="">{{ $flats->links() }}</div>
        <div class=" mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h1>Messaggi</h1>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="ms_table">
            <thead>
                <tr class="ms_tr">
                    <th scope="col">Email</th>
                    <th scope="col">Messaggio</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($flats as $item)
                    @foreach ($item->messages as $key=>$message)
                    @if ($key < 1)
                        
                    <h3>{{ $item->name }}</h3>
                    @endif
                        <tr>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->message }}</td>
                            <td>
                                <form action="{{ route('admin.dashboard.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </td>
                    @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
