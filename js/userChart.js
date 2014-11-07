google.load('visualization', '1.0', {'packages': ['controls'], 'language': 'en'});
google.setOnLoadCallback(createChart);

var selectType = $('#subscription-type');
var typeDescription = $('#subscription-description');
var data;
function getChartData(type) {
  var jsonData = $.ajax({
    url: '/site/getChartData',
    dataType: 'json',
    data: {type: type},
    async: false,
  }).responseText;
  var responce = $.parseJSON(jsonData);
  typeDescription.html(responce.description);
  data = new google.visualization.DataTable(responce.data);
}

var db;
var range;
function createDashBoard() {
  db = new google.visualization.Dashboard(document.getElementById('chart-dashboard'));
  range = new google.visualization.ControlWrapper({
    'controlType': 'ChartRangeFilter',
    'containerId': 'chart-filter',
    'options': {
      'filterColumnLabel': 'Date',
      'ui': {
        'chartOptions': {
          'chartArea': {'width': '85%'},
          'hAxis': {'baselineColor': 'none'}
        },
        'minRangeSize': 7776000000
      }
    },
  });

  var chart = new google.visualization.ChartWrapper({
    'chartType': 'LineChart',
    'containerId': 'chart-user',
    'options': {
      legend: {position: 'none'},
      'curveType': 'function',
      'chartArea': {
        'width': '85%',
        'height': '80%'
      }
    }
  });

  db.bind(range, chart);
}

function createChart() {
  getChartData(selectType.find('option:selected').val());
  createDashBoard();
  db.draw(data);
}

selectType.change(function (){
  var type = $(this).find('option:selected').val();
  getChartData(type);
  var dateRange = data.getColumnRange(0);
  range.setState({start: dateRange.min, end: dateRange.max}); 
  db.draw(data);
});
