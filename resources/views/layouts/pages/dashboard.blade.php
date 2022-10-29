@extends('master')
@section('pageTitle')
    Agenda Report
@endsection
@section('content')
    <div class="container">
        <div class="row" style="padding-top: 5%; padding-bottom:10%">
            <div class="col-md-4">
                <div class="card mx-auto text-center shadow p-4" style="width: 18rem;">
                    <i class="nav-icon fa fa-4x fa-calendar"></i>
                    <div class="card-body">
                        <h5>Activities</h5>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <p>Data Pending</p>
                                <h4>{{ $dataActivitiesPending }}</h4>
                            </div>
                            <div class="col-6">
                                <p>Total Data</p>
                                <h4>{{ $dataActivities }}</h4>
                            </div>
                        </div>
                        <p class="my-3">Data Published : {{  $dataActivitiesPublish }}</p>
                        @if (auth()->user()->role == "admin_univ")
                        <a href="/adminuniv/activities/pending" class="btn btn-primary mt-3">Go to Activities</a> 
                        @elseif (auth()->user()->role == "super_admin")
                        <a href="/superadmin/activities/pending" class="btn btn-primary mt-3">Go to Activities</a>
                        @endif
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card mx-auto text-center shadow p-4" style="width: 18rem;">
                    <i class="nav-icon fa fa-4x fa-user-tag"></i>
                    <div class="card-body">
                        <h5>Social Media</h5>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <p>Data Pending</p>
                                <h4>{{ $dataSocMedPending }}</h4>
                            </div>
                            <div class="col-6">
                                <p>Total Data</p>
                                <h4>{{ $dataSocMed }}</h4>
                            </div>
                        </div>
                        <p class="my-3">Data Published : {{  $dataSocMedPublish }}</p>
                        @if (auth()->user()->role == "admin_univ")
                        <a href="/adminuniv/social-media/pending" class="btn btn-primary mt-3">Go to Social Media</a>
                        @elseif (auth()->user()->role == "super_admin")
                        <a href="/superadmin/social-media/pending" class="btn btn-primary mt-3">Go to Social Media</a>
                        @endif
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card mx-auto shadow text-center p-4" style="width: 18rem;">
                    <i class="nav-icon fa fa-4x fa-globe"></i>
                    <div class="card-body">
                        <h5>Websites</h5>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <p>Data Pending</p>
                                <h4>{{ $dataWebsitesPending }}</h4>
                            </div>
                            <div class="col-6">
                                <p>Total Data</p>
                                <h4>{{ $dataWebsites }}</h4>
                            </div>
                        </div>
                        <p class="my-3">Data Published : {{  $dataWebsitesPublish }}</p>
                        @if (auth()->user()->role == "admin_univ")
                        <a href="/adminuniv/website/pending" class="btn btn-primary mt-3">See Data Website</a> 
                        @elseif (auth()->user()->role == "super_admin")
                        <a href="/superadmin/website/pending" class="btn btn-primary mt-3">See Data Website</a>
                        @endif
                    </div>
            </div>
        </div>
    </div>
@endsection