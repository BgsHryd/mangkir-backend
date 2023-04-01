@extends('layout/aplikasi')

@section('konten')
    <div>
        <a href='/recipe' class="btn btn-primary"> Kembali </a>
        <h1>{{ $data->judul }}</h1>
        <p>
            <b>emailAuthor: </b> {{ $data->emailAuthor }}
        </p>
        <p>
            <b>Asal: </b> {{ $data->asalDaerah }}
        </p>
    </div>
    <p>
        <b>Ingredients:</b>
        <ul>
            @foreach ($data_ingredients as $ingredient)
                <li>{{ $ingredient->quantity.' '.$ingredient->unit.' '.$ingredient->ingredient_name }}</li>
            @endforeach
        </ul>
    </p>
@endsection