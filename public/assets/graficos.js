


$(function() {

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    jQuery.ajax({
        type: "POST",
        url: "filtrar_ajax",
        data: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
        success: function(data)
        {
            console.log(data.teste);
            var options = {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true
                    },
                    gridLines: {
                      color: "rgba(204, 204, 204,0.1)"
                    }
                  }],
                  xAxes: [{
                    gridLines: {
                      color: "rgba(204, 204, 204,0.1)"
                    }
                  }]
                },
                legend: {
                  display: false
                },
                elements: {
                  point: {
                    radius: 0
                  }
                }
              };
              var backgroundColor = [];
              var borderColor = [];

              const coresbackgroundColor = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
              ];

              const coresborderColor = [
                'rgba(255, 99, 132, 0.3)',
                'rgba(54, 162, 235, 0.3)',
                'rgba(255, 206, 86, 0.3)',
                'rgba(75, 192, 192, 0.3)',
                'rgba(153, 102, 255, 0.3)',
                'rgba(255, 159, 64, 0.3)',
              ]

              var indexCorbackground= 0;
              for(var i = 0; i < data.teste.length; i++)
              {
                backgroundColor.push(coresbackgroundColor[indexCorbackground]);
                indexCorbackground++;

                if(indexCorbackground == 6){
                    indexCorbackground = 0;
                }
              }
              console.log(backgroundColor);

              var indexborderColor= 0;
              for(var i = 0; i < data.teste.length; i++)
              {
                borderColor.push(coresborderColor[indexborderColor]);
                indexborderColor++;

                if(indexborderColor == 6){
                    indexborderColor = 0;
                }
              }
              console.log(borderColor);


              var valor = 5.0668;
              var valorFormatado2 = valor.toLocaleString('pt-BR', { minimumFractionDigits: 2});

            var data = {

                labels: data.teste,
                datasets: [{
                  label: 'Valor R$',
                  data: data.valores,
                  backgroundColor: backgroundColor,
                  borderColor: borderColor,
                  borderWidth: 1,
                  fill: false
                }]
              };

        // Get context with jQuery - using jQuery's .get() method.
        if ($("#barChart").length) {
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
              type: 'bar',
              data: data,
              options: options
            });
          }

        }
    });




});

