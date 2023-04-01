@extends('layout/aplikasi')

@section('konten')
    <a href="siswa/create" class="btn btn-primary">Tambah Data Siswa</a>
    <table class='table'>
        <thead>
            <tr>
                <th>Nomor Induk</th>
                <th>nama</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <a class='btn btn-secondary btn-sm' href='{{ url('/siswa/'.$item->nip) }}'>Detail</a>
                        <a class='btn btn-primary btn-sm' href='{{ url('/siswa/'.$item->nip.'/edit') }}'>Edit</a>
                        <form onsubmit="return confirm('Apakah anda yakin?')" class="d-inline" action="{{ '/siswa/'.$item->nip }}" method="post">
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