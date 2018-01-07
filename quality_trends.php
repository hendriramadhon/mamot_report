<html>
<head>
  <title>
  </title>
      <script type="text/javascript" src="lib/d3/d3.js"></script>
      <script type="text/javascript" src="lib/d3/d3.min.js?v=3.2.8"></script>
      <script type="text/javascript" src="lib/c3/c3.js"></script>
      <script src="lib/jquery/jquery-3.2.1.min.js"></script>
      <script src="lib/jquery/jquery-ui.js"></script>
      <link href="lib/c3/c3.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="lib/css/jquery-ui.css">
      <script>
      $( function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
      } );
      </script>
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
  $query = "SELECT blg.id,blg.group FROM tta_coal_prod_stat_block_group AS blg
  ORDER BY blg.group ASC";
    $result = pg_query($conn, $query);
    if ($result) {
      $row = pg_fetch_all($result);
      $blgs=$row;
    }

  $query = "SELECT elg.id,elg.group FROM tta_coal_prod_stat_elevation_group AS elg
  ORDER BY elg.group DESC";
    $result = pg_query($conn, $query);
    if ($result) {
      $row = pg_fetch_all($result);
      $elgs=$row;
      $elevgs=$row;
    }

  $query = "SELECT sea.id,sea.group FROM tta_coal_prod_stat_seam_group AS sea
  ORDER BY sea.group ASC";
    $result = pg_query($conn, $query);
    if ($result) {
      $row = pg_fetch_all($result);
      $seas=$row;
    }

  $query = "SELECT ply.id,ply.number FROM tta_coal_prod_stat_number_of_ply AS ply
  ORDER BY ply.number ASC";
    $result = pg_query($conn, $query);
    if ($result) {
      $row = pg_fetch_all($result);
      $plys=$row;
    }

  $query = "SELECT DISTINCT sam.date FROM tta_coal_prod_stat_sampling AS sam
  ORDER BY sam.date DESC";
    $result = pg_query($conn, $query);
    if ($result) {
      $row = pg_fetch_all($result);
      $sams=$row;
    }

  $query = "SELECT lab.id,lab.name FROM tta_coal_prod_stat_labs AS lab
  ORDER BY lab.name ASC";
    $result = pg_query($conn, $query);
    if ($result) {
      $row = pg_fetch_all($result);
      $labs=$row;
    }
  $query = "SELECT are.id,are.name FROM tta_coal_prod_stat_area AS are WHERE are.jenis_area_id='1'
    ORDER BY are.name ASC";
      $result = pg_query($conn, $query);
      if ($result) {
        $row = pg_fetch_all($result);
        $pits=$row;
      }

  echo "<form id='form_q' action='' method='post'>";
  echo "<table>";
  echo "<tr>";
  echo "<td>"."Pit"."</td>";
  echo "<td><select name='pit[]' multiple='multiple'>";
  foreach ($pits as $pit) {
    echo "<option value='".$pit['id']."'>".$pit['name']."</option>";
  }
  echo "<td>"."Seam"."</td>";
  echo "<td><select name='seam[]' multiple='multiple'>";
  foreach ($seas as $sea) {
    echo "<option value='".$sea['group']."'>".$sea['group']."</option>";
  }
  echo "<td>"."Ply"."</td>";
  echo "<td><select name='ply[]' multiple='multiple'>";
  foreach ($plys as $ply) {
    echo "<option value='".$ply['number']."'>".$ply['number']."</option>";
  }
  echo "<td>"."Lab"."</td>";
  echo "<td><select name='lab[]' multiple='multiple'>";
  $lab_dict=array();
  foreach ($labs as $lab) {
    echo "<option value='".$lab['id']."'>".$lab['name']."</option>";
    $lab_dict[$lab['id']]=$lab['name'];
  }
  echo "</select></td>";
  echo "<td>"."Sampling Date"."</td>";
  echo "<td>"."<input id='datepicker1' name='datepicker1' type='text' />"."</td>";
  echo "<td>"."-<input id='datepicker2' name='datepicker2' type='text' />"."</td>";
  echo "<td>"."<input type='submit' value='view' />"."</td>";
  echo "</tr>";
  echo "</table>";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['seam']))
    {
      foreach ($_POST['seam'] as $seam)
      {
        if(!empty($_POST['ply']))
        {
          foreach ($_POST['ply'] as $ply)
          {
            if(!empty($_POST['lab']))
            {
              foreach ($_POST['lab'] as $lab)
                {
                  if(!empty($_POST['datepicker1']) && !empty($_POST['datepicker2']))
                  {
                    $date1=($_POST['datepicker1']);
                    $date2=($_POST['datepicker2']);
                    $query = "SELECT DISTINCT jenis_spec_item_id,jenis_spec_item
                    FROM vw_cps_cg_quality AS q
                    WHERE sampling_date BETWEEN '$date1' AND '$date2'
                    AND seam='$seam'
                    AND ply='$ply'
                    AND lab_id='$lab'";
                    // echo $query;
                      $result = pg_query($conn, $query);
                      if ($result) {
                        while ($row = pg_fetch_assoc($result)) {
                          $data=array();
                          $elevation=array();
                          $counter=0;
                          $jenis=$row['jenis_spec_item'];
                          $jid=$row['jenis_spec_item_id'];
                          $query = "SELECT block,elevation,seam,ply,amount
                          FROM vw_cps_cg_quality AS q
                          WHERE sampling_date BETWEEN '$date1' AND '$date2'
                          AND seam='$seam'
                          AND ply='$ply'
                          AND lab_id='$lab'
                          AND jenis_spec_item_id='$jid'";
                          $result2 = pg_query($conn, $query);
                          if ($result2) {
                            $jitem=pg_fetch_all($result2);
                          }
                          echo "<table border='0' width='100%'>";
                            echo "<tr>";
                              echo "<td>";

                            echo "<table id='quality' width='300'>";
                            $colspan=count($blgs)+1;
                              $colspan2=count($blgs)+2;
                              $rowspan=count($elgs)+2;
                              echo "<tr>";
                                echo "<th colspan='$colspan2'>";
                                echo $lab_dict[$lab];
                                echo "</th>";
                              echo "<tr>";
                              echo "<tr>";
                                echo "<th colspan='$colspan2' style='text-align:center;
                                font-weight: bold;background-color:#c842f4;'>";
                                echo "Seam:".$seam.";Ply:".$ply.";Spec:".$jenis;
                                echo "</th>";
                              echo "<tr>";
                              echo "<tr>";
                              echo "<th style='writing-mode: tb-rl;width:20px;
                              background-color:#c8b0fc;'rowspan=".$rowspan
                              .">ELEVATION";
                              echo "</th>";
                              echo "<td style='text-align:center;
                              font-weight: bold;background-color:#ff7979;' colspan="
                              .$colspan.">BLOCK</td>";
                              echo "</tr>";
                              for ($i=0;$i<count($elgs);$i++) {
                                if($i==0)
                                {
                                  echo "<tr >";
                                    echo "<th ></th >";
                                    for ($j=0;$j<count($blgs);$j++) {
                                        echo "<th >";
                                        echo $blgs[$j]['group'];
                                        echo "</th >";
                                    }
                                  echo "</tr >";
                                }

                                echo "<tr >";
                                for ($j=0;$j<count($blgs);$j++) {
                                    if($j==0)
                                    {
                                      echo "<td style='width:30px;height:30px;background-color:#eda1d1;'>"
                                      .$elgs[$i]['group'];
                                      echo "</td>";
                                    }
                                    echo "<td style='background-color:#996633;color:white;'>";

                                    //LAST EDIT HERE
                                    foreach ($jitem as $ji) {
                                        if($ji['elevation']==$elgs[$i]['group']
                                        && $ji['block']==$blgs[$j]['group'])
                                        {
                                          if($counter==0)
                                          {
                                            $data[$counter]=$jenis;
                                            $elevation[$counter]='elevation';
                                            $counter++;
                                          }
                                          $data[$counter]=$ji['amount'];
                                          $elevation[$counter]=$ji['elevation'];
                                          $counter++;
                                          echo $ji['amount'];
                                        }
                                    }
                                    echo "</td>";
                                }
                                echo "</tr>";
                              }
                              echo "</table>";
                                echo "</td>";
                                echo "<td>";
                                echo "
                                <div id='chartContainer' style='height: 100%; width: 100%;'>
                                  <div style='height: 100%; width: 500;'
                                  id='chart$lab$seam$ply$jenis'></div>
                                </div>
                                ";
                                echo "</td>";
                              echo "</tr>";
                            echo "</table>";

                            echo "<br />";


                            echo "<script>";
                            $data_graph=array();
                            for ($i=0;$i<count($blgs);$i++) {
                              $b=$blgs[$i]['group'];
                              echo "var data_graph$i=['b$b'";
                              for ($j=0;$j<count($elgs);$j++){
                                $val=0;
                                foreach ($jitem as $ji) {
                                  if($ji['elevation']==$elgs[$j]['group']
                                  && $ji['block']==$blgs[$i]['group'])
                                  {
                                    $val=$ji['amount'];
                                    break;
                                  }
                                }
                                $e=$elgs[$j]['group'];
                                $data_graph[$b][$e]=$val;
                                echo ",'$val'";
                                // echo "$e $b $val <br />";
                              }
                              echo "];";
                            }

                            echo "var elev=['elevation'";
                            for ($i=0;$i<count($elgs);$i++){
                              $elev=$elgs[$i]['group'];
                              echo ",'$elev'";
                            }
                            echo "];";

                            echo "var dt=[elev";
                            for ($i=0;$i<count($blgs);$i++) {
                              echo ",data_graph$i";
                            }
                            echo "];";

                            echo "
                            var chart_ob = c3.generate({
                              bindto: '#chart$lab$seam$ply$jenis'
                              ,data: {
                                  x:'elevation',
                                  labels:true,
                                  columns: dt,
                              }
                              ,axis: {
                                x: {
                                    label: 'Elevation'
                                },
                                y: {
                                    label: '$jenis'
                                },

                            }

                            });
                            ";
                            echo "</script>";
                        }

                      }
                  }


                }
            }

          }
        }
      }
    }
  }

  echo "</form>";

  ?>
  <script>
  // TODO 2.3 - Register the service worker
if ('serviceWorker' in navigator) {
navigator.serviceWorker.register('service-worker.js')
.then(function(registration) {
console.log('Registered:', registration);
})
.catch(function(error) {
console.log('Registration failed: ', error);
});
}
      </script>
</body>
</html>
