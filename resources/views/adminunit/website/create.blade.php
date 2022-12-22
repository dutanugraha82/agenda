@extends('master')
@section('pageTitle')
    Tambah Artikel    
@endsection
@section('content')
        <div class="card">
            <form action="{{ route('websites.store') }}" method="POST" class="p-2" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label for="unit">Unit Situs</label>
                <select class="form-control w-25" name="unit_website_id" id="">
                    <option value="">-----------  Pilih Unit Situs  ----------</option>
                    @foreach ($webUnit as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
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
                        <label for="web_document">Naskah Artikel/Berita (DOCX) <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="web_document"/>
                        @error('web_document')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="web_thumbnail">Thumbnail <sup  style="color:red;font-size:16px">*</sup></label>
                        <input type="file" class="form-control" name="web_thumbnail" id="image" onchange="imgPreview()">
                        @error('web_thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gambar">Bukti Gambar</label>
                        <div class="p-3">
                            <input type="file" name="image_website" multiple data-max-files="3" data-allow-reorder="true" data-max-files-size="3MB" id="image-website">
                          </div>
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
                            <label for="">Preview Thumbnail </label>
                            <img class="img-preview mb-3 col-sm-5 border-radius-lg d-block mx-auto">

                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-md">Tambah Artikel</button>
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

        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginImageEdit
            );
            
        const inputElement = document.querySelector('input[id="image-website"]');
        const pond = FilePond.create(inputElement); 
       

        FilePond.setOptions({
            server:{
                //uploadimage
                process:'/adminunit/filepond',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                },
                //deleteimage
                revert: (uniqueFileId, load, error) => {
                    deleteImage(uniqueFileId);
                    error('Error while delete image');
                    load();
                }

            }
            
        });

        function deleteImage(nameFile){
            $.ajax({
                url: '/adminunit/revert',
                headers: {
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                },
                type:"DELETE",
                data:{
                    image: nameFile
                },
                success:function(response){
                    console.log('sukses')
                },
                error:function(response){
                    console.log('test')
                }
            });
        }

    </script>
@endpush