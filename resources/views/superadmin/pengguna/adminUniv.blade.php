@extends('master')
@section('pageTitle','Admin Universitas')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('msg')}}</strong>
        </div>
    @endif

<div class="container my-3">
    <a class="btn text-white btn-primary btn-sm" href="/superadmin/pengguna/admin-univ/create"><i class="fas fa-plus"></i> <span>Tambah Admin Univ</span></a>
</div> 
<div class="container">
    <div class="container">
        <table class="table table-striped table-bordered" id="table-unit">
            <thead>
               <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Unit</th>
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
        $('#table-unit').DataTable({
            serverside : true,
            responsive : true,
            searchable : true,
            ajax : {
                url : "{{ route('superadmin.pengguna.admin-univ') }}"
            },
            columns : [
                {"data": null, "sortable": false,
                render : function (data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                }
                },
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'unit.unit_name', name: 'unit.unit_name'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action'}
            ],
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all"
            }] 
        })
    })
 
</script>
@endpush