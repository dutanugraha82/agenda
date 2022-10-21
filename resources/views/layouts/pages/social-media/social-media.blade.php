@extends('master')
@section('pageTitle')
    Data Social Media
@endsection
@section('content')
<div class="container my-3">
    <a class="btn text-white" style="background-color:blueviolet;" href="/adminunit/social-media/create">+ Add Social Media</a>
</div>
<div class="container">
    <div class="container">
        <table class="table table-striped table-bordered" id="table-unit">
            <thead>
               <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Status</th>
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
            url : "{{ route('social-media') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'socmed_name', name: 'name'},
            {data: 'socmed_date', name: 'date'},
            {data: 'socmed_address', name: 'address'},
            {data: 'category', name: 'category'},
            {data: 'unit', name: 'unit.name'},
            {data: 'socmed_status', name: 'status'},
            {data: 'action', name: 'action'}
        ]
    })
}
</script>
@endpush