@extends('master')
@section('pageTitle')
    Unit Situs
@endsection
@section('content')

    <div class="container">
        <a class="btn btn-primary btn-sm mb-3"  href="/adminunit/unitweb/create"><i class="fas fa-plus"></i> Tambah Unit Situs</a>
        <div class="container-fluid mt-3">
            <table class="table table-striped table-bordered" id="table-unitweb">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>URL</th>
                    <th>Unit</th>
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
            $('#table-unitweb').DataTable({
                serverside : true,
                responsive : true,
                serchable : true,
                ajax : {
                    url : "{{ route('unitweb.index') }}"
                },
                columns : [
                    {
                        render : function (data, type, row, meta){
                            return meta.row + meta.settings._iDisplayStart + 1
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'url', name: 'url'},
                    {data: 'unit', name: 'unit.name'},
                    {data: 'action', name: 'action'}
                ]
            })
        })

    </script>
@endpush
