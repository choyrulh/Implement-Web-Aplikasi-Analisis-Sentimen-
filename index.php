
<!DOCTYPE html>
<html>
  <head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.0/chart.js" integrity="sha512-dMZihiwDKQBWhUkLvTvGzbOGLoNdFzZhdYRCFOsIbsDQkyakukI3vjB6SpR0iUTwUK7delljKsqfFF50ZWAgwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Grafik</title>
    <style>
      canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
      }
      .chart-container {
        background-color: #D9E2EC;
        display: flex;
        margin: 0 auto;
        width: 75%;
      }
    </style>
  </head>
  <body style="background-color: #282c34;">
    <center>
    <h3 style="color:white">~Analisa Via Data Twitter~<br/>- Choirul -</h3>
    </center>
    <div class="chart-container">
      <canvas id="myChart"></canvas>
    </div>
    <script>
      var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [],
          datasets: [{
            label: 'Dukungan',
            backgroundColor: 'rgba(0, 128, 0, 0.5)',
            borderColor: 'rgba(0, 128, 0, 0.5)',
            data: [],
            fill: false
          }, {
            label: 'Tidak Mendukung',
            backgroundColor: 'rgba(255, 0, 0, 0.5)',
            borderColor: 'rgba(255, 0, 0, 0.5)',
            data: [],
            fill: false
          }, {
            label: 'Netral',
            backgroundColor: 'rgba(0, 0, 255, 0.5)',
            borderColor: 'rgba(0, 0, 255, 0.5)',
            data: [],
            fill: false
          }]
        },
        options: {
          responsive: true,
          tooltips: {
            mode: 'index',
            intersect: false,
          },
          hover: {
            mode: 'nearest',
            intersect: true
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Interval Waktu'
              }
            }],
            yAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Jumlah'
              }
            }]
          },
          title: {
            display: true,
            text: 'Anies Baswedan'
          }
        }
      });
      setInterval(function() {
        updateChart();
      }, 1000);
      function updateChart() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'data.php', true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState == XMLHttpRequest.DONE && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            chart.data.labels = data.labels;
            chart.data.datasets[0].data = data.dukungan;
            chart.data.datasets[1].data = data.tidakMendukung;
            chart.data.datasets[2].data = data.netral;
            chart.update();
          } else {
              console.error("Gagal parsing data dari data.php");
            }
        };
        xhr.send();
        xhr.onerror = function() {
          console.error("Gagal memuat data dari data.php");
        };
      }
</script>

  </body>
</html>