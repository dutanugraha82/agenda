@extends('master')
@section('pageTitle')
    Data Social Media
@endsection
@section('content')
<div class="container my-3">
    <a class="btn text-white" style="background-color:blueviolet;" href="/superadmin/users/create">+ Add Account</a>
</div> 
<div class="container">
    <div class="container">
        <table class="table table-striped table-bordered" id="table-unit">
            <thead>
               <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
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
        unit()
    })
    function unit(){
    $('#table-unit').DataTable({
        serverside : true,
        responsive : true,
        searchable : true,
        ajax : {
            url : "{{ route('users') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role'},
            {data: 'action', name: 'action'}
        ]
    })
}
</script>
@endpush