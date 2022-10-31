@extends('master')
@section('pageTitle')
    Input Data Social Media
@endsection
@section('content')
<div class="container-fluid">
    <div class="card p-3">
        <form action="/adminunit/social-media/{{ $dataSocialMed->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="socmed_name" placeholder="Input Activities Name" value="{{ $dataSocialMed->socmed_name }}" required>
                </div>
                <div class="mb-3 d-block">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="socmed_date" placeholder="Input Activities date" value="{{ $dataSocialMed->socmed_date }}" required>
                </div>
                <div class="mb-3">
                    <label for="name">Address</label>
                    <input type="text" class="form-control" name="socmed_address" placeholder="Input Activities Address" value="{{ $dataSocialMed->socmed_address }}" required>
                </div>
                <div class="mb-3">
                    <label for="thumbnail">Thumbnail</label>
                    <div class="mb-3 mt-4">
                        <p>Current Image</p>
                        <img class="col-md-7" src="{{ asset('storage'.'/'.$dataSocialMed->thumbnail) }}" alt="">
                        <input type="hidden" name="oldImage"value="{{ $dataSocialMed->thumbnail }}">
                        <p class="mt-4">New Image</p>
                        <img class="img-preview rounded shadow w-50 d-block mx-auto" alt="">
                    </div>
                    <input type="file" class="form-control" name="thumbnail" id="image" onchange="imgPreview()">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="partisipant">Caption</label>
                    <textarea name="caption" class="form-control" id="" cols="30" rows="10">{{ $dataSocialMed->caption }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="date">Category</label>
                    <select name="category" class="form-control">
                        <option value="{{ $dataSocialMed->category }}">{{$dataSocialMed->category}}</option>
                        @if ($dataSocialMed->category == "nasional")
                        <option value="internasional">Internasional</option>     
                        @else
                        <option value="nasional">Nasional</option>
                        @endif
                    </select>
                </div>
                <input type="text" name="socmed_status" value="pending" hidden>
                <div class="mb-3">
                    <label for="unit">Unit</label>
                    <select name="unit_id" class="form-control">
                        <option value="{{ $dataSocialMed->unit_id }}">{{ $dataSocialMed->Unit->unit_name }}</option>
                        @foreach ($dataUnit as $item)
                        <option value="{{ $item->id }}">{{ $item->unit_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="url">Url</label>
                    <input type="text" name="socmed_url" class="form-control" value="{{ $dataSocialMed->socmed_url }}" placeholder="Input Social Media Url">
                </div>
            </div>
        </div>

        <div class="container mt-5 mb-3 text-center">
            <button type="submit" class="btn btn-primary ">Update Data Social Media</button>
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