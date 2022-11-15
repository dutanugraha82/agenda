@extends('master')
@section('pageTitle')
    Sosial Media Unit
@endsection
@section('content')
<div class="container">

 <div class="card p-2">
     <form action="{{route('superadmin.unit.socialmedia-store')}}" method="POST">
         @csrf
         <input type="hidden" name="unit_id" value="{{ request()->route('id') }}">
         <div class="row mb-3">
            <div class="col-md-4">
                    <label for="account_name">Akun Sosial Media</label>
                    <input type="text" class="form-control " name="account_name" value="{{ old('account_name') }}">
                    @error('account_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
            <div class="col-md-4">
                        <label for="social_media">Platform</label>
                        <select name="social_media" class="form-control">
                            <option value="facebook">Facebook</option>
                            <option value="instagram">Instagram</option>
                            <option value="twitter">Twitter</option>
                            <option value="tiktok">Tiktok</option>
                            <option value="other">Lainnya</option>
                        </select>
                        @error('social_media')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
            </div>
            <div class="col-md-4">
                <label for="url">URL</label>
                <input type="text" class="form-control " name="url" value="{{ old('url') }}">
                @error('url')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
         </div>
         <button type="submit" class="btn btn-primary btn-sm">Tambah Sosial Media</button>
     </form>
 </div>

 <div class="card p-2">
    <table class="table table-striped table-bordered" id="table-unit">
            <thead>
               <tr>
                    <th>No</th>
                    <th>Akun</th>
                    <th>Platform</th>
                    <th>URL</th>
                    <th>Modified At</th>
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
        $('#table-unit').DataTable({
            serverside : true,
            responsive : true,
            searchable : true,
            ajax : {
                url : "{{ route('superadmin.unit.socialmedia',request()->route('id')) }}"
            },
            columns : [
                {"data": null, "sortable": false,
                render : function (data, type, row, meta){
                    return meta.row + meta.settings._iDisplayStart + 1
                }
                },
                {data: 'account_name', name: 'account_name'},
                {data: 'social_media', name: 'social_media'},
                {
                    data: 'url',
                    render : function(url) {
                        return '<a href="'+ url +'" target="_blank">link</a>';
                    }
                },
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action'}
            ]
        })
    })

</script>
@endpush
