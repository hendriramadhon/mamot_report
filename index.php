<!DOCTYPE HTML>
<html>
<head>
<style>
    #tb_cg {
        border: 1px black solid;
        border-collapse: collapse;
        font: 12px sans-serif;
    }

    #tb_cg th {
        border: 1px black solid;
        text-align: left;
        border-collapse: collapse;
        color: white;
        background-color:#ff9933;
        padding: 4px;
      }

    #tb_cg td {
        border: 1px black solid;
        text-align: left;
        border-collapse: collapse;
        padding: 4px;
        text-align: right;
    }
    #tb_cg tr {
        border: 1px black solid;
        border-collapse: collapse;
    }

    #tb_opr {
        border: 1px black solid;
        border-collapse: collapse;
        font: 12px sans-serif;
    }

    #tb_opr th {
        border: 1px black solid;
        text-align: left;
        border-collapse: collapse;
        color: white;
        background-color:#ff9933;
        padding: 4px;
        text-align: center;
      }

    #tb_opr td {
        border: 1px black solid;
        text-align: left;
        border-collapse: collapse;
        padding: 4px;
        text-align: center;
    }

    #tb_opr tr {
        border: 1px black solid;
        border-collapse: collapse;
    }

    #tb_cpt {
        border: 1px black solid;
        border-collapse: collapse;
        font: 20px sans-serif;
    }

    #tb_cpt th {
        border: 1px black solid;
        text-align: left;
        border-collapse: collapse;
        color: white;
        background-color:#ff9933;
        padding: 4px;
        text-align: center;
      }

    #tb_cpt td {
        border: 1px black solid;
        text-align: left;
        border-collapse: collapse;
        padding: 4px;
        text-align: center;
    }

    #tb_cpt tr {
        border: 1px black solid;
        border-collapse: collapse;
    }
</style>
  <script>
