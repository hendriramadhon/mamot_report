<html>
<head>
  <title>
  </title>
      <script src="lib/jquery/jquery-3.2.1.min.js"></script>
      <script src="lib/jquery/jquery-ui.js"></script>
      <script type="text/javascript" src="lib/d3/d3.js"></script>
      <script type="text/javascript" src="lib/d3/d3.min.js?v=3.2.8"></script>
      <script type="text/javascript" src="lib/c3/c3.js"></script>
      <link href="lib/c3/c3.css" rel="stylesheet" type="text/css">
      <script>

      $(function(){
        $('#modal_spec').css({
          position: "absolute",
          top: "500px",
          left: "1100px"
        }).show();
        $('#modal_spec').draggable();

        $('#modal_pit').css({
          position: "absolute",
          top: "30px",
          left: "50px"
          }).show();
        $('#modal_pit').draggable();

        $('#modal_rom').css({
          position: "absolute",
          top: $('#modal_pit').position().top,
          left: $('#modal_pit').position().left+$('#modal_pit').width()+10
          }).show();
        $('#modal_rom').draggable();

        $('#modal_cpp').css({
          position: "absolute",
          top: $('#modal_rom').position().top,
          left: $('#modal_rom').position().left+$('#modal_rom').width()+110
          }).show();
        $('#modal_cpp').draggable();

        $('#modal_port').css({
          position: "absolute",
          top: $('#modal_cpp').position().top,
          left: $('#modal_cpp').position().left+$('#modal_cpp').width()+110
          }).show();
        $('#modal_port').draggable();

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
        #modal_spec{
            /*border:4px solid #CCC;*/
            width:200px;
            height:250px;
            display:none;
            position:absolute;
            left:50%;
            top:50%;
            margin:-25px 0 0 -50px;
            border-radius:5px;
            background-color: white;
        }
        #tab_spec {
          border-collapse: collapse;

        }
        #tab_spec th{
          font-family: cursive;
          font-size: 15;
          background-color:#963aff;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_spec td{
          border: 1px solid black;
          border-collapse: collapse;
          padding: 0px;

        }
        #tab_spec td{
          font-family: cursive;
          font-size: 15;
        }

        #modal_pit{
            /*border:4px solid #CCC;*/
            width:400px;
            height:100px;
            display:none;
            position:absolute;
            left:50%;
            top:50%;
            margin:-25px 0 0 -50px;
            border-radius:5px;
        }
        #tab_pit {
          border-collapse: collapse;
        }
        #tab_pit .head1{
          font-family: cursive;
          font-size: 20;
          background-color:#ff4747;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_pit th{
          font-family: cursive;
          font-size: 15;
          background-color:#ff4747;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_pit td{
          border: 1px solid black;
          border-collapse: collapse;
          padding: 0px;

        }
        #tab_pit td{
          font-family: cursive;
          font-size: 15;
        }

        #modal_rom{
            /*border:4px solid #CCC;*/
            width:400px;
            height:100px;
            display:none;
            position:absolute;
            left:50%;
            top:50%;
            margin:-25px 0 0 -50px;
            border-radius:5px;
        }
        #tab_rom {
          border-collapse: collapse;
        }
        #tab_rom .head1{
          font-family: cursive;
          font-size: 20;
          background-color:#6675ff;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_rom th{
          font-family: cursive;
          font-size: 15;
          background-color:#6675ff;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_rom td{
          border: 1px solid black;
          border-collapse: collapse;
          padding: 0px;

        }
        #tab_rom td{
          font-family: cursive;
          font-size: 15;
        }

        #sub_tab_rom {
          border-collapse: collapse;
        }
        #sub_tab_rom .head1{
          font-family: cursive;
          font-size: 20;
          background-color:#eda1d1;
          border: 1px solid black;
          padding: 0px;
        }
        #sub_tab_rom th{
          font-family: cursive;
          font-size: 15;
          background-color:#eda1d1;
          border: 1px solid black;
          padding: 0px;
        }
        #sub_tab_rom td{
          border: 1px solid black;
          border-collapse: collapse;
          padding: 0px;

        }
        #sub_tab_rom td{
          font-family: cursive;
          font-size: 15;
        }

        #modal_cpp{
            /*border:4px solid #CCC;*/
            width:400px;
            height:100px;
            display:none;
            position:absolute;
            left:50%;
            top:50%;
            margin:-25px 0 0 -50px;
            border-radius:5px;
        }
        #tab_cpp {
          border-collapse: collapse;
        }
        #tab_cpp .head1{
          font-family: cursive;
          font-size: 20;
          background-color:#ff6670;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_cpp th{
          font-family: cursive;
          font-size: 15;
          background-color:#ff6670;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_cpp td{
          border: 1px solid black;
          border-collapse: collapse;
          padding: 0px;

        }
        #tab_cpp td{
          font-family: cursive;
          font-size: 15;
        }

        #modal_port{
            /*border:4px solid #CCC;*/
            width:400px;
            height:100px;
            display:none;
            position:absolute;
            left:50%;
            top:50%;
            margin:-25px 0 0 -50px;
            border-radius:5px;
        }
        #tab_port {
          border-collapse: collapse;
        }
        #tab_port .head1{
          font-family: cursive;
          font-size: 20;
          background-color:#3dffe5;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_port th{
          font-family: cursive;
          font-size: 15;
          background-color:#3dffe5;
          border: 1px solid black;
          padding: 0px;
        }
        #tab_port td{
          border: 1px solid black;
          border-collapse: collapse;
          padding: 0px;

        }
        #tab_port td{
          font-family: cursive;
          font-size: 15;
        }
      </style>

