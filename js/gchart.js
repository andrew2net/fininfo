google.load('visualization', '1.0', {'packages': ['corechart'], 'language': 'en'});
google.setOnLoadCallback(getChartsData);

var keys;
var chartLoc = 0;
var chart;
var chartsData = {};
//var chartTimer;

var drawChart = function () {
  var options = {
    title: chartsData[chartLoc]['title'],
    legend: {position: 'none'},
    animation: {
      duration: 1000,
      easing: 'out'
    },
  };
  chart.draw(chartsData[chartLoc]['data'], options);
  chartLoc++;
  if (chartLoc >= keys.length)
    chartLoc = 0;
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
    chart = new google.visualization.LineChart(document.getElementById('chart-cont'));
    setInterval(function () {
      drawChart();
    }, 10000);
  }
}