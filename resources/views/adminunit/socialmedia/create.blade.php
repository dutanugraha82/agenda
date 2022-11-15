@extends('master')
@section('pageTitle')
    Tambah Post Sosial Media
@endsection
@section('content')
<div class="card">
            <form action="{{route('socialmedia.store')}}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="socmed_name">Nama Kegiatan <sup class="text-danger" style="font-size:14px">*</sup></label>
                <textarea name="socmed_name" class="form-control" cols="30" rows="3">{{ old('socmed_name')}}</textarea>
                @error('socmed_name')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="socmed_address">Alamat/Tempat Kegiatan  <sup  style="color:red;font-size:16px">*</sup></label>
                <textarea name="socmed_address" class="form-control" cols="30" rows="3">{{ old('socmed_address')}}</textarea>
                @error('socmed_address')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="socmed_date">Tanggal Kegiatan<sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="datetime-local" class="form-control" name="socmed_date" value="{{ old('socmed_date')}}" />
                        @error('socmed_date')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="caption">Naskah Sosial Media/Caption (PDF) <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="caption"/>
                        @error('caption')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail">Bukti Gambar <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="thumbnail" id="image" onchange="imgPreview()">
                        @error('thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="category">Kategori Posting <sup  style="color:red;font-size:16px">*</sup></label>
                        <select name="category" class="form-control">
                            <option value="nasional" selected="selected">Nasional</option>
                            <option value="internasional">internasional </option>
                        </select>
                        @error('category')
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
                <label for="web_url">URL sosial media  <sup  style="color:red;font-size:16px">*</sup></label><br>

                @if(count($socialMedia) > 0)
                        @foreach($socialMedia as $media)
                        <div class="my-1 mx-3">
                            <label for="{{$media->social_media}}">{{$media->account_name}} ({{$media->social_media}})</label>
                            <small>Situs: <a href="{{$media->url}}" target="_blank">{{$media->url}}</a></small>
                            <input type="text" name="socmed_url[]" class="form-control" value="{{$media->url}}">
                        </div>

                        @endforeach
                        @error('socmed_url')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
                @else
                    <b class="text-danger">Social media belum terdaftar, silahkan hubungi admin</b>
                @endif

            </div>


            <input type="submit" value="Tambah Post Sosial Media" class="btn btn-primary btn-sm"/>

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
