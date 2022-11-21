@extends('master')
@section('pageTitle')
     Tabel Laporan
@endsection
@section('content')

<form action="/adminuniv/report-by-date" method="GET">
<div class="input-group">
    <label for="from" class="form-control">Mulai Tanggal :</label>
    <input type="date" class="form-control" name="from">
    <label for="to" class="form-control">Sampai Tanggal :</label>
    <input type="date" class="form-control" name="to">
  </div>
  <div class="button-group text-center my-3">
    <button type="submit" class="btn btn-primary">Ambil Data Berdasarkan Tanggal</button>
    <button type="submit" class="btn btn-warning" onclick="window.location.reload()">Ambil Data Berdasarkan Unit</button>
  </div>

</form>
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
        <hr class="h-2">
        <div class="card-header mt-2">
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
        <hr class="h-2">
        <div class="card-header mt-2">
          <h4>Data Kegiatan</h4>
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