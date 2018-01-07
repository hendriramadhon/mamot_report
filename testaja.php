<html>
<head>
  <title>
  </title>
  <script>
  window.onload = function() {
    var chart_coal_index = c3.generate({
      bindto: '#chartx'
      ,data: {
          x:'date',
          url: 'data_coal_index.csv',
          type: 'line',
          labels: true
      }
      ,axis:{
        x:{
          type:'timeseries'
          ,tick:{
            format:'%Y-%m-%d'
          }
        }
      }
    });
  }
  </script>
  <script type="text/javascript" src="lib/d3/d3.js"></script>
  <script type="text/javascript" src="lib/d3/d3.min.js?v=3.2.8"></script>
  <script type="text/javascript" src="lib/c3/c3.js"></script>
  <link href="lib/c3/c3.css" rel="stylesheet" type="text/css">
</head>

<body>

  <?php
  echo "&";
  ?>
  &
  <div id='chartContainer' style='height: 200; width: 300;'>
    <div id='chartx'></div>
  </div>

  <script>

  </script>

</body>
</html>
