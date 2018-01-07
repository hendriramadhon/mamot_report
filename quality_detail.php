<html>
<head>
  <title>
  </title>
      <script src="lib/jquery/jquery-3.2.1.min.js"></script>
      <script>
      $(function(){

        $('tr').each(function(){
          var col_val = $(this).find('td:eq(6)').text();
          if (col_val == 'High Dirty Raw Coal'){
            console.log(col_val);
            $(this).addClass('green');  //the selected class colors the row green//
          } else if (col_val == 'Medium Dirty Raw Coal'){
            $(this).addClass('red');
          }
        });
      });
      </script>
      <style>
      #quality {
        border-collapse: collapse;

      }
      #quality th{
        font-family: cursive;
        font-size: 15;
        background-color:#eda1d1;
        border: 1px solid black;
        padding: 5px;
      }
      #quality td{
        border: 1px solid black;
        border-collapse: collapse;
        padding: 5px;

      }
      #quality td{
        font-family: cursive;
        font-size: 15;
      }
      .green{
        background-color:#b8f9a9;
      }
      .red{
        background-color:#f9e7a9;
      }
      .pointer {
          cursor: pointer;
      }
      </style>

</head>
<body>

  <?php

  $host        = "host = 127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname = db_tta";
   $credentials = "user = hend password=pmm300390";

   $conn = pg_connect( "$host $port $dbname $credentials"  );
   if(!$conn) {
      echo "Error : Unable to open database\n";
   }
  $query = "SELECT jm.name AS jenis_material
  ,*
  FROM vw_cps_composite_quality_mtd mm
  LEFT JOIN tta_coal_prod_stat_jenis_material AS jm
  ON jm.id=mm.jenis_material_id
  WHERE periode_month is not null";

  $result = pg_query($conn, $query);
  if (!$result) {
    echo "Error : Unable to access Table\n";
    exit;
  }
  else {
    $counter=0;
    echo "<table border='1' id='quality' width='100%'>";
      echo "<tr>";
        echo "<th rowspan='2'>"."No"."</th>";
        echo "<th rowspan='2'>"."Date"."</th>";
        echo "<th rowspan='2'>"."Stockpile"."</th>";
        echo "<th rowspan='2'>"."SP. Aging (Days)"."</th>";
        echo "<th rowspan='2'>"."Mat. Aging (Days)"."</th>";
        echo "<th rowspan='2'>"."Periode"."</th>";
        echo "<th rowspan='2'>"."Material"."</th>";
        echo "<th rowspan='2'>"."Volume(MT)"."</th>";
        echo "<th rowspan='2'>"."Class"."</th>";
        echo "<th rowspan='2'>"."Calori"."</th>";
        echo "<th rowspan='2'>"."TS"."</th>";
        echo "<th rowspan='2'>"."Ash"."</th>";
        echo "<th rowspan='2'>"."MF"."</th>";
        echo "<th colspan='4'>"."Composite"."</th>";
      echo "</tr>";
      echo "<tr>";
        echo "<th>"."Calori"."</th>";
        echo "<th>"."TS"."</th>";
        echo "<th>"."Ash"."</th>";
        echo "<th>"."MF"."</th>";
      echo "</tr>";
    $counter=0;
    while ($row = pg_fetch_assoc($result)) {
      $class=$row['jenis_material_id'];
      echo "<tr class='value'>";
        echo "<td>".++$counter."</td>";
        echo "<td>".$row['date_movement']."</td>";
        echo "<td>".$row['stockpile']."</td>";
        echo "<td>".$row['stockpile_aging']."</td>";
        date_default_timezone_set('US/Central');
        $date1=date_create($row['date_movement']);
        $date2=new DateTime();
        $interval=date_diff($date2,$date1);
        echo "<td>".$interval->format('%R%a')."</td>";
        echo "<td>".$row['periode_month']."</td>";
        echo "<td>".$row['jenis_material']."</td>";
        echo "<td>".number_format($row['amount_to'],0)."</td>";
        echo "<td>".$row['coal_spec_class_mtd']."</td>";
        echo "<td>".number_format($row['cal'],2)."</td>";
        echo "<td>".$row['ts']."</td>";
        echo "<td>".$row['ash']."</td>";
        echo "<td>".$row['mf']."</td>";
        echo "<td>".number_format($row['sum_product_cal'],2)."</td>";
        echo "<td>".number_format($row['sum_product_ts'],2)."</td>";
        echo "<td>".number_format($row['sum_product_ash'],2)."</td>";
        echo "<td>".number_format($row['sum_product_mf'],2)."</td>";

      echo "<tr>";



    }
    echo "</table>";
    echo "

    ";
  }


  ?>
  
</body>
</html>
