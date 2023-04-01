@extends('layout/aplikasi')

@section('konten')
    <a href="/siswa" class="btn btn-secondary"><< Kembali</a>
    <form method="post" action="{{ '/siswa/'.$data->nip }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <h1>
                NIP: {{ $data->nip }}
            </h1>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" 
            value="{{ $data->nama }}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat">{{ $data->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection