@extends('layout/aplikasi')

@section('konten')
    <div>
        <a href='/siswa' class="btn btn-primary"> Kembali </a>
        <h1>{{ $data->nama }}</h1>
        <p>
            <b>NIP: </b> {{$data->nip}}
        </p>
        <p>
            <b>Alamat: </b> {{$data->alamat}}
        </p>
    </div>
@endsection