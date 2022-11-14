$(".dial").knob({
    'min':0,
    'max':100,
    'readOnly': true,
    'width': 175,
    'height': 200,
});

// Sales chart
var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
// $('#revenue-chart').get(0).getContext('2d');

var salesChartData = {
  labels: ['January', 'February', 'March', 'April'],
  datasets: [
    {
      label: 'Digital Goods',
      backgroundColor: 'rgba(60,141,188,0.9)',
      borderColor: 'rgba(60,141,188,0.8)',
      pointRadius: false,
      pointColor: '#3b8bba',
      pointStrokeColor: 'rgba(60,141,188,1)',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data: [28, 48, 40, 19]
    },
    {
      label: 'Electronics',
      backgroundColor: 'rgba(210, 214, 222, 1)',
      borderColor: 'rgba(210, 214, 222, 1)',
      pointRadius: false,
      pointColor: 'rgba(210, 214, 222, 1)',
      pointStrokeColor: '#c1c7d1',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data: [65, 59, 80, 81]
    }
  ]
}

var salesChartOptions = {
  maintainAspectRatio: false,
  responsive: true,
  legend: {
    display: false
  },
  scales: {
    xAxes: [{
      gridLines: {
        display: false
      }
    }],
    yAxes: [{
      gridLines: {
        display: false
      }
    }]
  }
}

// This will get the first returned node in the jQuery collection.
// eslint-disable-next-line no-unused-vars
var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
  type: 'line',
  data: salesChartData,
  options: salesChartOptions
});

var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
                                        var yValues = [55, 49, 44, 24, 15];
                                        var barColors = [
                                          "#b91d47",
                                          "#00aba9",
                                          "#2b5797",
                                          "#e8c3b9",
                                          "#1e7145"
                                        ];
                                        
                                        new Chart("mychart-1", {
                                          type: "pie",
                                          data: {
                                            //labels: xValues,
                                            datasets: [{
                                              backgroundColor: barColors,
                                              data: yValues
                                            }]
                                          }
                                        });

                                        var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
                                        var yValues = [55, 49, 44, 24, 15];
                                        var barColors = [
                                          "#b91d47",
                                          "#00aba9",
                                          "#2b5797",
                                          "#e8c3b9",
                                          "#1e7145"
                                        ];
                                        
                                        new Chart("mychart-2", {
                                          type: "pie",
                                          data: {
                                            //labels: xValues,
                                            datasets: [{
                                              backgroundColor: barColors,
                                              data: yValues
                                            }]
                                          }
                                        });


                                        var ticksStyle = {
                                            fontColor: '#495057',
                                            fontStyle: 'bold'
                                          }
      
                                          var mode = 'index'
                                          var intersect = true
      
                                          var $salesChart = $('#sales-chart')
                                          // eslint-disable-next-line no-unused-vars
                                          var salesChart = new Chart($salesChart, {
                                            type: 'bar',
                                            data: {
                                              labels: ['JUN', 'JUL'],
                                              datasets: [
                                                {
                                                  backgroundColor: 'blue',
                                                  borderColor: '#007bff',
                                                  data: [1000, 2000]
                                                },
                                                {
                                                  backgroundColor: 'orange',
                                                  borderColor: '#ced4da',
                                                  data: [700, 1700]
                                                }
                                              ]
                                            },
                                            options: {
                                              maintainAspectRatio: false,
                                              tooltips: {
                                                mode: mode,
                                                intersect: intersect
                                              },
                                              hover: {
                                                mode: mode,
                                                intersect: intersect
                                              },
                                              legend: {
                                                display: false
                                              },
                                              scales: {
                                                yAxes: [{
                                                  // display: false,
                                                  gridLines: {
                                                    display: true,
                                                    lineWidth: '4px',
                                                    color: 'rgba(0, 0, 0, .2)',
                                                    zeroLineColor: 'transparent'
                                                  },
                                                  ticks: $.extend({
                                                    beginAtZero: true,
      
                                                    // Include a dollar sign in the ticks
                                                    callback: function (value) {
                                                      return value
                                                    }
                                                  }, ticksStyle)
                                                }],
                                                xAxes: [{
                                                  display: true,
                                                  gridLines: {
                                                    display: false
                                                  },
                                                  ticks: ticksStyle
                                                }]
                                              }
                                            }
                                          })