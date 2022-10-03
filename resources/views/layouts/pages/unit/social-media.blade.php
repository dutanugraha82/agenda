@extends('master')
@section('pageTitle')
    Data Unit Social Media
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="container my-3">
                <a class="btn text-white" style="background-color:blueviolet;" href="/superadmin/input-unit-socmed">+ Add Unit Social Media</a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif
            <div class="container">
                <table class="table table-hover">
                    <thead>
                       <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Unit Name</th>
                            <th scope="col">Url</th>
                            <th scope="col">Created at</th>
                            <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($dataUnit as $row)
                    <tr>
                        <th scope="row">{{ $row->name_unit_socmed }}</th>
                            <td>{{ $row->Unit->unit_name }}</td>
                            <td>{{ $row->url}}</td>
                            <td>{{ $row->Unit->created_at->format('D M Y') }}</td>
                        <td>
                            <form action="/superadmin/delete-socmed/{{ $row->id}}" method="post">
                                @method('delete')
                                @csrf
                                <div class="container text-center">
                                    <a href="/superadmin/edit-socmed/{{ $row->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger " data-toggle="modal" data-target="#delete">
                                        Delete
                                    </button>
                                </div>
                                </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection