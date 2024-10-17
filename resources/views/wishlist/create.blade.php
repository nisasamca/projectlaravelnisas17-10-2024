@extends('templates.nav')


@section('content-dinamis')

<form action="{{ route('wishlist.tambah.proses')}}" method="POST" class="card p-5">
    @csrf
    @method('POST')
    
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama barang: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">Harga: </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="price" name="price">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection
