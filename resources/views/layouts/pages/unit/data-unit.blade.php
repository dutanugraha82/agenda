@extends('master')
@section('pageTitle')
    Units Data
@endsection
@section('content')
    <div class="container my-3">
        <a class="btn text-white" style="background-color:blueviolet;" href="/superadmin/input-unit">+ Add Unit</a>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="container">
        <table class="table table-striped table-bordered" id="table-unit">
            <thead>
               <tr>
                    <th scope="col">No</th>
                    <th scope="col">Unit Name</th>
                    <th scope="col">Url</th>
                    <th scope="col">Created At</th>
                    <th>Updated At</th>
                    <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
          </table>
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
            url : "{{ route('unit') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'unit_name', name: 'unit_name'},
            {data: 'url', name: 'url'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action'}
        ]
    })
}
</script>
@endpush