@extends('master')
@section('pageTitle')
    Tambah Agenda Kegiatan
@endsection
@section('content')
    <div class="card">
        <form action="{{route('activities.store')}}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="act_name">Nama Agenda Kegiatan <sup class="text-danger" style="font-size:14px">*</sup></label>
                <textarea name="act_name" class="form-control" cols="30" rows="3">{{ old('act_name')}}</textarea>
                @error('act_name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="act_address">Alamat/Tempat Kegiatan  <sup  style="color:red;font-size:16px">*</sup></label>
                <textarea name="act_address" class="form-control" cols="30" rows="3">{{ old('act_address')}}</textarea>
                @error('act_address')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="act_date">Tanggal Kegiatan<sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="datetime-local" class="form-control" name="act_date" value="{{ old('act_date')}}" />
                        @error('act_date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="partisipant">Jumlah Partisipan <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="number" class="form-control" name="partisipant" value="{{old('partisipant')}}"/>
                        @error('partisipant')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image">Masukan Gambar <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="image" id="image" onchange="imgPreview()" />
                        <br>
                        <img class="img-preview mb-3 col-sm-5 border-radius-lg d-block mx-auto">
                        @error('image')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="type">Jenis Agenda <sup  style="color:red;font-size:16px">*</sup></label>
                        <select name="type" class="form-control">
                            <option value="public" selected="selected">Public (Umum)</option>
                            <option value="private">Private (Rahasia) </option>
                        </select>
                        @error('type')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category">Kategori Agenda <sup  style="color:red;font-size:16px">*</sup></label>
                        <select name="category" class="form-control">
                            <option value="internal" selected="selected"> Internal</option>
                            <option value="umum">Umum </option>
                        </select>
                        @error('category')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category">Contoh Gambar</label>
                        <br>
                       <img class="rounded col-md-8" src="{{ asset('dist/img/p3.jpg') }}" alt="">
                    </div>

                </div>
            </div>
            <input type="submit" value="Tambah Agenda Kegiatan" class="btn btn-primary btn-sm"/>

        </form>
    </div>

@endsection
@push('js')
    <script>
        function imgPreview()
        {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imagePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endpush