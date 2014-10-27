google.load('visualization', '1.0', {'packages': ['corechart'], 'language': 'en'});
google.setOnLoadCallback(getChartsData);

var keys;
var chartLoc = 0;
var chart;
var chartsData = {};
var chartOptions;

var drawChart = function () {
  chartLoc++;
  if (chartLoc >= keys.length)
    chartLoc = 0;
  chartOptions.title = chartsData[chartLoc]['title'];
  chart.draw(chartsData[chartLoc]['data'], chartOptions);
}

function getChartsData() {
  var jsonData = $.ajax({
    url: '/site/getData',
    dataType: 'json',
    async: false,
  }).responseText;
  var charts = $.parseJSON(jsonData);
  if (charts.length > 0) {
    $.each(charts, function (index, value) {
      chartsData[index] = {'title': value.title,
        'data': new google.visualization.DataTable(value.data)};
    });
    keys = Object.keys(charts);
    chartOptions = {
      title: chartsData[chartLoc]['title'],
      legend: {position: 'none'},
      animation: {
        duration: 1000,
        easing: 'out'
      },
    };
    chart = new google.visualization.LineChart(document.getElementById('chart-cont'));
    chart.draw(chartsData[chartLoc]['data'], chartOptions);
    if (charts.length > 1)
      setInterval(function () {
        drawChart();
      }, 10000);
  }
}