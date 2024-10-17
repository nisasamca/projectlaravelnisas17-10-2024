@extends('templates.nav')


@section('content-dinamis')

<form action="{{ route('recipe.tambah.proses')}}" method="POST" class="card p-5">
    @csrf
    @method('POST')
    
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama Resep: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Jenis Resep: </label>
        <div class="col-sm-10">
            <select class="form-select" name="type" id="type">
                <option selected disabled hidden>Pilih</option>
                <option value="breakfast">breakfast</option>
                <option value="lunch">lunch</option>
                <option value="dinner">dinner</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">deskripsi : </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="description" name="description">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
</form>
@endsection
