@extends('master')
@section('pageTitle')
    Kegiatan
@endsection
@section('content')

    <div class="container">
        <a class="btn btn-primary btn-sm mb-3"  href="/adminunit/activities/create"><i class="fas fa-plus"></i> Tambah Agenda Kegiatan</a>
        <div class="container-fluid mt-3">
            <table class="table table-striped table-bordered" id="table-website">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tempat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Modified At</th>
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
                    url : "{{ route('activities.index') }}"
                },
                columns : [
                    {
                        render : function (data, type, row, meta){
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {data: 'act_name', name: 'act_name'},
                    {data: 'act_address', name: 'act_address'},
                    {data: 'act_date', name: 'act_date'},
                    {data: 'act_status', name: 'act_status'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action'}
                ]
            })
        })

    </script>
@endpush
