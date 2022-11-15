@extends('master')
@section('pageTitle')
    Sunting Post Sosial Media
@endsection
@section('content')
<div class="card">
            <form action="{{route('socialmedia.update',$socialMedia->id)}}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="socmed_name">Nama Kegiatan <sup class="text-danger" style="font-size:14px">*</sup></label>
                <textarea name="socmed_name" class="form-control" cols="30" rows="3">{{ old('socmed_name',$socialMedia->socmed_name)}}</textarea>
                @error('socmed_name')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="socmed_address">Alamat/Tempat Kegiatan  <sup  style="color:red;font-size:16px">*</sup></label>
                <textarea name="socmed_address" class="form-control" cols="30" rows="3">{{ old('socmed_address',$socialMedia->socmed_address)}}</textarea>
                @error('socmed_address')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="socmed_date">Tanggal Kegiatan<sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="datetime-local" class="form-control" name="socmed_date" value="{{ old('socmed_date',$socialMedia->socmed_date)}}" />
                        @error('socmed_date')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="caption">Naskah Sosial Media/Caption (PDF) <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="caption"/>
                        <b>File Sebelumnya:</b> <a href="{{url($socialMedia->caption)}}" target="_blank">link</a>

                        @error('caption')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="thumbnail">Bukti Gambar <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="thumbnail" id="image" onchange="imgPreview()">
                        <div class="card my-3 p-3">
                            <label for="before_thumbnail">Thumbnail Sebelumnya</label>
                            <img src="{{url($socialMedia->thumbnail)}}" alt="before thumbnail" width="200" height="100"/>
                        </div>
                        @error('thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="category">Kategori Posting <sup  style="color:red;font-size:16px">*</sup></label>
                        <select name="category" class="form-control">
                            <option value="nasional" {{ ($socialMedia->category == 'nasional') ? "selected" : '' }}>Nasional</option>
                            <option value="internasional" {{ ($socialMedia->category == 'internasional') ? "selected" : '' }}>internasional </option>
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
                <input type="text" name="socmed_url" class="form-control" value="{{old('socmed_url',$socialMedia->socmed_url)}}">


                        @error('socmed_url')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror


            </div>


            <input type="submit" value="Sunting Post Sosial Media" class="btn btn-warning btn-sm"/>

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
