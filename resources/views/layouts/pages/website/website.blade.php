@extends('master')
@section('pageTitle')
    Data Websites
@endsection
@section('content')
    <div class="container">
        <a style="background-color: blueviolet;color:white;width:10rem" class="btn" href="/input-website">+ Add Website</a>
        <div class="card">
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
        </div>
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    let table;
    $(function () {
      table = $('.table').DataTable({
        processing: true,
        autoWidth: false, 
        ajax: {
          url: '/websites/json',
        },
        columns: [
          {data: 'web_name'},
          {data: 'web_date'},
          {data: 'web_type'},
          {data: 'web_category'},
        ]
      });
    });
</script>
@endpush