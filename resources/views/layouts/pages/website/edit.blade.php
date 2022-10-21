@extends('master')
@section('pageTitle')
    Edit Data {{ $dataWebsite->web_name }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <form action="/website/{{ $dataWebsite->id }}" method="POST" class="p-2" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6">
                <div class="my-4">
                    <label for="web_name">Website Name</label>
                    <input type="text" class="form-control" name="web_name" required value="{{ $dataWebsite->web_name }}">
                </div>
                <div class="mb-3">
                    <label for="web_date">Date of Website</label>
                    <input type="date" class="form-control" name="web_date" required value="{{ $dataWebsite->web_date }}">
                </div>
                <div class="mb-3">
                    <label for="web_address">Web Address</label>
                    <input type="text" class="form-control" name="web_address" required value="{{ $dataWebsite->web_address }}">
                </div>
                <div class="mb-3">
                    <label for="web_document">Web Document</label>
                    <input type="text" class="form-control" name="web_document" required value="{{ $dataWebsite->web_document }}">
                </div>
                <div class="mb-3">
                    <label for="web_type">Web Type</label>
                    <select name="web_type" id="" class="form-control">
                        <option value="{{ $dataWebsite->web_type }}">{{ $dataWebsite->web_type }}</option>
                       @if ($dataWebsite->web_type == 'publish')
                       <option value="private">Private</option>
                       @else
                       <option value="publish">Publish</option>
                       @endif
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="my-4">
                    <label for="web_category">Web Category</label>
                    <select name="web_category" id="" class="form-control">
                        <option value="{{ $dataWebsite->web_category }}">{{ $dataWebsite->web_category }}</option>
                        @if ($dataWebsite->web_category == 'nasional')
                        <option value="internasional">Internasional</option>
                        @else
                        <option value="nasional">Nasional</option>
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="web_url">Web URL</label>
                    <input type="text" class="form-control" name="web_url" value="{{ $dataWebsite->web_url }}">
                </div>
                <div class="mb-3">
                    <label for="unit_id">Unit</label>
                    <select name="unit_id" id="" class="form-control">
                      <option value="{{ $dataWebsite->unit_id }}">{{ $dataWebsite->Unit->unit_name }}</option>
                      @foreach ($dataUnit as $item)
                          <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="mb-3 mt-4">
                        <label for="web_thumbnail">Thumbnail Web</label>
                        <div class="my-3">
                            <p>Current Image</p>
                            <input type="hidden" value="{{ $dataWebsite->web_thumbnail }}" name="oldImage">
                            <img class="w-25" src="{{ asset('storage'.'/'.$dataWebsite->web_thumbnail) }}" alt="">
                        </div>
                        <p>New Image</p>
                        <img class="img-preview mb-3 col-sm-5 border-radius-lg">
                        <input type="file" style="width: 25rem" class="form-control my-3" name="web_thumbnail" id="image" onchange="imgPreview()">
                </div>
            </div>
        </div>
        <div class="btn-group">
            <a href="/website" style="width:8rem" class="btn rounded btn-warning mr-3">Back</a>
            <button type="submit" class="btn rounded btn-primary ml-3">Update Data {{ $dataWebsite->web_name }}</button>
        </div>
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