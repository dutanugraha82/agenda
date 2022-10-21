@extends('master')
@section('pagetTitle')
    Data Pending Activities
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <table class="table table-striped table-bordered" id="table-website">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
<script type="text/javascript">
$(document).ready(function(){
    websites()
})
function websites(){
    $('#table-website').DataTable({
        serverside : true,
        responsive : true,
        serchable : true,
        ajax : {
            url : "{{ route('act-pending') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'act_name', name: 'name'},
            {data: 'act_address', name: 'address'},
            {data: 'act_type', name: 'type'},
            {data: 'act_status', name:'status'},
            {data: 'Action', name: 'Action'}
        ]
    })
}
</script>
@endpush