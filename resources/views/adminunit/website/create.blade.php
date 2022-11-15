@extends('master')
@section('pageTitle')
    Tambah Artikel    
@endsection
@section('content')
        <div class="card">
            <form action="{{ route('websites.store') }}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="web_name">Nama Kegiatan <sup class="text-danger" style="font-size:14px">*</sup></label>
                <textarea name="web_name" class="form-control" cols="30" rows="3">{{ old('web_name')}}</textarea>
                @error('web_name')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="web_address">Alamat/Tempat Kegiatan  <sup  style="color:red;font-size:16px">*</sup></label>
                <textarea name="web_address" class="form-control" cols="30" rows="3">{{ old('web_address')}}</textarea>
                @error('web_address')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
          
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="web_date">Tanggal Kegiatan<sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="datetime-local" class="form-control" name="web_date" value="{{ old('web_date')}}" />
                        @error('web_date')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="web_document">Naskah Artikel/Berita (PDF) <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="web_document"/>
                        @error('web_document')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="web_thumbnail">Bukti Gambar <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="web_thumbnail" id="image" onchange="imgPreview()">
                        @error('web_thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                
                    <div class="mb-3">
                        <label for="web_category">Kategori Artikel <sup  style="color:red;font-size:16px">*</sup></label>
                        <select name="web_category" class="form-control">
                            <option value="nasional" selected="selected">Nasional</option>
                            <option value="internasional">internasional </option>
                        </select>
                        @error('web_category')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="card p-3">
                            <label for="">Bukti Gambar Preview </label>
                            <img class="img-preview mb-3 col-sm-5 border-radius-lg d-block mx-auto">

                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="web_url">URL Artikel Kegiatan  <sup  style="color:red;font-size:16px">*</sup></label>
                <small>Situs: @if(!is_null($website->url)) <a href="{{$website->url}}" style="color:blue">{{$website->url}}</a> @else <b class="text-danger">situs unit belum dibuat</b> @endif </small>
                <textarea name="web_url" class="form-control" cols="30" rows="3">{{ old('web_url')}}</textarea>
                @error('web_url')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
           

            <input type="submit" value="Tambah Artikel" class="btn btn-primary btn-sm"/>
            
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