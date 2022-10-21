@extends('master')
@section('pageTitle')
    Data Websites
@endsection
@section('content')
    <div class="container-fluid mx-2">
        <a style="background-color: blueviolet;color:white;width:10rem" class="btn" href="/adminunit/website/create">+ Add Website</a>
        <div class="container-fluid mt-3">
            <table class="table table-striped table-bordered" id="table-website">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
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
    websites()
})
function websites(){
    $('#table-website').DataTable({
        serverside : true,
        responsive : true,
        serchable : true,
        ajax : {
            url : "{{ route('websites') }}"
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
            {data: 'Action', name: 'Action'}
        ]
    })
}
</script>
@endpush