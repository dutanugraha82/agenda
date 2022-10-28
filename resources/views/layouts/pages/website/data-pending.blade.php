@extends('master')
@section('pagetTitle')
    Data Pending Websites
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
                    <th>Type</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="container my-4">
        @if (auth()->user()->role == 'admin_univ')
            <a href="/adminuniv/" style="width: 7rem" class="btn btn-warning">Back</a>
        @elseif(auth()->user()->role == 'super_admin')
            <a href="/superadmin/" style="width: 7rem"  class="btn btn-warning">Back</a>
        @endif
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
            url : "{{ route('web-pending') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'web_name', name: 'name'},
            {data: 'web_date', name: 'date'},
            {data: 'web_type', name: 'type'},
            {data: 'web_category', name: 'category'},
            {data: 'web_status', name:'status'},
            {data: 'Action', name: 'Action'}
        ]
    })
}
</script>
@endpush