@extends('templates.nav')


@section('content-dinamis')

<form action="{{ route('wishlist.ubah.proses', $wishlist['id'])}}" method="POST" class="card p-5">
    @csrf
    @method('PATCH')
    
   
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama barang: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{ $wishlist['name'] }}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">Harga: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="price" name="price" value="{{ $wishlist['price'] }}">
        </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection
