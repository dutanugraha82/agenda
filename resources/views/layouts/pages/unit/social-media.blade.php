@extends('master')
@section('pageTitle')
    Data Unit Social Media
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="container my-3">
                <a class="btn text-white" style="background-color:blueviolet;" href="/superadmin/input-unit-socmed">+ Add Unit Social Media</a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div class="container">
                <table class="table table-striped table-bordered" id="table-socmed">
                    <thead>
                       <tr>
                            <th>No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Unit Name</th>
                            <th scope="col">Url</th>
                            <th scope="col">Created at</th>
                            <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                  </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    socmed()
})
function socmed(){
    $('#table-socmed').DataTable({
        serverside : true,
        responsive : true,
        ajax : {
            url : "{{ route('socmed') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'name_unit_socmed', name: 'name'},
            {data: 'unit', name: 'unit.name'},
            {data: 'url', name: 'url'},
            {data: 'created_at', name: 'create'},
            {data: 'action', name: 'action'}
        ]
    })
}
</script>
@endpush