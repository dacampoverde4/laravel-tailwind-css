@extends('admin.layout.master')
@section('content')
<div class="container">
    <div id="piechart" style="width: 900px; height: 500px;"></div>
</div>
@endsection
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      var monthly_earned = <?php echo json_encode($data['monthly_earned']) ?>;
      
      function drawChart() {
        //var data = google.visualization.arrayToDataTable(monthly_earned);

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Sales Figure');
        data.addRows(monthly_earned);
        var options = {
          title: 'Monthly Earned Advertises'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>