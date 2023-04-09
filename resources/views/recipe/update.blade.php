@extends('layout/aplikasi')

@section('konten')
    <a href="/recipe" class="btn btn-secondary"><< Kembali</a>
    <form method="post" action="{{ '/recipe/'.$data->recipeID }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <h1>
                ID Resep: {{ $data->recipeID }}
            </h1>
        </div>
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Resep</label>
            <input type="text" class="form-control" id="judul" name="judul"
            value="{{ $data->judul }}">
        </div>
        <div class="mb-3">
            <label for="background" class="form-label">Latar Belakang Resep</label>
            <textarea class="form-control" id="background" name="background">{{ $data->backstory }}</textarea>
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Asal Daerah</label>
            <input type="text" class="form-control" id="asal" name="asal"
            value="{{ $data->asalDaerah }}">
        </div>
        <div class="mb-3">
            <label for="porsi" class="form-label">Porsi (orang)</label>
            <input type="number" class="form-control" id="porsi" name="porsi"
            value="{{ $data->servings }}">
        </div>
        <div class="mb-3">
            <label for="durasi" class="form-label">Durasi (menit)</label>
            <input type="number" class="form-control" id="durasi" name="durasi"
            value="{{ $data->durasi_menit }}">
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">kategori makanan</label>
            <select id="kategori" name="kategori" class='form-select'>
                <option selected='selected'>Tanpa Kategori</option>
                <option value="daging">Daging</option>
                <option value="karbohidrat">Karbohidrat</option>
                <option value="buah atau sayur">Buah atau Sayur</option>
                <option value="seafood">Seafood</option>
                <option value="manisan">Manisan</option>
            </select>
        </div>
        @if ($data->foto)
            <div class="mb3">
                <img style="max-width:500px;max-height:500px" src="{{ url('foto').'/'.$data->foto }}"/>
            </div>
        @endif
        <div class="mb-3">
            <label for="foto" class="form-label">Foto (jpeg, jpg, png, gif)</label>
            <input type="file" class="form-control" name="foto" id="foto">
        </div>
        <div class="mb-3">
            <h1>
                Ingredients:
            </h1>
        </div>
        <ul>
            @foreach ($data_ingredients as $ingredient)
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="catQuantity">Kuantitas</label>
                    <input type="number" class="form-control" name="ingredients[{{$ingredient->ingredientID}}][quantity]" value="{{ $ingredient->quantity }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="catUnit">Satuan bahan</label>
                    <input type="text" class="form-control" name="ingredients[{{$ingredient->ingredientID}}][unit]" value="{{ $ingredient->unit }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="catIngName">Nama Bahan</label>
                    <input type="text" class="form-control" name="ingredients[{{$ingredient->ingredientID}}][name]" value="{{ $ingredient->ingredient_name }}">
                </div>
            </div>                       
            @endforeach
        </ul>

        <div class="mb-3">
            <h1>
                Tools:
            </h1>
        </div>
        <ul>
            @foreach ($data_tools as $tool)
            <div class="form-group">
                <div class="form-group col-md-4">
                    <label for="toolName">Nama Alat:</label>
                    <input type="text" class="form-control" name="tools[{{$tool->toolID}}][nama_alat]" value="{{ $tool->nama_alat }}">
                </div>
            </div>                        
            @endforeach
        </ul>

        <div class="mb-3">
            <h1>
                Instruksi:
            </h1>
        </div>
        <ol>
            @foreach ($data_steps as $step)
            <div class="form-group">
                <div class="form-group col-md-4">
                    <label for="toolName">Langkah: {{ $step->urutan }}</label>
                    <input type="textarea" class="form-control" name="steps[{{$step->stepID}}][deskripsi]" value="{{ $step->deskripsi }}">
                </div>
            </div>                        
            @endforeach
        </ol>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection