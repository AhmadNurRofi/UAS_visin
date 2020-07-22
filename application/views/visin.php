<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Visin Google Charts</title>
    <link rel="stylesheet" href="<?php echo base_url('vendor/uikit/css/'); ?>uikit.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>    
    <script type="text/javascript">
        // Mengambil API visualisasi.
        google.charts.load('current', {'packages':['corechart']});
        //mengambil data dari variabel PHP
        var region=[];
        region['dataStr'] = '<?php echo $region;?>';        
        region['dataArray'] = JSON.parse(region['dataStr']);   
        //menggambar grafik
        google.charts.setOnLoadCallback(function(){
            drawChart(region['dataArray'], 'pie','region');       
        });

        var bancana=[];
        bancana['dataStr'] = '<?php echo $bancana;?>';        
        bancana['dataArray'] = JSON.parse(bancana['dataStr']);
  
        google.charts.setOnLoadCallback(function(){
            drawChart(region['dataArray'], 'pie','region');
            drawChart(bancana['dataArray'],'bar','bancana');        
        });

        var terdampak=[];
        terdampak['dataStr'] = '<?php echo $terdampak;?>';        
        terdampak['dataArray'] = JSON.parse(terdampak['dataStr']);    
        //menggambar grafik
        google.charts.setOnLoadCallback(function(){
            drawChart(region['dataArray'], 'pie','region');
            drawChart(bancana['dataArray'],'bar','bancana');
            drawChart(terdampak['dataArray'],'bar','terdampak');        
        });



        // Menentukan data yang akan ditampilkan
        function drawChart(dataArray,type,container) {
            // Membuat data tabel yang sesuai dengan format google chart dari sumber data array javascript
            var data = new google.visualization.arrayToDataTable(dataArray,false);      
            // Tentukan pengaturan chart
            var options = {
                legend:'bottom',            
                titlePosition:'none',
                titleTextStyle:{fontSize:18},
                chartArea:{width:'80%',height:'70%'}                      
                };
            if(type == 'pie')
            {
                var chart = new google.visualization.PieChart(document.getElementById(container));
            }
            if(type == 'column')
            {
                var chart = new google.visualization.ColumnChart(document.getElementById(container));
            }
            if(type == 'bar')
            {
                var chart = new google.visualization.BarChart(document.getElementById(container));
            }
            chart.draw(data, options);
        }
    </script> 
</head>
<body>
<div class="uk-position-relative">
    <img src="<?= base_url() ?>/assets/im.jpg" alt="">
    <div class="uk-position-top">
        <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
            <div class="uk-navbar-center">
                    <a class="uk-navbar-item uk-logo uk-text-warning uk-text-bold" href="#">Data Kejadian Bencana Alam di Jawa Tengah 2018</a>
            </div>
        </nav>
    <div class="uk-container">
        <div class="uk-child-width-1-2@s" uk-grid uk-height-match="target: > div > .uk-card">    
            <div>
                <div class="uk-card uk-card-default uk-card-small uk-card-body" >
                    <h3 class="uk-card-title">Kabupaten yang Trdampak Bencana Alam</h3>
                    <div id="region" style="height:350px;"></div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-small uk-card-body" >
                    <h3 class="uk-card-title">Kecamatan yang Trdampak Bencana Alam</h3>
                    <div id="bancana" style="height:350px;"></div>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-default uk-card-small uk-card-body" >
                    <h3 class="uk-card-title">Bencana Alam yang Terjadi</h3>
                    <div id="terdampak" style="height:350px;"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="<?php echo base_url('vendor/uikit/js/'); ?>uikit.js"></script>
</body>
</html>