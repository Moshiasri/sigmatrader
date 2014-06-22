<?php

$holla = $_GET['stock'];

?>


<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>pollux highchart 2 - jsFiddle demo</title>
  
  <script type='text/javascript' src='http://code.jquery.com/jquery-1.7.1.js'></script>
  
  <link rel="stylesheet" type="text/css" href="hist/css/normalize.css">
  <link rel="stylesheet" type="text/css" href="hist/css/result-light.css">
  
    
    
      <script type='text/javascript' src="http://www.highcharts.com/js/highstock.js"></script>
    
  
  <style type='text/css'>
    
  </style>
  


<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){


});//]]>  

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}


function onsubmit()
{
var element = document.getElementById(ticker1);

setCookie("mainchart",element,3);

}


</script>


</head>
<body>
    <form  action="test03.php" method = "get">
Symbol: <input id ="stock" type="text" name="stock"></input>
</form>
  <div id="container" style="height: 500px; min-width: 600px"></div>
<script>
jQuery(function() {
    var seriesOptions = [],
        yAxisOptions = [],
        seriesCounter = 0,
        <?php
        if ($holla != null)
        {
            print "names = ['".$holla."'],";
        }
        else
        {
            $holla = "AAPL";
             print "names = ['".$holla."'],";
        }    
        ?>

        colors = Highcharts.getOptions().colors;

        jQuery.each(names, function(i, name) {

        var YQL = format_YQL_request(name);
        var textarea2 = document.getElementById("textarea2");
        textarea2.innerHTML = textarea2.innerHTML + "\n" + YQL;

        jQuery.getJSON(YQL, function(data) {

                var yahooData = parseYahooData(data);

                seriesOptions[i] = {
                    name: name,
                    data: yahooData
                };

                // As we're loading the data asynchronously, we don't know what order it will arrive. So
                // we keep a counter and create the chart when all the data is loaded.
                seriesCounter++;

                if (seriesCounter == names.length) {
                     createChart();
                }
            });
        });


    function format_YQL_request(symbol, start_date, end_date) {

        // a = Begin month (starting at offset 0 = January)
        // b = Begin day
        // c = Begin year
        // d,e,f = End (same as above) = Defaults to "today" if blank

        // start_date = new Date(2000,1,1);    
        start_date = new Date(start_date || "2008/01/01");
        end_date   = new Date(end_date || Date() );
    
        var URL = 'http://ichart.finance.yahoo.com/table.csv?s='
            + symbol 
            + '%26a=' + start_date.getMonth() 
            + '%26b=' + start_date.getDate() 
            + '%26c=' + start_date.getFullYear() 
            + '%26d=' + end_date.getMonth() 
            + '%26e=' + end_date.getDate() 
            + '%26f=' + end_date.getFullYear() 
            + '%26g=d%26ignore=.csv';


        var textarea1 = document.getElementById("textarea1");
        textarea1.innerHTML = textarea1.innerHTML + "\n" + URL;

        var YQL = 'http://query.yahooapis.com/v1/public/yql?q='
                  + 'select col0, col4 from csv where url=';

        YQL = YQL + "'" + URL + "'" + '&format=json&callback=?';


        return YQL;

    }
    
    function parseDate(input) {
      var parts = input.match(/(\d+)/g);
      return new Date(parts[0], parts[1]-1, parts[2]);
    }

    function parseYahooData(data) {

        var rows = data.query.results.row;
        rows.shift();        // remove first row of headers
    
        var yahooData = new Array();

        var textarea3 = document.getElementById("textarea3");
        

        jQuery.each(rows, function(key,val) {  
            var date  = + parseDate(val.col0);
            var price = parseFloat(val.col4); 

            textarea3.innerHTML = textarea3.innerHTML + "\n" + date.valueOf() + "==>" + price;
            yahooData.push([date, price]);

        });
        
        return yahooData.reverse();
    }

    // create the chart when all data is loaded
    function createChart() {

        chart = new Highcharts.StockChart({
            chart: {
                color:'#000',backgroundColor:'#F4F2EE',renderTo: 'container'
            },
            rangeSelector: {
                selected: 1
            },
            xAxis: {
                labels: {
                 style: {
                     color: '#8A7A67'
                 }  
                }                
            },
            yAxis: {
                labels: {
                 align: 'left',x: 0,y: -2,
                 style: {
                     color: '#8A7A67'
                 }
                }
            },
            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ',
                yDecimals: 2
            },
            plotOptions: {
                series: {
                   color: '#003768'
                }
            },

            series: seriesOptions
        });
    }

});
</script>
  
</body>


</html>
