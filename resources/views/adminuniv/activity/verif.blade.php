@extends('master')
@section('pageTitle','Verifikasi Agenda Kegiatan')
@section('content')
    <div class="container">
        <div class="card p-3">
            <table class="table table-bordered">
                <tr>
                    <td class="text-bold">Nama Kegiatan</td>
                    <td>{{$activity->act_name}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Tempat dan Tanggal Kegiatan</td>
                    <td>{{$activity->act_address}}, {{$activity->act_date}}</td>
                </tr>
                <tr>
                    <td class="text-bold">Jumlah Partisipan</td>
                    <td>{{$activity->partisipant}} partisipan</td>
                </tr>
                <tr>
                    <td class="text-bold">Jenis Agenda</td>
                    <td>{{$activity->type}} </td>
                </tr>
                <tr>
                    <td class="text-bold">Kategori Agenda</td>
                    <td>{{$activity->category}} </td>
                </tr>
                <tr>
                    <td class="text-bold">Unit Penyelenggara</td>
                    <td>{{$activity->unit->unit_name}} </td>
                </tr>

            </table>
            <hr/>
            <form action="{{route('activities.submit-verification',$activity->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Status Verifikasi</label>
                    <select class="form-control" name="act_status">
                        <option value="publish" {{ ($activity->act_status == 'publish') ? "selected" : '' }}>Terima</option>
                        <option value="pending" {{ ($activity->act_status == 'pending') ? "selected" : '' }}>Tunda</option>
                        <option value="reject" {{ ($activity->act_status == 'reject') ? "selected" : '' }}>Tolak</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Feedback</label>
                    <textarea id="feedback" rows="10" cols="8" name="feedback">{{old('feedback',$activity->feedback)}}</textarea>
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
