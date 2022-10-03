@extends('master')
@section('pageTitle')
    Form Input Website    
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="/store-website" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="my-4">
                        <label for="web_name">Website Name</label>
                        <input type="text" class="form-control" name="web_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="web_date">Date of Website</label>
                        <input type="date" class="form-control" name="web_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="web_address">Web Address</label>
                        <input type="text" class="form-control" name="web_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="web_document">Web Document</label>
                        <input type="text" class="form-control" name="web_document" required>
                    </div>
                    <div class="mb-3">
                        <label for="web_type">Web Type</label>
                        <select name="web_type" id="" class="form-control">
                            <option value="">Choose Type Of Website</option>
                            <option value="publish">Publish</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="my-4">
                        <label for="web_category">Web Category</label>
                        <select name="web_category" id="" class="form-control">
                            <option value="nasional">Nasional</option>
                            <option value="internasional">internasional </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="web_url">Web URL</label>
                        <input type="text" class="form-control" name="web_url">
                    </div>
                    <div class="mb-3">
                        <label for="unit_id">Unit</label>
                        <select name="unit_id" id="" class="form-control">
                            <option value="">Choose Unit</option>
                            @foreach ($dataUnit as $item)
                            <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 mt-4">
                            <label for="web_thumbnail">Thumbnail Web</label>
                            <img class="img-preview mb-3 col-sm-5 border-radius-lg d-block mx-auto">
                            <input type="file" style="width: 25rem" class="form-control my-3" name="web_thumbnail" id="image" onchange="imgPreview()">
                    </div>
                </div>
            </div>
            <input type="hidden" value="pending" name="web_status">
            <button style="margin-top: 40px" type="submit" class="btn btn-primary">Submit Data Web</button>
            </form>
        </div>
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