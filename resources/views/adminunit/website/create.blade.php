@extends('master')
@section('pageTitle')
    Tambah Artikel    
@endsection
@section('content')
        <div class="card">
            <form action="{{ route('websites.store') }}" method="POST" class="p-2 dropzone " enctype="multipart/form-data" >
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
                        <label for="web_document">Naskah Artikel/Berita (PDF) <sup  style="color:red;font-size:16px">*</sup></label>
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
                        <div class="dz-default dz-message dropzoneDragArea p-3"  id="upload-form">
                            <span><sup style="color: rgb(65, 170, 255); font-size: 1.8em">+</sup> Upload Gambar</span>
                            <div class="previews"></div> 
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
            <button class="btn btn-primary btn-md">Tambah Artikel</button>
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

 Dropzone.options.uploadForm = { // The camelized version of the ID of the form element

// The configuration we've talked about above
autoProcessQueue: false,
uploadMultiple: true,
parallelUploads: 100,
maxFiles: 100,
paramName:"file",

// The setting up of the dropzone
init: function() {
  var myDropzone = this;

  // First change the button to actually tell Dropzone to process the queue.
  this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
    // Make sure that the form isn't actually being sent.
    e.preventDefault();
    e.stopPropagation();
    myDropzone.processQueue();
  });

  // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
  // of the sending event because uploadMultiple is set to true.
  this.on("sendingmultiple", function() {
    // Gets triggered when the form is actually being sent.
    // Hide the success button or the complete form.
  });
  this.on("successmultiple", function(files, response) {
    // Gets triggered when the files have successfully been sent.
    // Redirect user or notify of success.
  });
  this.on("errormultiple", function(files, response) {
    // Gets triggered when there was an error sending the files.
    // Maybe show form again, and notify user of error
  });
}

}

    </script>
@endpush