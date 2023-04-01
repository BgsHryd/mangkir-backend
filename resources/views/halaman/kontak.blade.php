@extends('layout.aplikasi')

@section('konten')
<h1>{{ $judul }}</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, qui alias! Esse consequatur excepturi cum qui impedit eligendi adipisci quidem!</p>
<p>
    <ul>
        <li>Email: {{ $kontak['email'] }}</li>
        <li>Youtube: {{ $kontak['youtube'] }}</li>
    </ul>
</p>
@endsection