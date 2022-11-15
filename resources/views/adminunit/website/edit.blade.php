@extends('master')
@section('pageTitle')
    Sunting Artikel    
@endsection
@section('content')
        <div class="card">
            <form action="{{ route('websites.update',$website->id) }}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="web_name">Nama Kegiatan <sup class="text-danger" style="font-size:14px">*</sup></label>
                <textarea name="web_name" class="form-control" cols="30" rows="3">{{ old('web_name',$website->web_name)}}</textarea>
                @error('web_name')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="web_address">Alamat/Tempat Kegiatan <sup  style="color:red;font-size:16px">*</sup></label>
                <textarea name="web_address" class="form-control" cols="30" rows="3">{{ old('web_address',$website->web_address)}}</textarea>
                @error('web_address')
                        <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="web_date">Tanggal Kegiatan <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="datetime-local" class="form-control" name="web_date" value="{{ old('web_date',$website->web_date)}}" />
                        @error('web_date')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="web_document">Naskah Artikel/Berita (PDF) <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="web_document"/>
                        <b>File Sebelumnya:</b> <a href="{{url($website->web_document)}}" target="_blank">link</a>  
                        @error('web_document')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="web_thumbnail">Thumbnail <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="web_thumbnail" id="image" onchange="imgPreview()">
                        <div class="card my-3 p-3">
                            <label for="before_thumbnail">Thumbnail Sebelumnya</label>
                            <img src="{{url($website->web_thumbnail)}}" alt="before thumbnail" width="200" height="100"/>
                        </div>
                        @error('web_thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    
                    <div class="mb-3">
                        <label for="web_category">Kategori Artikel <sup  style="color:red;font-size:16px">*</sup></label>
                        <select name="web_category" class="form-control">
                            <option value="nasional" {{ ($website->web_category == 'nasional') ? "selected" : '' }}>Nasional</option>
                            <option value="internasional" {{ ($website->web_category == 'internasional') ? "selected" : '' }}>internasional </option>
                        </select>
                        @error('web_category')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="card p-3">
                            <label for="">Thumbnail Preview </label>
                            <img class="img-preview mb-3 col-sm-5 border-radius-lg d-block mx-auto">

                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="web_url">URL Artikel Kegiatan <sup  style="color:red;font-size:16px">*</sup></label>
                <small>Situs: @if(!is_null($website->unit->url)) <a href="{{$website->url}}" style="color:blue">{{$website->unit->url}}</a> @else <b class="text-danger">situs unit belum dibuat</b> @endif </small>

                <textarea name="web_url" id="" cols="30" rows="5" class="form-control">{{ old('web_url',$website->web_url)}}</textarea>
            </div>

            <input type="submit" value="Sunting Artikel" class="btn btn-warning btn-sm"/>
            
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