</head>
<body>

  <?php
  date_default_timezone_set("Asia/Jakarta");
  $host        = "host = 127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname = db_tta";
   $credentials = "user = hend password=pmm300390";
   $hide_movement=1;
   $conn = pg_connect( "$host $port $dbname $credentials"  );
   if(!$conn) {
      echo "Error : Unable to open database\n";
   }
   else {
     $query = "SELECT pm.id,pm.name FROM periode_profile_rel AS ppr
              LEFT JOIN tta_coal_prod_stat_periode_month AS pm
              ON ppr.periode_profile_id=pm.id
              LEFT JOIN tta_coal_prod_stat_year AS ye
              ON ye.id=pm.year_id
              LEFT JOIN tta_coal_prod_stat_month AS mo
              ON mo.id=pm.month_id
              ORDER BY ye.year desc,mo.month desc
              ";
              $result = pg_query($conn, $query);
              $items=pg_fetch_all($result);

    $cur_month=date("Y").date("m");
    $month_id="-";

    echo "<form method=POST>";
    if(isset($_POST['month']))
    {
      $month=$_POST['month'];
      $month_id=$month;
    }

     echo "<table>";
     echo "<tr>";
     echo "<td>Month: ";
     echo "</td>";
     echo "<td>";
     echo "<select name='month'>";
     if (count($items[0])>0)
     {

       foreach ($items as $item) {
         $selected="";
         if($cur_month==$item['name'])
          $selected="selected";
          if($month_id==$item['id'])
            $selected="selected";
         echo "<option value='".$item['id']."' $selected>".$item['name']."</option>";
       }
     }

     echo "</select>";
     echo "</td>";
     echo "<td>";
     echo "<input type=submit value='View' />";
     echo "</td>";
     echo "</tr>";
     echo "</table>";
     echo "<br />";
     if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

     echo "<div id='modal_pit'>";
       echo "<table id='tab_pit' width='100%' border='1'>";
       echo "<tr>";
       echo "<th class='head1' colspan='4'>"."PIT"."</th>";
       echo "</tr>";


       $query = "SELECT DISTINCT ar.name AS area_name,ar.id
                FROM tta_coal_prod_stat_material_movement AS mm
                LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                ON mm.from_periode_month_id=pm.id
                LEFT JOIN tta_coal_prod_stat_area AS ar
                ON mm._from=ar.id
                LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                ON jar.id=ar.jenis_area_id
                LEFT JOIN tta_coal_prod_stat_coal_spec AS csp
                ON mm.coal_spec=csp.id
                LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
                ON csp.coal_spec_class=csc.id
                WHERE
                pm.id='$month'
                --now() BETWEEN pm.start_date AND pm.end_date
                -- AND mm.status ='final'
                AND jar.id=1
                AND mm.jenis_material_id=1
                ";

        $result = pg_query($conn, $query);
        $items=pg_fetch_all($result);
        if(count($items[0])>0)
        {
          foreach ($items as $item) {
            echo "<tr>";
            echo "<th colspan='4'>".$item['area_name']."</th>";
            echo "</tr>";

            $query = "SELECT ar.name AS area_name,mm.status,mm.amount_from,mm.date_arriving
                    ,csc.name AS class_name,pm.name as periode,pm.start_date,pm.end_date
                    ,jm.name AS jenis_material
                    FROM tta_coal_prod_stat_material_movement AS mm
                    LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                    ON mm.from_periode_month_id=pm.id
                    LEFT JOIN tta_coal_prod_stat_area AS ar
                    ON mm._from=ar.id
                    LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                    ON jar.id=ar.jenis_area_id
                    LEFT JOIN tta_coal_prod_stat_coal_spec AS csp
                    ON mm.coal_spec=csp.id
                    LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
                    ON csp.coal_spec_class=csc.id
                    LEFT JOIN tta_coal_prod_stat_jenis_material AS jm
                    ON jm.id=mm.jenis_material_id
                    WHERE
                    pm.id='$month'
                    AND mm.status ='final'
                    AND jar.id=1
                    AND ar.id='".$item['id']."'";
           $result = pg_query($conn, $query);
           $items2=pg_fetch_all($result);

            echo "<tr>";
            echo "<th colspan='4'>"."Out"."</th>";
            echo "</tr>";

            echo "<tr>";
            echo "<th>"."Date"."</th>";
            echo "<th>"."Tonnage"."</th>";
            echo "<th>"."Spec."."</th>";
            echo "<th>"."Jenis Material"."</th>";
            echo "</tr>";

            foreach ($items2 as $item2) {
              echo "<tr>";
              echo "<td>".$item2['date_arriving']."</td>";
              echo "<td style='text-align:right;'>".$item2['amount_from']."</td>";
              echo "<td style='text-align:center;'>".$item2['class_name']."</th>";
              echo "<td style='text-align:center;'>".$item2['jenis_material']."</th>";
              echo "</tr>";
            }


          }
        }
       echo "</table>";
     echo "</div>";

     echo "<div id='modal_rom'>";
       echo "<table id='tab_rom' width='100%' border='1'>";
       echo "<tr>";
       echo "<th class='head1' colspan='6'>"."ROM"."</th>";

       $query = " SELECT DISTINCT sp.name AS area_name,ar.id
                 FROM tta_coal_prod_stat_stockpile AS sp
                 LEFT JOIN tta_coal_prod_stat_area AS ar
                 ON sp.area=ar.id
                 LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                 ON jar.id=ar.jenis_area_id
                 WHERE jar.id=7
                ";
        // echo $query;
        $result = pg_query($conn, $query);
        $items=pg_fetch_all($result);
        if(count($items[0])>0)
        {
          foreach ($items as $item)
          {
            echo "</tr>";
            echo "<tr>";
            echo "<th colspan='6'>".$item['area_name']."</th>";
            echo "</tr>";
            echo "<tr>";
              $query="
                SELECT
                  sp.id AS sp_id
                  ,sp.name AS stockpile
                  ,sp.area
                  ,spm.id AS spm_id
                  ,spm.capacity
                  ,spm.composite_spec
                  ,spm.adjustment_spec
                  ,spm.opening_stock
                  ,spm.total_material_all
                  ,spm.capacity-spm.total_material_all AS available_space
                  ,csc.name AS class_name
                  ,pm.name AS periode
                  FROM tta_coal_prod_stat_stockpile AS sp
                  LEFT JOIN tta_coal_prod_stat_stockpile_month AS spm
                  ON sp.id=spm.stockpile
                  LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                  ON pm.year_id=spm.year AND pm.month_id=spm.month
                  LEFT JOIN tta_coal_prod_stat_coal_spec as csp
                  ON csp.id=spm.composite_spec
                  LEFT JOIN tta_coal_prod_stat_coal_spec_class as csc
                  ON csc.id=csp.coal_spec_class
                  WHERE
                  pm.id=$month
                AND sp.area=".$item['id'];
                $result = pg_query($conn, $query);
                $items3=pg_fetch_all($result);
                if(count($items3[0])>0)
                {
                  $id_spm=$items3[0]['spm_id'];
                  $spm_capacity[$id_spm]=$items3[0]['capacity'];
                  $spm_total_stock[$id_spm]=$items3[0]['total_material_all'];
                  $spm_space[$id_spm]=$items3[0]['available_space'];

                  if(!isset($items3[0]['adjustment_spec']))
                  {
                    $composite_spec=$items3[0]['composite_spec'];
                  }
                  else {
                    $composite_spec=$items3[0]['adjustment_spec'];
                  }

                  if(!isset($composite_spec))
                    $composite_spec=0;
                }
              echo "<td colspan='6'>";
              echo "
              <div id='chartContainer' style='height: 100%; width: 100%;'>
                <div style='height: 100%; width: 500;'
                id='chart$id_spm'></div>
              </div>
              ";
              #draw pie
              echo "<script>";
              echo "
              var chart_ob = c3.generate({
                bindto: '#chart$id_spm'
                ,data: {
                  columns: [
                     ['Stock', $spm_total_stock[$id_spm]],
                     ['Available Space', $spm_space[$id_spm]]
                   ],
                  type: 'pie',
                  colors: {
                      'Stock': '#000000',
                  },
                }
                ,pie: {
                   label: {
                     format: function(value, ratio, id) {
                       return value;
                     }
                   }
                 }

              });
              ";

              echo "</script>";
              $query="
              SELECT
              jsi.name
              , csi.amount
              FROM tta_coal_prod_stat_coal_spec AS csp
              LEFT JOIN tta_coal_prod_stat_coal_spec_item AS csi
              ON csp.id=csi.coal_spec
              LEFT JOIN tta_coal_prod_stat_jenis_spec_item AS jsi
              ON csi.jenis_spec_item=jsi.id
              LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
              ON csp.coal_spec_class=csc.id
              WHERE csp.id='$composite_spec'";
              $result = pg_query($conn, $query);
              if($result)
              {
                $items4=pg_fetch_all($result);
                echo "<table width='100%'>";
                $count=count($items4[0])+2;
                  echo "<tr>";
                    echo "<th colspan='$count'>"."Capacity(MT)"."</th>";
                  echo "</tr>";
                  echo "<tr>";
                    echo "<td colspan='$count' style='text-align:right;'>"
                    .number_format($spm_capacity[$id_spm])."</td>";
                  echo "</tr>";
                echo "</table>";

                echo "<table width='100%'>";
                $count=count($items4[0])+2;
                  echo "<tr>";
                    echo "<th colspan='$count'>"."Composite Spec."."</th>";
                  echo "</tr>";
                  echo "<tr>";
                    if(count($items4[0])>0)
                    {
                      foreach ($items4 as $item4) {
                        echo "<th>".$item4['name']."</th>";
                      }
                    }
                  echo "</tr>";
                  echo "<tr>";
                    if(count($items4[0])>0)
                    {
                      foreach ($items4 as $item4) {
                        echo "<td style='text-align:right;'>"
                        .number_format($item4['amount'], 2, '.', '')."</td>";
                      }
                    }
                  echo "</tr>";
                echo "</table>";
              }


              echo "</td>";

            echo "</tr>";

            if($hide_movement==0)
            {
              #MOVEMENT
              echo "<tr>";
                echo "<th colspan='3'>"."In"."</th>";
                echo "<th colspan='3'>"."Out"."</th>";
              echo "</tr>";
              echo "<tr>";

                #IN
                  echo "<td valign='top' colspan='3' width='50%'>";
                    $query = "SELECT ar.name AS area_name,mm.status,mm.amount_from,mm.date_arriving
                            ,csc.name AS class_name,pm.name as periode,pm.start_date,pm.end_date
                            FROM tta_coal_prod_stat_material_movement AS mm
                            LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                            ON mm.to_periode_month_id=pm.id
                            LEFT JOIN tta_coal_prod_stat_area AS ar
                            ON mm._to=ar.id
                            LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                            ON jar.id=ar.jenis_area_id
                            LEFT JOIN tta_coal_prod_stat_coal_spec AS csp
                            ON mm.coal_spec=csp.id
                            LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
                            ON csp.coal_spec_class=csc.id
                            WHERE
                            pm.id=$month
                            AND mm.status ='final'
                            AND jar.id=7
                            AND ar.id='".$item['id']."'
                            ORDER BY mm.date_arriving DESC
                            LIMIT 5";

                     $result = pg_query($conn, $query);
                     $items2=pg_fetch_all($result);

                     if(count($items2[0])>0)
                     {
                       #IN
                       echo "<table width='100%' id='sub_tab_rom' >";
                         echo "<tr>";
                           echo "<th>"."Date"."</th>";
                           echo "<th>"."Tonnage"."</th>";
                           echo "<th>"."Spec."."</th>";
                         echo "</tr>";
                        foreach ($items2 as $item2) {
                          echo "<tr>";
                            echo "<td>".$item2['date_arriving']."</th>";
                            echo "<td style='text-align:right;'>".$item2['amount_from']."</th>";
                            echo "<td style='text-align:center;'>".$item2['class_name']."</th>";
                          echo "</tr>";
                        }

                       echo "</table>";
                     }
                  echo "</td>";

                #OUT
                  echo "<td valign='top' colspan='3'>";
                    $query = "SELECT ar.name AS area_name,mm.status,mm.amount_from,mm.date_arriving
                          ,csc.name AS class_name,pm.name as periode,pm.start_date,pm.end_date
                          FROM tta_coal_prod_stat_material_movement AS mm
                          LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                          ON mm.from_periode_month_id=pm.id
                          LEFT JOIN tta_coal_prod_stat_area AS ar
                          ON mm._from=ar.id
                          LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                          ON jar.id=ar.jenis_area_id
                          LEFT JOIN tta_coal_prod_stat_coal_spec AS csp
                          ON mm.coal_spec=csp.id
                          LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
                          ON csp.coal_spec_class=csc.id
                          WHERE
                          now() BETWEEN pm.start_date AND pm.end_date
                          AND mm.status ='final'
                          AND jar.id=7
                          AND ar.id='".$item['id']."'
                          ORDER BY mm.date_arriving DESC
                          LIMIT 5";

                   $result = pg_query($conn, $query);
                   $items2=pg_fetch_all($result);

                   if(count($items2[0])>0)
                   {
                     #IN
                     echo "<table width='100%' id='sub_tab_rom' >";
                       echo "<tr>";
                         echo "<th>"."Date"."</th>";
                         echo "<th>"."Tonnage"."</th>";
                         echo "<th>"."Spec."."</th>";
                       echo "</tr>";
                      foreach ($items2 as $item2) {
                        echo "<tr>";
                          echo "<td>".$item2['date_arriving']."</th>";
                          echo "<td style='text-align:right;'>".$item2['amount_from']."</th>";
                          echo "<td style='text-align:center;'>".$item2['class_name']."</th>";
                        echo "</tr>";
                      }

                     echo "</table>";
                   }
                  echo "</td>";
            }

            echo "</tr>";


          }

        }


       echo "</table>";
     echo "</div>";

     echo "<div id='modal_cpp'>";
       echo "<table id='tab_cpp' width='100%' border='1'>";
       echo "<tr>";
       echo "<th class='head1' colspan='6'>"."CPP"."</th>";

       $query = "SELECT DISTINCT sp.name AS area_name,ar.id
                 FROM tta_coal_prod_stat_stockpile AS sp
                 LEFT JOIN tta_coal_prod_stat_area AS ar
                 ON sp.area=ar.id
                 LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                 ON jar.id=ar.jenis_area_id
                 WHERE jar.id=2
                ";

        $result = pg_query($conn, $query);
        $items=pg_fetch_all($result);
        if(count($items[0])>0)
        {
          foreach ($items as $item)
          {
            echo "</tr>";
            echo "<tr>";
            echo "<th colspan='6'>".$item['area_name']."</th>";
            echo "</tr>";
            echo "<tr>";
              $query="
                SELECT
                  sp.id AS sp_id
                  ,sp.name AS stockpile
                  ,sp.area
                  ,spm.id AS spm_id
                  ,spm.capacity
                  ,spm.composite_spec
                  ,spm.opening_stock
                  ,spm.total_material_all
                  ,spm.capacity-spm.total_material_all AS available_space
                  ,csc.name AS class_name
                  ,pm.name AS periode
                  FROM tta_coal_prod_stat_stockpile AS sp
                  LEFT JOIN tta_coal_prod_stat_stockpile_month AS spm
                  ON sp.id=spm.stockpile
                  LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                  ON pm.year_id=spm.year AND pm.month_id=spm.month
                  LEFT JOIN tta_coal_prod_stat_coal_spec as csp
                  ON csp.id=spm.composite_spec
                  LEFT JOIN tta_coal_prod_stat_coal_spec_class as csc
                  ON csc.id=csp.coal_spec_class
                  WHERE
                  pm.id=$month
                AND sp.area=".$item['id'];
                $result = pg_query($conn, $query);
                $items3=pg_fetch_all($result);
                if(count($items3[0])>0)
                {
                  $id_spm=$items3[0]['spm_id'];
                  $spm_capacity[$id_spm]=$items3[0]['capacity'];
                  $spm_total_stock[$id_spm]=$items3[0]['total_material_all'];
                  $spm_space[$id_spm]=$items3[0]['available_space'];
                  if(!isset($items3[0]['adjustment_spec']))
                  {
                    $composite_spec=$items3[0]['composite_spec'];
                  }
                  else {
                    $composite_spec=$items3[0]['adjustment_spec'];
                  }

                  if(!isset($composite_spec))
                    $composite_spec=0;
                }
              echo "<td colspan='6'>";
              echo "
              <div id='chartContainer' style='height: 100%; width: 100%;'>
                <div style='height: 100%; width: 500;'
                id='chart$id_spm'></div>
              </div>
              ";
              #draw pie
              echo "<script>";
              echo "
              var chart_ob = c3.generate({
                bindto: '#chart$id_spm'
                ,data: {
                  columns: [
                     ['Stock', $spm_total_stock[$id_spm]],
                     ['Available Space', $spm_space[$id_spm]]
                   ],
                  type: 'pie',
                  colors: {
                      'Stock': '#000000',
                  },
                }
                ,pie: {
                   label: {
                     format: function(value, ratio, id) {
                       return value;
                     }
                   }
                 }

              });
              ";
              echo "</script>";
              $query="
              SELECT
              jsi.name
              , csi.amount
              FROM tta_coal_prod_stat_coal_spec AS csp
              LEFT JOIN tta_coal_prod_stat_coal_spec_item AS csi
              ON csp.id=csi.coal_spec
              LEFT JOIN tta_coal_prod_stat_jenis_spec_item AS jsi
              ON csi.jenis_spec_item=jsi.id
              LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
              ON csp.coal_spec_class=csc.id
              WHERE csp.id=".$composite_spec;
              $result = pg_query($conn, $query);
              $items4=pg_fetch_all($result);
              if($result)
              {
                  $items4=pg_fetch_all($result);
                  echo "<table width='100%'>";
                  $count=count($items4[0])+2;
                    echo "<tr>";
                      echo "<th colspan='$count'>"."Capacity(MT)"."</th>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td colspan='$count' style='text-align:right;'>"
                      .number_format($spm_capacity[$id_spm])."</td>";
                    echo "</tr>";
                  echo "</table>";
                echo "<table width='100%'>";
                $count=count($items4[0])+2;
                  echo "<tr>";
                    echo "<th colspan='$count'>"."Composite Spec."."</th>";
                  echo "</tr>";
                  echo "<tr>";
                    if(count($items4[0])>0)
                    {
                      foreach ($items4 as $item4) {
                        echo "<th>".$item4['name']."</th>";
                      }
                    }
                  echo "</tr>";
                  echo "<tr>";
                    if(count($items4[0])>0)
                    {
                      foreach ($items4 as $item4) {
                        echo "<td style='text-align:right;'>"
                        .number_format($item4['amount'], 2, '.', '')."</td>";
                      }
                    }
                  echo "</tr>";
                echo "</table>";
              }

              echo "</td>";

            echo "</tr>";

            if($hide_movement==0)
            {
              #MOVEMENT
              echo "<tr>";
                echo "<th colspan='3'>"."In"."</th>";
                echo "<th colspan='3'>"."Out"."</th>";
              echo "</tr>";
              echo "<tr>";

                #IN
                  echo "<td valign='top' colspan='3' width='50%'>";
                    $query = "SELECT ar.name AS area_name,mm.status,mm.amount_from,mm.date_arriving
                            ,csc.name AS class_name,pm.name as periode,pm.start_date,pm.end_date
                            FROM tta_coal_prod_stat_material_movement AS mm
                            LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                            ON mm.to_periode_month_id=pm.id
                            LEFT JOIN tta_coal_prod_stat_area AS ar
                            ON mm._to=ar.id
                            LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                            ON jar.id=ar.jenis_area_id
                            LEFT JOIN tta_coal_prod_stat_coal_spec AS csp
                            ON mm.coal_spec=csp.id
                            LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
                            ON csp.coal_spec_class=csc.id
                            WHERE
                            pm.id=$month
                            AND mm.status ='final'
                            AND jar.id=2
                            AND ar.id='".$item['id']."'
                            ORDER BY mm.date_arriving DESC
                            LIMIT 5";

                     $result = pg_query($conn, $query);
                     $items2=pg_fetch_all($result);

                     if(count($items2[0])>0)
                     {
                       #IN
                       echo "<table width='100%' id='sub_tab_rom' >";
                         echo "<tr>";
                           echo "<th>"."Date"."</th>";
                           echo "<th>"."Tonnage"."</th>";
                           echo "<th>"."Spec."."</th>";
                         echo "</tr>";
                        foreach ($items2 as $item2) {
                          echo "<tr>";
                            echo "<td>".$item2['date_arriving']."</th>";
                            echo "<td style='text-align:right;'>".$item2['amount_from']."</th>";
                            echo "<td style='text-align:center;'>".$item2['class_name']."</th>";
                          echo "</tr>";
                        }

                       echo "</table>";
                     }
                  echo "</td>";

                #OUT
                  echo "<td valign='top' colspan='3'>";
                    $query = "SELECT ar.name AS area_name,mm.status,mm.amount_from,mm.date_arriving
                          ,csc.name AS class_name,pm.name as periode,pm.start_date,pm.end_date
                          FROM tta_coal_prod_stat_material_movement AS mm
                          LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                          ON mm.from_periode_month_id=pm.id
                          LEFT JOIN tta_coal_prod_stat_area AS ar
                          ON mm._from=ar.id
                          LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                          ON jar.id=ar.jenis_area_id
                          LEFT JOIN tta_coal_prod_stat_coal_spec AS csp
                          ON mm.coal_spec=csp.id
                          LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
                          ON csp.coal_spec_class=csc.id
                          WHERE
                          pm.id=$month
                          AND mm.status ='final'
                          AND jar.id=2
                          AND ar.id='".$item['id']."'
                          ORDER BY mm.date_arriving DESC
                          LIMIT 5";

                   $result = pg_query($conn, $query);
                   $items2=pg_fetch_all($result);

                   if(count($items2[0])>0)
                   {
                     #IN
                     echo "<table width='100%' id='sub_tab_rom' >";
                       echo "<tr>";
                         echo "<th>"."Date"."</th>";
                         echo "<th>"."Tonnage"."</th>";
                         echo "<th>"."Spec."."</th>";
                       echo "</tr>";
                      foreach ($items2 as $item2) {
                        echo "<tr>";
                          echo "<td>".$item2['date_arriving']."</th>";
                          echo "<td style='text-align:right;'>".$item2['amount_from']."</th>";
                          echo "<td style='text-align:center;'>".$item2['class_name']."</th>";
                        echo "</tr>";
                      }

                     echo "</table>";
                   }
                  echo "</td>";

              echo "</tr>";
            }



          }

        }


       echo "</table>";
     echo "</div>";

     echo "<div id='modal_port'>";
       echo "<table id='tab_port' width='100%' border='1'>";
       echo "<tr>";
       echo "<th class='head1' colspan='6'>"."PORT"."</th>";

       $query = "SELECT DISTINCT sp.name AS area_name,ar.id
                 FROM tta_coal_prod_stat_stockpile AS sp
                 LEFT JOIN tta_coal_prod_stat_area AS ar
                 ON sp.area=ar.id
                 LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                 ON jar.id=ar.jenis_area_id
                 WHERE jar.id=3
                ";

        $result = pg_query($conn, $query);
        $items=pg_fetch_all($result);
        if(count($items[0])>0)
        {
          foreach ($items as $item)
          {
            echo "</tr>";
            echo "<tr>";
            echo "<th colspan='6'>".$item['area_name']."</th>";
            echo "</tr>";
            echo "<tr>";
              $query="
                SELECT
                  sp.id AS sp_id
                  ,sp.name AS stockpile
                  ,sp.area
                  ,spm.id AS spm_id
                  ,spm.capacity
                  ,spm.composite_spec
                  ,spm.opening_stock
                  ,spm.total_material_all
                  ,spm.capacity-spm.total_material_all AS available_space
                  ,csc.name AS class_name
                  ,pm.name AS periode
                  FROM tta_coal_prod_stat_stockpile AS sp
                  LEFT JOIN tta_coal_prod_stat_stockpile_month AS spm
                  ON sp.id=spm.stockpile
                  LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                  ON pm.year_id=spm.year AND pm.month_id=spm.month
                  LEFT JOIN tta_coal_prod_stat_coal_spec as csp
                  ON csp.id=spm.composite_spec
                  LEFT JOIN tta_coal_prod_stat_coal_spec_class as csc
                  ON csc.id=csp.coal_spec_class
                  WHERE
                  pm.id=$month
                AND sp.area=".$item['id'];
                $result = pg_query($conn, $query);
                $items3=pg_fetch_all($result);
                if(count($items3[0])>0)
                {
                  $id_spm=$items3[0]['spm_id'];
                  $spm_capacity[$id_spm]=$items3[0]['capacity'];
                  $spm_total_stock[$id_spm]=$items3[0]['total_material_all'];
                  $spm_space[$id_spm]=$items3[0]['available_space'];
                  if(!isset($items3[0]['adjustment_spec']))
                  {
                    $composite_spec=$items3[0]['composite_spec'];
                  }
                  else {
                    $composite_spec=$items3[0]['adjustment_spec'];
                  }

                  if(!isset($composite_spec))
                    $composite_spec=0;
                }
              echo "<td colspan='6'>";
              echo "
              <div id='chartContainer' style='height: 100%; width: 100%;'>
                <div style='height: 100%; width: 500;'
                id='chart$id_spm'></div>
              </div>
              ";
              #draw pie
              echo "<script>";
              echo "
              var chart_ob = c3.generate({
                bindto: '#chart$id_spm'
                ,data: {
                  columns: [
                     ['Stock', $spm_total_stock[$id_spm]],
                     ['Available Space', $spm_space[$id_spm]]
                   ],
                  type: 'pie',
                  colors: {
                      'Stock': '#000000',
                  },
                }
                ,pie: {
                   label: {
                     format: function(value, ratio, id) {
                       return value;
                     }
                   }
                 }

              });
              ";
              echo "</script>";
              $query="
              SELECT
              jsi.name
              , csi.amount
              FROM tta_coal_prod_stat_coal_spec AS csp
              LEFT JOIN tta_coal_prod_stat_coal_spec_item AS csi
              ON csp.id=csi.coal_spec
              LEFT JOIN tta_coal_prod_stat_jenis_spec_item AS jsi
              ON csi.jenis_spec_item=jsi.id
              LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
              ON csp.coal_spec_class=csc.id
              WHERE csp.id=".$composite_spec;
              $result = pg_query($conn, $query);
              $items4=pg_fetch_all($result);
              if($result)
              {
                  $items4=pg_fetch_all($result);
                  echo "<table width='100%'>";
                  $count=count($items4[0])+2;
                    echo "<tr>";
                      echo "<th colspan='$count'>"."Capacity(MT)"."</th>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td colspan='$count' style='text-align:right;'>"
                      .number_format($spm_capacity[$id_spm])."</td>";
                    echo "</tr>";
                  echo "</table>";
                echo "<table width='100%'>";
                $count=count($items4[0])+2;
                  echo "<tr>";
                    echo "<th colspan='$count'>"."Composite Spec."."</th>";
                  echo "</tr>";
                  echo "<tr>";
                    if(count($items4[0])>0)
                    {
                      foreach ($items4 as $item4) {
                        echo "<th>".$item4['name']."</th>";
                      }
                    }
                  echo "</tr>";
                  echo "<tr>";
                    if(count($items4[0])>0)
                    {
                      foreach ($items4 as $item4) {
                        echo "<td style='text-align:right;'>"
                        .number_format($item4['amount'], 2, '.', '')."</td>";
                      }
                    }
                  echo "</tr>";
                echo "</table>";
              }

              echo "</td>";

            echo "</tr>";

            if($hide_movement==0)
            {
              #MOVEMENT
              echo "<tr>";
                echo "<th colspan='3'>"."In"."</th>";
                echo "<th colspan='3'>"."Out"."</th>";
              echo "</tr>";
              echo "<tr>";

                #IN
                  echo "<td valign='top' colspan='3' width='50%'>";
                    $query = "SELECT ar.name AS area_name,mm.status,mm.amount_from,mm.date_arriving
                            ,csc.name AS class_name,pm.name as periode,pm.start_date,pm.end_date
                            FROM tta_coal_prod_stat_material_movement AS mm
                            LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                            ON mm.to_periode_month_id=pm.id
                            LEFT JOIN tta_coal_prod_stat_area AS ar
                            ON mm._to=ar.id
                            LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                            ON jar.id=ar.jenis_area_id
                            LEFT JOIN tta_coal_prod_stat_coal_spec AS csp
                            ON mm.coal_spec=csp.id
                            LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
                            ON csp.coal_spec_class=csc.id
                            WHERE
                            pm.id=$month
                            AND mm.status ='final'
                            AND jar.id=3
                            AND ar.id='".$item['id']."'
                            ORDER BY mm.date_arriving DESC
                            LIMIT 5";

                     $result = pg_query($conn, $query);
                     $items2=pg_fetch_all($result);

                     if(count($items2[0])>0)
                     {
                       #IN
                       echo "<table width='100%' id='sub_tab_rom' >";
                         echo "<tr>";
                           echo "<th>"."Date"."</th>";
                           echo "<th>"."Tonnage"."</th>";
                           echo "<th>"."Spec."."</th>";
                         echo "</tr>";
                        foreach ($items2 as $item2) {
                          echo "<tr>";
                            echo "<td>".$item2['date_arriving']."</th>";
                            echo "<td style='text-align:right;'>".$item2['amount_from']."</th>";
                            echo "<td style='text-align:center;'>".$item2['class_name']."</th>";
                          echo "</tr>";
                        }

                       echo "</table>";
                     }
                  echo "</td>";

                #OUT
                  echo "<td valign='top' colspan='3'>";
                    $query = "SELECT ar.name AS area_name,mm.status,mm.amount_from,mm.date_arriving
                          ,csc.name AS class_name,pm.name as periode,pm.start_date,pm.end_date
                          FROM tta_coal_prod_stat_material_movement AS mm
                          LEFT JOIN tta_coal_prod_stat_periode_month AS pm
                          ON mm.from_periode_month_id=pm.id
                          LEFT JOIN tta_coal_prod_stat_area AS ar
                          ON mm._from=ar.id
                          LEFT JOIN tta_coal_prod_stat_jenis_area AS jar
                          ON jar.id=ar.jenis_area_id
                          LEFT JOIN tta_coal_prod_stat_coal_spec AS csp
                          ON mm.coal_spec=csp.id
                          LEFT JOIN tta_coal_prod_stat_coal_spec_class AS csc
                          ON csp.coal_spec_class=csc.id
                          WHERE
                          pm.id=$month
                          AND mm.status ='final'
                          AND jar.id=3
                          AND ar.id='".$item['id']."'
                          ORDER BY mm.date_arriving DESC
                          LIMIT 5";

                   $result = pg_query($conn, $query);
                   $items2=pg_fetch_all($result);

                   if(count($items2[0])>0)
                   {
                     #IN
                     echo "<table width='100%' id='sub_tab_rom' >";
                       echo "<tr>";
                         echo "<th>"."Date"."</th>";
                         echo "<th>"."Tonnage"."</th>";
                         echo "<th>"."Spec."."</th>";
                       echo "</tr>";
                      foreach ($items2 as $item2) {
                        echo "<tr>";
                          echo "<td>".$item2['date_arriving']."</th>";
                          echo "<td style='text-align:right;'>".$item2['amount_from']."</th>";
                          echo "<td style='text-align:center;'>".$item2['class_name']."</th>";
                        echo "</tr>";
                      }

                     echo "</table>";
                   }
                  echo "</td>";

              echo "</tr>";
            }



          }

        }


       echo "</table>";
     echo "</div>";


       #CLASS LEGEND
       $query = "SELECT DISTINCT cla.id, cla.name AS name
         FROM tta_coal_prod_stat_coal_spec_class AS cla
         ORDER BY cla.name ASC";

       $result = pg_query($conn, $query);
       if (!$result) {
         echo "Error : Unable to access Table\n";
         exit;
       }
       else {
         $spec_class=pg_fetch_all($result);
         echo "<div id='modal_spec'>";
           echo "<table id='tab_spec' width='100%' border='1'>";
           echo "<tr>";
           echo "<th colspan='3'>"."Spec. Legend"."</th>";
           echo "</tr>";

           foreach ($spec_class  as $item_sc) {
             echo "<tr>";
             echo "<th colspan='3'>".$item_sc['name']."</th>";
             echo "</tr>";
             echo "<tr>";
             echo "<th >"."Item"."</th>";
             echo "<th >"."Min"."</th>";
             echo "<th >"."Max"."</th>";
             echo "</tr>";

             $query = "SELECT cla.name AS class_name,jenis.name AS jenis_name,item.min_amount,item.max_amount
               FROM tta_coal_prod_stat_coal_spec_class AS cla
               LEFT JOIN tta_coal_prod_stat_coal_spec_class_item AS item
               ON cla.id=item.coal_spec_class
               LEFT JOIN tta_coal_prod_stat_jenis_spec_item AS jenis
               ON item.jenis_spec_item=jenis.id WHERE cla.id=".$item_sc['id'];

            $result = pg_query($conn, $query);
            $items=pg_fetch_all($result);

            foreach ($items as $item) {
              echo "<tr>";
              echo "<td>".$item['jenis_name']."</td>";
              echo "<td>".$item['min_amount']."</td>";
              echo "<td>".$item['max_amount']."</td>";
              echo "</tr>";
            }

           }
           echo "</table>";
         echo "</div>";
         }
     }
   }

echo "</form>";

  ?>

</body>
</html>
