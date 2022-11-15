@extends('master')
@section('pageTitle','Verifikasi Sosial Media')
@section('content')
    <div class="container">
        <div class="card p-3">
            <table class="table table-bordered">
                <tr>
                    <td class="text-bold">Nama Kegiatan</td>
                    <td>{{$socialMedia->socmed_name}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Tempat dan Tanggal Kegiatan</td>
                    <td>{{$socialMedia->socmed_address}}, {{$socialMedia->socmed_date}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Bukti Gambar</td>
                    <td><a href="{{url($socialMedia->thumbnail)}}" target="_blank">link</a></td>
                </tr>
                <tr>
                    <td class="text-bold">Naskah</td>
                    <td><a href="{{url($socialMedia->caption)}}">link</td> </td>
                </tr>
                <tr>
                    <td class="text-bold">Kategori Sosial Media</td>
                    <td>{{$socialMedia->category}} </td>
                </tr>
                <tr>
                    <td class="text-bold">URL</td>
                    <td><a href="{{url($socialMedia->socmed_url)}}">{{url($socialMedia->socmed_url)}}</td>  </td>
                </tr>

            </table>
            <hr/>
            <form action="{{route('social-media.submit-verification',$socialMedia->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Status Verifikasi</label>
                    <select class="form-control" name="socmed_status">
                        <option value="publish" {{ ($socialMedia->socmed_status == 'publish') ? "selected" : '' }}>Terima</option>
                        <option value="pending" {{ ($socialMedia->socmed_status == 'pending') ? "selected" : '' }}>Tunda</option>
                        <option value="reject" {{ ($socialMedia->socmed_status == 'reject') ? "selected" : '' }}>Tolak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Feedback</label>
                    <textarea id="feedback" rows="10" cols="8" name="feedback">{{old('feedback',$socialMedia->feedback)}}</textarea>
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
