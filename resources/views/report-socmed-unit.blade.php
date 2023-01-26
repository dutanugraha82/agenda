@extends('master')
@section('pageTitle')
Laporan {{ $name->unit_name }}
@endsection
@section('content')
    <div class="container">
        <div class="my-3">
            <h3>Pending</h3>
            <small>total data: {{ $pending->count() }}</small>
        </div>
        <table class="table table-hover table-fixed">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Waktu</th>
                <th scope="col">Kategori</th>
              </tr>
            </thead>
            <tbody>
                @foreach($pending as $item)
                <tr>
                  <td>{{ $item->socmed_name }}</td>
                  <td>{{ $item->socmed_address }}</td>
                  <td>{{ $item->socmed_date }}</td>
                  <td>{{ $item->socmed_category }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    <div class="container my-3">
        <div class="my-3">
            <h3>Reject</h3>
            <small>total data: {{ $reject->count() }}</small>
        </div>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Waktu</th>
                <th scope="col">Kategori</th>
              </tr>
            </thead>
            <tbody>
                @foreach($reject as $item)
                <tr>
                  <td>{{ $item->socmed_name }}</td>
                  <td>{{ $item->socmed_address }}</td>
                  <td>{{ $item->socmed_date }}</td>
                  <td>{{ $item->socmed_category }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    <div class="container">
        <div class="my-3">
            <h3>Publish</h3>
            <small>total data: {{ $publish->count() }}</small>
        </div>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Waktu</th>
                <th scope="col">Kategori</th>
              </tr>
            </thead>
            <tbody>
                @foreach($publish as $item)
                <tr>
                  <td>{{ $item->socmed_name }}</td>
                  <td>{{ $item->socmed_address }}</td>
                  <td>{{ $item->socmed_date }}</td>
                  <td>{{ $item->socmed_category }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    <div class="my-5">
        <a href="/superadmin/socmed/report" class="btn btn-warning">Kembali</a>
    </div>
@endsection