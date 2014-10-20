google.load('visualization', '1.0', {'packages': ['corechart'], 'language': 'en'});
google.setOnLoadCallback(drawChart);

function drawChart() {
  var options = {
    title: '20 GAZP',
    legend: {position: 'none'}
  };
  var jsonData = $.ajax({
    url: '/site/getData',
    dataType: 'json',
    async: false
  }).responseText;
  var data = new google.visualization.DataTable(jsonData);
  
  var chart = new google.visualization.LineChart(document.getElementById('chart-cont'));
  chart.draw(data, options);
}