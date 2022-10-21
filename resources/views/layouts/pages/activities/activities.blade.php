@extends('master')
@section('pageTitle')
    Data Activities
@endsection
@section('content')
        <div class="container my-3">
            <a class="btn text-white" style="background-color:blueviolet;" href="/adminunit/activities/create">+ Add Activities</a>
        </div>
        <div class="container">
                <table class="table table-striped table-bordered" id="table-unit">
                    <thead>
                       <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Place</th>
                            <th>Type</th>
                            <th>Unit</th>
                            <th class="text-center">Action</th>
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
            url : "{{ route('activities') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'act_name', name: 'name'},
            {data: 'act_date', name: 'date'},
            {data: 'act_address', name: 'address'},
            {data: 'type', name: 'type'},
            {data: 'unit_id', name: 'unit'},
            {data: 'action', name: 'action'},
            
        ]
    })
}
</script>
@endpush