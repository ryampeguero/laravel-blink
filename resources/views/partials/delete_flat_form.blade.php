

<form class="delete-form" action="{{ route('admin.flats.destroy', ['flat' => $flat->slug]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button id="btnDeleteFlat" data-flat-name="{{ $flat->name }}" type="submit" class="btn btn-danger">ELIMINA</button>
</form>


