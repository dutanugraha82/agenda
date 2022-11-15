@extends('master')
@section('pageTitle')
 Artikel Situs
@endsection
@section('content')
    <a class="btn btn-primary btn-sm" href="/adminunit/websites/create"><i class="fas fa-plus"></i> Tambah Artikel</a>

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
@endsection
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    $('#table-website').DataTable({
        serverside : true,
        responsive : true,
        serchable : true,
        ajax : {
            url : "{{ route('websites.index') }}"
        },
        columns : [
            {
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'web_name', name: 'web_name'},
            {data: 'web_status', name: 'web_status'},
            {
                data: 'web_url',
                render : function(web_url) {
                    return '<a href="'+ web_url +'" target="_blank">link</a>';
                }
            },
            {data: 'updated_at', name: 'updated_at'},

            {data: 'thumbnail', name: 'thumbnail'},
            {data: 'document', name: 'document'},
            {data: 'action', name: 'action'}
        ]
    })
})

</script>
@endpush
