@extends('master')
@section('pageTitle')
    Sosial Media
@endsection
@section('content')


<div class="container">
    <a class="btn btn-primary btn-sm mb-3"  href="/adminunit/socialmedia/create"><i class="fas fa-plus"></i> Tambah Post Social Media</a>
    <div class="container-fluid mt-3">
            <table class="table table-striped table-bordered" id="table-website">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Status</th>
                    <th>URL</th>
                    <th>Modified At</th>
                    <th>Thumbnail</th>
                    <th>Naskah</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>

</div>
@endsection
@push('js')
<script type="text/javascript">
 $(document).ready(function(){
    $('#table-website').DataTable({
        serverside : true,
        responsive : true,
        serchable : true,
        ajax : {
            url : "{{ route('socialmedia.index') }}"
        },
        columns : [
            {
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'socmed_name', name: 'socmed_name'},
            {data: 'socmed_status', name: 'socmed_status'},
            {
                data: 'socmed_url',
                render : function(socmed_url) {
                    return '<a href="'+ socmed_url +'" target="_blank">link</a>';
                }
            },
            {data: 'updated_at', name: 'updated_at'},

            {data: 'thumbnail', name: 'thumbnail'},
            {data: 'caption', name: 'caption'},
            {data: 'action', name: 'action'}
        ]
    })
})

</script>
@endpush
