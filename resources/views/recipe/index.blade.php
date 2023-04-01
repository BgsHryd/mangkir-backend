@extends('layout/aplikasi')

@section('konten')
    <a href="recipe/create" class="btn btn-primary">Tambah Data Resep</a>
    <table class='table'>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Email Author</th>
                <th>Backstory</th>
                <th>Asal Daerah</th>
                <th>Servings</th>
                <th>Durasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->emailAuthor }}</td>
                    <td>{{ $item->backstory }}</td>
                    <td>{{ $item->asalDaerah }}</td>
                    <td>{{ $item->servings }}</td>
                    <td>{{ $item->durasi_menit }}</td>
                    <td>
                        <a class='btn btn-secondary btn-sm' href='{{ url('/recipe/'.$item->recipeID) }}'>Detail</a>
                        <a class='btn btn-primary btn-sm' href='{{ url('/recipe/'.$item->recipeID.'/edit') }}'>Edit</a>
                        <form onsubmit="return confirm('Apakah anda yakin?')" class="d-inline" action="{{ '/recipe/'.$item->recipeID }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection