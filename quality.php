<html>
<head>
  <title>
  </title>
      <script src="lib/jquery/jquery-3.2.1.min.js"></script>
      <style>
      .pointer {
          cursor: pointer;
      }
      </style>

      <style>
      #quality {
        border-collapse: collapse;

      }
      #quality th{
        font-family: cursive;
        font-size: 15;
        background-color:#eda1d1;
        border: 1px solid black;
        border-collapse: collapse;
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
  $query = "SELECT blg.group FROM tta_coal_prod_stat_block_group AS blg";
  $result = pg_query($conn, $query);
  if (!$result) {
    echo "Error : Unable to access Table\n";
    exit;
  }
  else {
    $counter=0;
    while ($row = pg_fetch_assoc($result)) {
      $blg[$counter++] = $row['group'];
    }


    $query = "SELECT elg.group FROM tta_coal_prod_stat_elevation_group AS elg ORDER BY elg.group DESC";
    $result = pg_query($conn, $query);
    if (!$result) {
      echo "Error : Unable to access Table\n";
      exit;
    }
    else {
      $counter=0;
      while ($row = pg_fetch_assoc($result)) {
        $elg[$counter++] = $row['group'];
      }
  }

  $query = "SELECT block_group,elevation_group FROM vw_cps_seam_location";
  $result = pg_query($conn, $query);
  if (!$result) {
    echo "Error : Unable to access Table\n";
    exit;
  }
  else {
    $counter=0;
    $locs=array();
    while ($row = pg_fetch_assoc($result)) {
      $loc=array();
      $loc['block_group']=$row['block_group'];
      $loc['elevation_group']=$row['elevation_group'];
      $locs[$counter++] = $loc;
    }
  }

  }

  echo "<table border='0' width='100%' >";
  echo "<tr>";
  echo "<td width='300' valign='top' >";
  echo "<table id='quality' width='300'>";
    $colspan=count($blg)+1;
    $rowspan=count($elg)+2;
    echo "<tr>";
    echo "<th style='writing-mode: tb-rl;width:20px;background-color:#c8b0fc;'rowspan=".$rowspan
    .">ELEVATION";
    echo "</th>";
    echo "<td style='text-align:center;font-weight: bold;background-color:#ff7979;' colspan="
    .$colspan.">BLOCK</td>";
    echo "</tr>";
    for ($i=0;$i<count($elg);$i++) {
      if($i==0)
      {
        echo "<tr >";
          echo "<th ></th >";
          for ($j=0;$j<count($blg);$j++) {
              echo "<th >";
              echo $blg[$j];
              echo "</th >";
          }
        echo "</tr >";
      }
      echo "<tr >";

      for ($j=0;$j<count($blg);$j++) {
          if($j==0)
          {
            echo "<td style='width:30px;height:30px;background-color:#eda1d1;'>".$elg[$i];
            echo "</td>";
          }
          echo "<td style='background-color:#996633;'>";

          $func=array();
          for($l=0;$l<count($locs);$l++)
          {
            $tmp=$locs[$l];
            if($tmp['block_group']==$blg[$j] && $tmp['elevation_group']==$elg[$i])
            {
                $id=strval($blg[$j]).strval($elg[$i]);
                if (!array_key_exists($id, $func)) {
                  $func[$id]="
                  <script>
                  $( '#$id' ).click(function() {
                    $( '.hide' ).hide();
                    $( '.info$id' ).show();
                  });
                  </script>
                  ";
                  echo "<div id='$id' class='pointer'
                  style='background-color:black;width=100%;height:100%;'></div>";
                }

            }
          }
          foreach ($func as $f) {
            echo $f;
          }
          echo "</td>";
      }
      echo "</tr>";
    }
  echo "</table>";
  echo "</td>";
  echo "<td valign='top'>";
    //physical info
    $query = "SELECT * FROM vw_cps_ply_location WHERE block_id is not null";
    $result = pg_query($conn, $query);
    if (!$result) {
      echo "Error : Unable to access Table\n";
      exit;
    }
    else {
      $counter=0;
      $locs=array();
      $func=array();
      while ($row = pg_fetch_assoc($result)) {
        $id='info'.strval($row['block']).strval($row['elevation']);

        echo "<div style='display: none;' class='$id hide'>";
        echo "<table border='0'>";
          echo "<tr>";
            echo "<td valign='top'>";
              echo "<table id='quality' width='400' >";
              echo "<tr style='background-color:#c8b0fc;'>";
                echo "<td colspan=2>";
                echo "Physical Info:";
                echo "</td>";
              echo "</tr>";
              echo "<tr style='background-color:#fff87a;'>";
                echo "<td>";
                echo "Block";
                echo "</td>";
                echo "<td>";
                echo $row['block'];
                echo "</td>";
              echo "</tr>";
              echo "<tr style='background-color:#fff87a;'>";
                echo "<td>";
                echo "Elevation";
                echo "</td>";
                echo "<td>";
                echo $row['elevation'];
                echo "</td>";
              echo "</tr>";
              echo "<tr style='background-color:#fff87a;'>";
                echo "<td>";
                echo "Seam";
                echo "</td>";
                echo "<td>";
                echo $row['seam'];
                echo "</td>";
              echo "</tr>";
              echo "<tr style='background-color:#fff87a;'>";
                echo "<td>";
                echo "Ply";
                echo "</td>";
                echo "<td>";
                echo $row['ply'];
                echo "</td>";
              echo "</tr>";
              echo "</table>";
              echo "<br />";
            echo "</td>";
            echo "<td valign='top'>";
              echo "<table id='quality'>";
              echo "<tr style='background-color:#ff7979;'>";
                echo "<td colspan=100>";
                echo "Quality Info:";
                echo "</td>";
              echo "</tr>";
              echo "<tr >";
              $conn2 = pg_connect( "$host $port $dbname $credentials"  );
              if(!$conn2) {
                 echo "Error : Unable to open database\n";
              }
              $query2 = "SELECT DISTINCT lab_id,lab,spec_id,spec_name"
              .",sampling_date,spec_class,spec_class_id"
              ." FROM vw_cps_cg_quality WHERE
               block_id='".$row['block_id']."'"
              ." AND elevation_id='".$row['elevation_id']."'"
              ." AND seam_id='".$row['seam_id']."'"
              ." AND ply_id='".$row['ply_id']."'"
              ;
              $result2 = pg_query($conn2, $query2);
              while ($row2 = pg_fetch_assoc($result2)) {
                  echo "<td>";
                  echo "<table id='quality'>";
                  echo "<tr style='background-color:#9eff9f;'>";
                  echo "<td>";
                  echo "Lab";
                  echo "</td>";
                  echo "<td>";
                  echo $row2['lab'];
                  echo "</td>";
                  echo "</tr>";

                  echo "<tr style='background-color:#9eff9f;'>";
                  echo "<td>";
                  echo "Sampling Date";
                  echo "</td>";
                  echo "<td>";
                  echo $row2['sampling_date'];
                  echo "</td>";
                  echo "</tr>";

                  echo "<tr style='background-color:#9eff9f;'>";
                  echo "<td>";
                  echo "Class";
                  echo "</td>";
                  echo "<td>";
                  echo $row2['spec_class'];
                  echo "</td>";
                  echo "</tr>";

                  $query3 = "SELECT * FROM vw_cps_cg_quality WHERE
                   block_id='".$row['block_id']."'"
                  ." AND elevation_id='".$row['elevation_id']."'"
                  ." AND seam_id='".$row['seam_id']."'"
                  ." AND ply_id='".$row['ply_id']."'"
                  ." AND lab_id='".$row2['lab_id']."'"
                  ;

                  $result3 = pg_query($conn2, $query3);

                  while ($row3 = pg_fetch_assoc($result3)) {
                    echo "<tr style='background-color:#9eff9f;'>";
                    echo "<td>";
                    echo $row3['jenis_spec_item'];
                    echo "</td>";
                    echo "<td>";
                    echo $row3['amount'];
                    echo "</td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                  echo "</td>";

              }

              pg_close($conn2);
              echo "</tr>";
              echo "</table>";
            echo "</td>";
            echo "</tr>";
          echo "</table>";
          echo "<br />";
        echo "</div>";


      }

    }
  echo "</td>";
  echo "</tr>";
  echo "</table>";





  ?>

</body>
</html>
