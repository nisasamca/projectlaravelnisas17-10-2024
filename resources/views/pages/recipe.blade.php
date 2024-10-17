@extends('templates.nav')

@section('content-dinamis')
    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <form class="d-flex me-3" action="{{ route('recipe.data') }}" method="GET">
                {{-- 1. tag form harus ada action sama method
                    2. value method GET/POST
                        - GET : form yg fungsinya untuk mencari
                        - POST : form yg fungsinya untuk menambah/menghapus/mengubah
                    3. input harus ada attr name, name => mengambil data dr isian input agar bisa di proses di controller
                    4. ada button/input yg type="submit"
                    5. action
                        - form untuk mencari : action ambil route yg menampilkan halaman blade ini (return view blade ini)
                        - form bukan mencari : action terpisah dengan route return view bladenya
                 --}}
                <input type="text" name="cari" placeholder="Cari nama resep" class="form-control me-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            {{-- <button class="btn btn-success">+ Tambah</button> --}}

            <a href="{{ route('recipe.tambah')}}" class="btn btn-success">+ Tambah</a>
        </div>
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success')}}
        </div>
    @endif
        <table class="table table-stripped table-bordered mt-3 text-center">
            <thead>
                <th>#</th>
                <th>Nama resep</th>
                <th>Tipe</th>
                <th>deskripsi</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                {{-- jika data obat kosong --}}
                @if (count($recipes) < 0)
                    <tr>
                        <td colspan="6">Data Resep Kosong</td>
                    </tr>
                @else
                {{-- $medicines : dari compact controller nya, diakses dengan loop karna data $medicines banyak (array) --}}
                    @foreach ($recipes as $index => $item)
                        <tr>
                            <td>{{ ($recipes->currentPage()-1) * ($recipes->perpage()) + ($index+1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>{{ $item['description']}}</td>
                            {{-- $item['column_di_migration'] --}}
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('recipe.ubah', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger" onclick ="showModalDelete('{{ $item['id'] }}', '{{ $item['name'] }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        {{-- memanggil pagination --}}
        <div class="d-flex justify-content-end my-3">
            {{ $recipes->links() }}
        </div>

        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">hapus data resep</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          apakah anda yakin ingin menghapus data resep ini? <b id="nama_resep"></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
    </div>

    {{-- modal stock --}}

    <div class="modal fade" id="modalEditStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form class="modal-content" method="POST" action="" id ="formEditStock">
            @csrf
            @method('PATCH')
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">edit deskripsi</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="description" class="col-form-label">Stok: </label>
                <input type="number" class="form-control" id="description" class="form-control" name="description">
              </div>
              @if (Session::get('error'))
                  
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
                  
              @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function showModalDelete(id, name) {
        $('#nama_resep').text(name);
        let url = "{{ route('recipe.hapus', ':id') }}";
        url = url.replace(':id', id);
        $('form').attr('action', url);
        $('#exampleModal').modal('show');
    }

    function showModalStock(id, stock) {
        $('#stock').val(stock);
        let url = "{{ route('recipe.ubah.proses', ':id') }}";
        url = url.replace(':id', id);
        $('form').attr('action', url);
        $('#modalEditStock').modal('show');
        
    }

    @if (Session::get('failed'))
    $( document ).ready(function() {
        let id = "{{Session::get('id')}}";
        let description = "{{Session::get('description')}}";
        showModalStock(id, description);
        
    })
    @endif
</script>
@endpush