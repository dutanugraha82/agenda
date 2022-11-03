@extends('master')
@section('pageTitle')
     Diagram Laporan Data
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card p-2 mx-auto">
                    <div class="card-header">
                        <h3 class="text-center">Rekaman Total Data Situs Masuk</h3>
                    </div>
                    <div>
                        <canvas id="websitesChart"></canvas>
                      </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-2 mx-auto">
                    <div class="card-header">
                        <h3 class="text-center">Rekaman Total Data Aktivitas Masuk</h3>
                    </div>
                    <div>
                        <canvas id="activitiesChart"></canvas>
                      </div>
                </div>
            </div>
           
        </div>
            <div style="width:1000px" class="card p-2 mx-auto mt-4">
                <div class="card-header">
                    <h3 class="text-center">Rekaman Total Data Media Sosial Masuk</h3>
                </div>
                <div>
                    <canvas id="socialMediaChart"></canvas>
                  </div>
            </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labelsWebsite = <?php echo json_encode($unitWebsites) ?>
  
    const dataWebsite = {
      labels: labelsWebsite,
      datasets: [{
        label: 'Websites Report',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: <?php echo json_encode($totalWebsites)?>,
      }]
    };
  
    const chartWebsite = {
      type: 'bar',
      data: dataWebsite,
      options: {}
    };

    const website = new Chart(
    document.getElementById('websitesChart'),
    chartWebsite
  );

const labelsActivities = <?php echo json_encode($unitActivities) ?>

  const dataActivities = {
      labels: labelsActivities,
      datasets: [{
        label: 'Activities Report',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: <?php echo json_encode($totalActivities)?>,
      }]
    };

    const chartActivities = {
      type: 'bar',
      data: dataActivities,
      options: {}
    };

    const activities = new Chart(
    document.getElementById('activitiesChart'),
    chartActivities
  );
  
  const labelsSocialMedia = <?php echo json_encode($unitSocMed) ?>
  
    const dataSocialMedia = {
        labels: labelsSocialMedia,
        datasets: [{
          label: 'Social Media Report',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: <?php echo json_encode($totalSocMed)?>,
        }]
      };
  
      const chartSocialMedia = {
        type: 'bar',
        data: dataSocialMedia,
        options: {}
      };
  
      const socialMedia = new Chart(
      document.getElementById('socialMediaChart'),
      chartSocialMedia
    );
  </script>
  
@endpush