window.onload = function() {

  var chart_ob = c3.generate({
    bindto: '#chart'
    ,data: {
        x:'month',
        url: 'data.csv',
        type: 'bar',
        columns: [
        ['x', 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12]
      ],
      axes:{
        plan:'y'
        ,actual:'y'
        ,plan_ytd:'y2'
        ,actual_ytd:'y2'
      }
    }
    ,axis:{
      x:{
        type:'categorized'
        ,categories:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
      }
      ,y2:{
        show: true
      }
    }
  });

  var chart_coal = c3.generate({
    bindto: '#chart_coal'
    ,data: {
        x:'month',
        url: 'data_coal.csv',
        type: 'bar',
        columns: [
        ['x', 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12]
      ],
      axes:{
        plan:'y'
        ,actual:'y'
        ,plan_ytd:'y2'
        ,actual_ytd:'y2'
      }
    }
    ,axis:{
      x:{
        type:'categorized'
        ,categories:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
      }
    }
  });

  var chart_sr_include_infra = c3.generate({
    bindto: '#chart_sr_include_infra'
    ,data: {
        x:'month',
        url: 'data_sr_all_2017.csv',
        type: 'bar',
        columns: [
        ['x', 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12]
      ],
      axes:{
        plan:'y'
        ,actual:'y'
        ,plan_ytd:'y2'
        ,actual_ytd:'y2'
      }
    }
    ,axis:{
      x:{
        type:'categorized'
        ,categories:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
      }
    }
  });

  var chart_sr_exclude_infra = c3.generate({
    bindto: '#chart_sr_exclude_infra'
    ,data: {
        x:'month',
        url: 'data_sr_ex_infra_2017.csv',
        type: 'bar',
        columns: [
        ['x', 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12]
      ],
      axes:{
        plan:'y'
        ,actual:'y'
        ,plan_ytd:'y2'
        ,actual_ytd:'y2'
      }
    }
    ,axis:{
      x:{
        type:'categorized'
        ,categories:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
      }
    }
  });

  var chart_tas = c3.generate({
    bindto: '#chart_tas'
    ,data: {
        x:'date',
        url: 'data_tas.csv',
        type: 'line',

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

  var chart_loss_time_duration = c3.generate({
    bindto: '#chart_loss_time_duration'
    ,data: {
        url: 'data_loss_time_duration.csv',
        type: 'bar',
        labels:true
    }
    ,axis:{
      rotated:true
    }
  });

  var chart_rain_fall = c3.generate({
    bindto: '#chart_rain_fall'
    ,data: {
        url: 'data_rain_fall.csv',
        type: 'bar',
        labels:true
    }
    ,axis:{
      rotated:true
    }
  });

  var chart_coal_index = c3.generate({
    bindto: '#chart_coal_index'
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

  var updateChart=function(){
    chart_ob.load({
      unload: ['amount']
      ,url: 'data.csv'
    });
    };

  var updateChartYTD=function(){
        chart_ob.load({
          url: 'data_ob_ytd_2017.csv'
          ,type: 'line'
        });
        };

  var updateChartCoal=function(){
    chart_coal.load({
      unload: ['amount']
      ,url: 'data_coal.csv'
    });
    };

  var updateChartCoalYTD=function(){
          chart_coal.load({
            url: 'data_coal_ytd_2017.csv'
            ,type: 'line'
          });
          };

  var updateChartSRIncludeInfra=function(){
      chart_sr_include_infra.load({
      url: 'data_sr_all_2017.csv'
      });
      };

  var updateChartSRIncludeInfraYTD=function(){
                      chart_sr_include_infra.load({
                      url: 'data_sr_all_ytd_2017.csv'
                      ,type: 'line'
                      });
                      };

  var updateChartSRExcludeInfra=function(){
          chart_sr_exclude_infra.load({
          url: 'data_sr_ex_infra_2017.csv'
          });
          };

  var updateChartSRExcludeInfraYTD=function(){
                  chart_sr_exclude_infra.load({
                  url: 'data_sr_ex_infra_ytd_2017.csv'
                  ,type: 'line'
                  });
                  };

  var updateTAS=function(){
                                  chart_tas.load({
                                  url: 'data_tas.csv'
                                  ,type: 'line'
                                  });
                                  };

  var updateLossTimeDuration=function(){
                      chart_loss_time_duration.load({
                      url: 'data_loss_time_duration.csv'
                      ,type: 'bar'
                      });
                    };

  var updateRainFall=function(){
              chart_rain_fall.load({
              url: 'data_rain_fall.csv'
              ,type: 'bar'
              });
              };

  var updateCoalGetting=function(){
                d3.text("data_coal_getting.csv", function(data) {

                    var parsedCSV = d3.csv.parseRows(data);

                    var container = d3.select("#tableCoalGetting")
                        .select("table").remove();

                        var container = d3.select("#tableCoalGetting")
                        .append("table")
                        .selectAll("th")
                        .data(parsedCSV[0]).enter()
                        .append("th").text(function(d){return d;});

                    var container = d3.select("#tableCoalGetting")
                        .select("table").attr('id','tb_cg')

                        .selectAll("tr")
                            .data(parsedCSV.slice(1)).enter()
                            .append("tr")

                        .selectAll("td")
                            .data(function(d) { return d; }).enter()
                            .append("td")
                            .text(function(d) { if(isNaN(d)){}else{format=d3.format('0,000,000,000'); d=format(d);} return d; });
                });
                          };

  var updateFuel=function(){
            d3.text("data_fuel.csv", function(data) {
                var parsedCSV = d3.csv.parseRows(data);

                var container = d3.select("#tableFuel")
                .select("table").remove();

                var container = d3.select("#tableFuel")
                .append("table")
                .selectAll("th")
                .data(parsedCSV[0]).enter()
                .append("th").text(function(d){return d;});

                var container = d3.select("#tableFuel")
                .select("table").attr('id','tb_cg')
                .selectAll("tr")
                .data(parsedCSV.slice(1)).enter()
                .append("tr")
                .selectAll("td")
                .data(function(d) { return d; }).enter()
                .append("td")
                .text(function(d) { if(isNaN(d)){}else{format=d3.format('0,000,000,000'); d=format(d);} return d; });
                });
                };

  var updateCoalIndex=function(){
                                  chart_coal_index.load({
                                  url: 'data_coal_index.csv'
                                  ,type: 'line'
                                  });
                                  };

  var updateOprAch=function(){
      d3.text("data_operational_ach.csv", function(data) {
      var parsedCSV = d3.csv.parseRows(data);
      var container = d3.select("#tableOprAch")
      .select("table").remove();

      var container = d3.select("#tableOprAch")
      .append("table")
      .selectAll("th")
      .data(parsedCSV[0]).enter()
      .append("th").text(function(d){return d;});

      var container = d3.select("#tableOprAch")
      .select("table").attr('id','tb_opr')
      .selectAll("tr")
      .data(parsedCSV.slice(1)).enter()
      .append("tr")
      .selectAll("td")
      .data(function(d) { return d; }).enter()
      .append("td")
      .text(function(d) { if(isNaN(d)){}else{format=d3.format('0,000,000,000'); d=format(d);} return d; });
      });
      };

  var updateCostPerTon=function(){
          d3.text("data_cost_per_ton.csv", function(data) {
          var parsedCSV = d3.csv.parseRows(data);
          var container = d3.select("#tableCostPerTon")
          .select("table").remove();

          var container = d3.select("#tableCostPerTon")
          .append("table")
          .selectAll("th")
          .data(parsedCSV[0]).enter()
          .append("th").text(function(d){return d;});

          var container = d3.select("#tableCostPerTon")
          .select("table").attr('id','tb_cpt')
          .selectAll("tr")
          .data(parsedCSV.slice(1)).enter()
          .append("tr")
          .selectAll("td")
          .data(function(d) { return d; }).enter()
          .append("td")
          .text(function(d) { if(isNaN(d)){}else{format=d3.format('0,000,000,000'); d=format(d);} return d; });
          });
          };

  setInterval(function(){updateChart()},5000);
  setInterval(function(){updateChartYTD()},5000);
  setInterval(function(){updateChartCoal()},5000);
  setInterval(function(){updateChartCoalYTD()},5000);
  setInterval(function(){updateChartSRIncludeInfra()},5000);
  setInterval(function(){updateChartSRIncludeInfraYTD()},5000);
  setInterval(function(){updateChartSRExcludeInfra()},5000);
  setInterval(function(){updateChartSRExcludeInfraYTD()},5000);
  setInterval(function(){updateTAS()},5000);
  setInterval(function(){updateLossTimeDuration()},5000);
  setInterval(function(){updateRainFall()},5000);
  setInterval(function(){updateCoalGetting()},5000);
  setInterval(function(){updateFuel()},5000);
  setInterval(function(){updateCoalIndex()},5000);
  setInterval(function(){updateOprAch()},5000);
  setInterval(function(){updateCostPerTon()},5000);
  }

</script>
<!-- Load c3.css -->
<!-- These belongs to the HTML file where you want C3 to work - put these lines into your <head> tag -->
<script type="text/javascript" src="lib/d3/d3.js"></script>
<script type="text/javascript" src="lib/d3/d3.min.js?v=3.2.8"></script>
<script type="text/javascript" src="lib/c3/c3.js"></script>
<link href="lib/c3/c3.css" rel="stylesheet" type="text/css">
</head>
<body>
  <table width="100%"  border="0">
    <tr>
      <td colspan="3" style="font-size:30px;text-align:center;horizontal-align:center;font-style:oblique;">
        <span>Production Dashboard 2017</span>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <table width="100%">
          <tr>
            <td style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
              Waste Production
            </td>
            <td style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
              Coal Production
            </td>
          </tr>
          <tr>
            <td width="50%">
              <div id="chartContainer" style="height: 300px; width: 100%;">
                <div id="chart"></div>
              </div>
            </td>
            <td width="50%">
              <div id="chartCoalContainer" style="height: 300px; width: 100%;">
                <div id="chart_coal">
              </div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        &nbsp
      </td>
      <td>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <table width="100%">
          <tr>
            <td style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
              SR Exclude Infra Production
            </td>
            <td style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
              SR Include Infra Production
            </td>
          </tr>
          <tr>
            <td width="50%">
              <div id="chartCoalContainer" style="height: 300px; width: 100%;">
                <div id="chart_sr_exclude_infra">
              </div>
            </td>
            <td width="50%">
              <div id="chartCoalContainer" style="height: 300px; width: 100%;">
                <div id="chart_sr_include_infra">
              </div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td >
        &nbsp
      </td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
      Cost Report
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
        Fuel & Index
      </td>
      <td style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
        Cost per-Ton
      </td>
    </tr>
    <tr>
      <td colspan="2" width="20%">
        <table width="100%" height="300px" border="0" >
          <tr>
            <th>
              Fuel
            </th>
            <th>
              Index
            </th>
          </tr>
          <tr>
            <td style="vertical-align:top;">
              <div id="tableFuel" style="height: 100px; width: 100%;">
              </div>
            </td>
            <td>
                <div id="chart_coal_index" style="height: 250px; width: 250px;"></div>
            </td>
          </tr>
        </table>
      </td>
      <td width="80%">
        <div id="tableCostPerTon" style="height: 300px; width: 100%;">
        </div>
      </td>
    </tr>
    <tr>
      <td>
        &nbsp
      </td>
      <td>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
        SHE Report
      </td>
      <td colspan="2" style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
        Operational Achievement
      </td>
    </tr>
    <tr>
      <td width="20%">
        <div id="chartContainer" style="height: 300px; width: 100%;">
          <table>
            <tr>
            <td>Unsafe Condition</td>
            <td>0</td>
            </tr>
            <tr>
            <td>Unsafe Condition</td>
            <td>0</td>
            </tr><tr>
            <td>Unsafe Action</td>
            <td>0</td>
            </tr><tr>
            <td>Near Miss</td>
            <td>0</td>
            </tr><tr>
            <td>Property Damage</td>
            <td>0</td>
            </tr><tr>
            <td>First Aid</td>
            <td>0</td>
            </tr><tr>
            <td>Minor Injury</td>
            <td>0</td>
            </tr><tr>
            <td>Minor Injury</td>
            <td>0</td>
            </tr><tr>
            <td>Fatality</td>
            <td>0</td>
            </tr><tr>
            <td>Enviro Incident</td>
            <td>0</td>
            </tr>
          </table>
        </div>
      </td>
      <td  colspan="2" width="80%">
        <table width="100%">
          <tr>
            <th>
              Daily Coal Getting & Over Burden
            </th>
            <th>
              Operational Asumption
            </th>
          </tr>
          <tr>
            <td width="30%">
              <div id="tableCoalGetting" style="height: 300px; width: 100%;">
              </div>
            </td>
            <td width="70%">
              <div id="tableOprAch" style="height: 300px; width: 100%;">
              </div>
            </td>
          </tr>
        </table>

      </td>

    </tr>
    <tr>
      <td >
        &nbsp
      </td>
    </tr>
    <tr>
      <td colspan="3" style="text-align:center;background-color:#4CAF50;color:white;font-style:oblique;font-size:20px;">
        Loss Time
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <table>
          <tr>
            <th>
              Water Level
            </th>
            <th>
              Rain Fall
            </th>
            <th>
              Lost Time Duration (MTD-Hours)
            </th>
          </tr>
          <tr>
            <td width="40%">
              <div id="chartCoalContainer" style="height: 300px; width: 100%;">
                <div id="chart_tas">
              </div>
              </div>
            </td>
            <td width="30%">
              <div id="chartCoalContainer" style="height: 300px; width: 300px;">
                <div id="chart_rain_fall">
              </div>
              </div>
            </td>
            <td width="30%">
              <div id="chartCoalContainer" style="height: 300px; width: 300px;">
                <div id="chart_loss_time_duration"></div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

  </table>

</body>
</html>
