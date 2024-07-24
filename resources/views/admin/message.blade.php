@extends('layouts.admin')

@section('content')
{{-- @dd(Route::currentRouteName()) --}}
    <div class="ms_shadow mt-4 container ms_border p-4">
        <div class=" mb-5 d-flex justify-content-between align-items-center">
            <div>
                <h1>Messaggi</h1>
            </div>
        </div>
        <table class="ms_table">
            <thead>
                <tr class="ms_tr">
                    <th scope="col">Email</th>
                    <th scope="col">Messaggio</th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($messageArray as $item)
                    <tr>

                            <td>{{ $item->email }}</td>
                            <td>{{ $item->message }}</td>
                            <td><form action="{{ route('admin.message.destroy', $item->id) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
