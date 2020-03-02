const $ = require('jquery');

  function getData() {

      $.ajax({
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
          url: "/api/statistics",
          method: "GET",
          data:{
            param: $('.graphic').attr('data-apartment')
          },
          success: function (data) {
              statisticsPrint(data.views, 'myChart');
              statisticsPrint(data.messages, 'myChart-1');
           console.log(data); //debug

          },
          error: function (error) {
              console.log("error", error);
          }
      });
  }

  function statisticsPrint(data, id) {

      var ctx = document.getElementById(id).getContext("2d");
      var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: data.dates,
              datasets: [{
                  label: "Dati Statistiche",
                  data: data.numbers,
                  backgroundColor: [
                      'rgba(255, 90, 96, 0.2)',
                  ],
                  borderColor: [
                      'rgba(255, 90, 96, 1)',
                  ],
                  borderWidth: 2
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });
  }

  function init() {
      getData();
  }
  $(document).ready(init);
