@extends('master')
@section('pageTitle','Verifikasi Artikel Situs')
@section('content')
    <div class="container">
        <div class="card p-3">
            <table class="table table-bordered">
                <tr>
                    <td class="text-bold">Nama Kegiatan</td>
                    <td>{{$website->web_name}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Tempat dan Tanggal Kegiatan</td>
                    <td>{{$website->web_address}}, {{$website->web_date}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Bukti Gambar</td>
                    <td><a href="{{url('/storage'.'/'.$website->web_thumbnail)}}" target="_blank">link</a></td>
                </tr>
                <tr>
                    <td class="text-bold">Naskah</td>
                    <td><a href="{{url('/storage'.'/'.$website->web_document)}}">link</td> </td>
                </tr>
                <tr>
                    <td class="text-bold">Kategori Artikel</td>
                    <td>{{$website->web_category}} </td>
                </tr>
                <tr>
                    <td class="text-bold">URL</td>
                    <td><a href="{{url($website->unitweb->url)}}">{{ url($website->unitweb->url) }}</td>
                </tr>

            </table>
            <hr/>
            <form action="{{route('website.submit-verification',$website->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Status Verifikasi</label>
                    <select class="form-control" name="web_status">
                        <option value="publish" {{ ($website->web_status == 'publish') ? "selected" : '' }}>Terima</option>
                        <option value="pending" {{ ($website->web_status == 'pending') ? "selected" : '' }}>Tunda</option>
                        <option value="reject" {{ ($website->web_status == 'reject') ? "selected" : '' }}>Tolak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Feedback</label>
                    <textarea id="feedback" rows="10" cols="8" name="feedback">{{old('feedback',$website->feedback)}}</textarea>
                </div>
                <input type="submit" value="Simpan Verifikasi" class="btn btn-primary btn-sm"/>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $("#feedback").summernote()
        })
    </script>
@endpush
