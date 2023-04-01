@extends('layout/aplikasi')

@section('konten')
    <form method="post" action="/recipe">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type='text' class="form-control" id="judul" name="judul" aria-describedby="emailHelp" value="{{ Session::get('judul') }}">
        </div>
        <div class="mb-3">
            <label for="backstory" class="form-label">Backstory</label>
            <input type="text" class="form-control" id="backstory" name="backstory" aria-describedby="emailHelp" value="{{ Session::get('backstory') }}">
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal</label>
            <textarea class="form-control" id="asal" name="asal">{{ Session::get('asal') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="serving" class="form-label">Servings</label>
            <textarea class="form-control" id="serving" name="serving">{{ Session::get('serving') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="durasi" class="form-label">Durasi (menit)</label>
            <textarea class="form-control" id="durasi" name="durasi">{{ Session::get('durasi') }}</textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </div>
    </form>
@endsection