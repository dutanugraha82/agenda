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
        </div
    @endif
    <div class="container">
        <table class="table table-hover">
            <thead>
               <tr>
                    <th scope="col">No</th>
                    <th scope="col">Unit Name</th>
                    <th scope="col">Url</th>
                    <th scope="col">Dibuat</th>
                    <th width="280px" scope="col">Aksi</th>
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
                <td>

                    <a href="/superadmin/input/edit/{{ $row->id}}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/superadmin/delete-unit/{{ $row->id}}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                            Delete
                        </button>
                    </form>

                </td>
                        {{--  <a class="btn btn-info" href="">Show</a>
                        <a class="btn btn-primary" href="">Edit
                            <i class="fa fa-pencil"></i>
                        </a>
                    <form action="" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>  --}}
                </td>
            </tr>
            @endforeach

              {{--  <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>  --}}
              {{--  <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr>  --}}
            </tbody>
          </table>
    </div>
@endsection
