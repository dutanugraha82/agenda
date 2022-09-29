@extends('master')
@section('pageTitle')
    Units Data
@endsection
@section('content')
    <div class="container my-3">
        <a class="btn text-white" style="background-color:blueviolet;" href="/superadmin/input-unit">+ Add Unit</a>
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
                    <th scope="col">No</th>
                    <th scope="col">Unit Name</th>
                    <th scope="col">Url</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($data as $row)
            <tr>
                <th scope="row">{{ $row->id }}</th>
                    <td>{{ $row->unit_name }}</td>
                    <td>{{ $row->url}}</td>
                    <td>{{ $row->created_at->format('D M Y') }}</td>
                <td>
                    <form action="/superadmin/delete-unit/{{ $row->id}}" method="post">
                        @method('delete')
                        @csrf
                        <div class="container text-center">
                            <a href="/superadmin/input/edit/{{ $row->id}}" class="btn btn-sm btn-warning">Edit</a>
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
@endsection
