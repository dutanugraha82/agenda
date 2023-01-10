@extends('master')
@section('content')
    <div class="container">
        <a class="btn text-white btn-primary btn-sm mb-3" href="/superadmin/unitweb/create"><i class="fas fa-plus"></i> <span>Tambah Unit Situs</span></a>
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="table-unit">
                    <thead>
                       <tr>
                            <th scope="col">No</th>
                            <th scope="col">Unit Name</th>
                            <th scope="col">Url</th>
                            <th>Modified At</th>
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
        unit()
    })
    function unit(){
    $('#table-unit').DataTable({
        serverside : true,
        responsive : true,
        searchable : true,
        ajax : {
            url : "{{ route('unitweb') }}"
        },
        columns : [
            {"data": null, "sortable": false,
            render : function (data, type, row, meta){
                return meta.row + meta.settings._iDisplayStart + 1
            }
            },
            {data: 'name', name: 'name'},
            {
                data: 'url',
                render : function(url) {
                    return "<a href="+url+" target='_blank'>link</a>";
                }
            },
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action'}
        ],
        "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all"
            }]
    })
}
</script>
@endpush
