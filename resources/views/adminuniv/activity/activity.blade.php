@extends('master')
@section('pageTitle','Verifikasi Agenda Kegiatan')
@section('content')
    <div class="container">
        <div class="container-fluid mt-3">
            <table class="table table-striped table-bordered" id="table-website">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Unit</th>
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
                searchable : true,
                ajax : {
                    url : "{{ route('adminuniv.activities') }}"
                },
                columns : [
                    {
                        render : function (data, type, row, meta){
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {data: 'unit.unit_name', name: 'unit.unit_name'},
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
