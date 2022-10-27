@extends('master')
@section('pagetTitle')
    Data Pending Social Media
@endsection
@section('content')
    <div class="container">
        <div class="container-fluid">
            <table class="table table-striped table-bordered" id="table-website">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>Category</th>
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
            url : "{{ route('socmed-pending') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'socmed_name', name: 'name'},
            {data: 'socmed_date', name: 'date'},
            {data: 'socmed_address', name: 'adress'},
            {data: 'category', name: 'category'},
            {data: 'socmed_status', name:'status'},
            {data: 'action', name: 'action'}
        ]
    })
}
</script>
@endpush