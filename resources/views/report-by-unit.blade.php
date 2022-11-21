@extends('master')
@section('pageTitle')
     Tabel Laporan
@endsection
@section('content')
    <div class="container-fluid mt-3">
      <div class="card p-2">
        <div class="card-header">
          <h4>Data Artikel Situs</h4>
        </div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Unit Name</th>
              <th>Pending</th>
              <th>Reject</th>
              <th>Publish</th>
            </tr>
          </thead>
          <tbody>
            @foreach($websites as $item)
            <tr>
                  <td style="font-size: 1.3em">{{ $item->unit_name }}</td>
                  <td style="font-size: 1.3em">{{ $item->pending }}</td>
                  <td style="font-size: 1.3em">{{ $item->reject }}</td>
                  <td style="font-size: 1.3em">{{ $item->publish }}</td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="container-fluid mt-4">
      <div class="card p-2">
        <div class="card-header">
          <h4>Data Media Sosial</h4>
        </div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Unit Name</th>
              <th>Pending</th>
              <th>Reject</th>
              <th>Publish</th>
            </tr>
          </thead>
          <tbody>
            @foreach($socialMedia as $item)
            <tr>
                  <td style="font-size: 1.3em">{{ $item->unit_name }}</td>
                  <td style="font-size: 1.3em">{{ $item->pending }}</td>
                  <td style="font-size: 1.3em">{{ $item->reject }}</td>
                  <td style="font-size: 1.3em">{{ $item->publish }}</td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="container-fluid mt-4">
      <div class="card p-2">
        <div class="card-header">
          <h4>Data Aktifitas</h4>
        </div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Unit Name</th>
              <th>Pending</th>
              <th>Reject</th>
              <th>Publish</th>
            </tr>
          </thead>
          <tbody>
            @foreach($activities as $item)
            <tr>
                  <td style="font-size: 1.3em">{{ $item->unit_name }}</td>
                  <td style="font-size: 1.3em">{{ $item->pending }}</td>
                  <td style="font-size: 1.3em">{{ $item->reject }}</td>
                  <td style="font-size: 1.3em">{{ $item->publish }}</td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection