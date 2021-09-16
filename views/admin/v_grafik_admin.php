<!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
<script src="<?= base_url('assets/highcharts/code/highcharts.js') ?>" crossorigin="anonymous"></script>
<!-- <script src="<?= base_url('assets/highcharts/code/export-data.js') ?>"></script> -->
<!-- <script src="<?= base_url('assets/highcharts/code/exporting.js') ?>"></script> -->

<!-- php komentari aja gak guna -->
<!-- <?php
        
        $data = [];
        foreach($nama_paket as $pk){
            $nama = $pk["nama_paket"];
            $jml = intval($pk["jumlah"]);
            $data[] = [
                'name' => $nama,
                'y' => $jml,
            ];
        }

        $data_penerima = [];
        foreach($penerima as $pen){
            $nama_penerima = $pen["penerima"];
            $jumlah_penerima = intval($pen["jumlah"]);
            $data_penerima[] = [
                'name' => $nama_penerima,
                'y' => $jumlah_penerima,
            ];
        }
        
    ?> -->
    <div id="tampil_counts"></div>
    <section id="counts" class="counts bg-success">
      <div class="container ">

        <div class="row counters">

          <div class="col-lg-6 col-6 text-center">
            <span data-toggle="counter-up"><?= $hitungCod ?></span>
            <p>COD</p>
          </div>

          <div class="col-lg-6 col-6 text-center">
            <span data-toggle="counter-up"><?= $hitungLangsung ?></span>
            <p>Langsung</p>
          </div>

          <!-- <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1,463</span>
            <p>Hours Of Support</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">15</span>
            <p>Hard Workers</p>
          </div> -->

        </div>

      </div>
    </section><!-- End Counts Section -->

<div class="row content">
    <div class="col-lg-6 mt-5" data-aos="fade-right" data-aos-delay="100">
        <!-- grafik nama paketan  -->
        <div class="mb-5" id="nama_paketan" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <!-- grafik jenis kirim  -->
        <div class="mb-5" id="jenis_kirim" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
    <div class="col-lg-6 pt-4 pt-lg-0 mt-5 mb-4" data-aos="fade-left" data-aos-delay="200">
        <!-- grafik duta paket -->
        <div class="mb-5" id="duta_paket" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        <ul>
            <!-- grafik duta penerima -->
        <div class="mb-5" id="duta_penerima" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </ul>

        <p id="peringkat" class="font-italic float: right pl-4">
            <!-- peringkat disini -->
        </p>
    </div>

    <div class="alert alert-danger ml-3">
        <i class="fas fa-exclamation-triangle" style="font-size: 100px;"></i>
    </div>
    <div class="col-md-10 font-italic alert alert-danger" style="text-align: justify;">
        <?php foreach($getWarning as $warning) {echo $warning["warning"];} ?>
        <a onclick="myFunction()" class="fa fa-edit"></a>

    </div>

    <div class="col-md-12 font-italic" id="warning" style="display: none;">
        <form action="<?= base_url('admin/updateWarning/')?>" method="post">
            <textarea class="form-control" name="warning" cols="" rows="10"><?php foreach($getWarning as $warning) {echo $warning["warning"];} ?></textarea>

            <button class="btn btn-sm btn-success" type="submit" name="btn_warning">Update</button>
        </form>
    </div>

    <div id="container"></div>

    <script>
        function myFunction() {
            var x = document.getElementById('warning');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
        }
    </script>
    
</div>

<script>

//jika tidak pilih tahun atau pertama kali buka halaman
var tahun = $('#tahun').val()
if(tahun == ""){
    var tahun = new Date().getFullYear()
    var link = 'http://'+ window.location.host +'/cek-paketan-ci/admin/grafikNamaPaket/'+tahun+''
    $.getJSON(link, function(data) {
        // var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
        // if(!isChrome){
        //     alert("Supaya Menikmati Fitur Gunakan Chrome Terbaru")
        // }
        var rangking = data.data_rangking
        // console.log(rangking)
        var nama_paket = data.nama_paket
        // document.write(nama_paket)
        var langsung = data.langsung
        var cod = data.cod
        var nama_paketan = []
        var jumlah = []
        var jenis_kirim = []
        var jumlah_kirim_cod = []
        var jumlah_kirim_langsung = []

        // $(data_paketan_admin).each(function(i){
        //     // alert(i)
        // })

        $(langsung).each(function(ia){
            jumlah_kirim_langsung.push(langsung[ia].jumlah_langsung);
        })
        $(cod).each(function(i){
            jumlah_kirim_cod.push(cod[i].jumlah_cod);
        })
        $(nama_paket).each(function(i){
            nama_paketan.push(nama_paket[i].nama_paket);
            jumlah.push(parseFloat(nama_paket[i].jumlah));
            jenis_kirim.push(nama_paket[i].jenis_kirim);
        })
        // alert(nama_paketan)
        // console.log(data)


        var peringkat = []
        var no = 1;
        $(rangking).each(function(i){
            peringkat.push("Peringkat " + no++ + " adalah " + rangking[i].nama + " dengan jumlah " +  rangking[i].jumlah + "<br>")
        })
        
        $("#peringkat").html(peringkat)

       var jml_langsung = jumlah_kirim_langsung.length
       var jml_cod = jumlah_kirim_cod.length
    //    alert(peringkat)

       //grafik nama paketan
       Highcharts.chart('nama_paketan', {

            chart: {
            type: 'line'
            },

            title: {
            text: 'Paketan'
            },

            xAxis: {
            categories: nama_paketan
            },

            yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Jumlah Paketan'
            }
            },

            tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>Total Paketan: ' + this.y + '<br/>'
                //  +
                // this.series.name + ': ' + this.y + '<br/>' +
                // 'Total: ' + this.point.stackTotal + 
                // '<br>' +'Langsung:' + jumlah_kirim_langsung + '<br>' +'COD:' + jumlah_kirim_cod;
            }
            },

            plotOptions: {
            column: {
                stacking: 'normal'
            }
            },
            
            series: 
            [
            {
                name: 'Paketan'   ,
                data: jumlah,
            },

            //  {
            // name: 'Joe',
            // data: [3, 4, 4, 2, 5],
            // stack: 'male'
            // }, {
            // name: 'Jane',
            // data: [2, 5, 6, 2, 1],
            // stack: 'female'
            // }, {
            // name: 'Janet',
            // data: [3, 0, 4, 4, 3],
            // stack: 'female'
            // }
        ]
        });
        //grafik jenis kirim
        Highcharts.chart('jenis_kirim', {

            chart: {
            type: 'column'
            },

            title: {
            text: 'Jumlah Jenis Kirim'
            },

            xAxis: {
            categories: ['Langsung', 'COD']
            },

            yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Jumlah Jenis Kirim'
            }
            },

            tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
            }
            },

            plotOptions: {
            column: {
                stacking: 'normal'
            }
            },

            series: [
                {
            name: 'Langsung',
            data: [jml_langsung, jml_cod],
            stack: 'male'
            }, 
            {
            name: 'COD',
            data: [jml_cod],
            stack: 'male'
            },
            //  {
            // name: 'Jane',
            // data: [2, 5, 6, 2, 1],
            // stack: 'female'
            // }, {
            // name: 'Janet',
            // data: [3, 0, 4, 4, 3],
            // stack: 'female'
            // }
        ]
        });
        //grafik duta paket
        Highcharts.chart('duta_paket', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Duta Paktean'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: data.paketan_admin
            //     [
            //         {
            //         name: 'Chrome',
            //         y: 61.41,
            //         sliced: true,
            //         selected: true
            //     }, 
            //     {
            //         name: data.paketan_admin,
            //         y: 10.85
            //     }, {
            //         name: 'Edge',
            //         y: 4.67
            //     }, {
            //         name: 'Safari',
            //         y: 4.18
            //     }, {
            //         name: 'Sogou Explorer',
            //         y: 1.64
            //     }, {
            //         name: 'Opera',
            //         y: 1.6
            //     }, {
            //         name: 'QQ',
            //         y: 1.2
            //     }, {
            //         name: 'Other',
            //         y: 2.61
            //     }
            // ]
            }]
        });

        //grafik duta peneruma
        Highcharts.chart('duta_penerima', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Duta Penerima'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                // data: data.data_admin_penerima
                // data: data.paketan_admin
                data: data.data_admin_penerima
            //     [
                //     {
                //     name: 'Chrome',
                //     y: 61.41,
                //     sliced: true,
                //     selected: true
                // }, 
            //     {
            //         name: 'Firefox',
            //         y: 10.85
            //     }, {
            //         name: 'Edge',
            //         y: 4.67
            //     }, {
            //         name: 'Safari',
            //         y: 4.18
            //     }, {
            //         name: 'Sogou Explorer',
            //         y: 1.64
            //     }, {
            //         name: 'Opera',
            //         y: 1.6
            //     }, {
            //         name: 'QQ',
            //         y: 1.2
            //     }, {
            //         name: 'Other',
            //         y: 2.61
            //     }
            // ]
            }]
        });
    });
}

//ini jika pilih tahun
$('#tahun').on('change', function(event) {
    

    var tahun = $('#tahun').val()

    if(tahun != "") {
        var tahun = $('#tahun').val()
        // alert(tahun)
    }else{
        var tahun = <?= date('YYYY')?>
    }


    var link = 'http://'+ window.location.host +'/cek-paketan-ci/admin/grafikNamaPaket/'+tahun+''
    $.getJSON(link, function(data) {
        // var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
        // if(!isChrome){
        //     alert("Supaya Menikmati Fitur Gunakan Chrome Terbaru")
        // }
        // console.log(data.cod_counts[0].jumlah_cod_counts)
        // console.log(data.langsung_counts[0].jumlah_langsung_counts)
        var counts = "<div class='container'><div class='row counters'><div class='col-lg-6 col-6 text-center'><span data-toggle='counter-up'>"+ data.cod_counts[0].jumlah_cod_counts +"</span><p>COD</p></div><div class='col-lg-6 col-6 text-center'><span data-toggle='counter-up'>"+ data.langsung_counts[0].jumlah_langsung_counts +"</span><p>Langsung</p></div></div></div>"

        $('#counts').html(counts)
        
        var data_paketan_admin = data.paketan_admin
        var data_paketan_admin_penerima = data.data_admin_penerima
        var rangking = data.data_rangking
        // console.log(rangking)
        var nama_paket = data.nama_paket
        var langsung = data.langsung
        var cod = data.cod
        var nama_paketan = []
        var jumlah = []
        var jenis_kirim = []
        var jumlah_kirim_cod = []
        var jumlah_kirim_langsung = []

        $(langsung).each(function(ia){
            jumlah_kirim_langsung.push(langsung[ia].jumlah_langsung);
        })
        $(cod).each(function(i){
            jumlah_kirim_cod.push(cod[i].jumlah_cod);
        })
        $(nama_paket).each(function(i){
            nama_paketan.push(nama_paket[i].nama_paket);
            jumlah.push(parseFloat(nama_paket[i].jumlah));
            jenis_kirim.push(nama_paket[i].jenis_kirim);
        })
        // alert(data_duta_paketan_y_penerima)
        // console.log(data)

        var peringkat = []
        var no = 1;
        $(rangking).each(function(i){
            peringkat.push("Peringkat " + no++ + " adalah " + rangking[i].nama + " dengan jumlah " +  rangking[i].jumlah + "<br>")
        })
        
        $("#peringkat").html(peringkat)

       var jml_langsung = jumlah_kirim_langsung.length
       var jml_cod = jumlah_kirim_cod.length
    //    alert(peringkat)

       //grafik nama paketan
       Highcharts.chart('nama_paketan', {

            chart: {
            type: 'line'
            },

            title: {
            text: 'Paketan'
            },

            xAxis: {
            categories: nama_paketan
            },

            yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Jumlah Paketan'
            }
            },

            tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>Total Paketan: ' + this.y + '<br/>'
                //  +
                // this.series.name + ': ' + this.y + '<br/>' +
                // 'Total: ' + this.point.stackTotal + 
                // '<br>' +'Langsung:' + jumlah_kirim_langsung + '<br>' +'COD:' + jumlah_kirim_cod;
            }
            },

            plotOptions: {
            column: {
                stacking: 'normal'
            }
            },
            
            series: 
            [
            {
                name: 'Paketan'   ,
                data: jumlah,
            },

            //  {
            // name: 'Joe',
            // data: [3, 4, 4, 2, 5],
            // stack: 'male'
            // }, {
            // name: 'Jane',
            // data: [2, 5, 6, 2, 1],
            // stack: 'female'
            // }, {
            // name: 'Janet',
            // data: [3, 0, 4, 4, 3],
            // stack: 'female'
            // }
        ]
        });
        //grafik jenis kirim
        Highcharts.chart('jenis_kirim', {

            chart: {
            type: 'column'
            },

            title: {
            text: 'Jumlah Jenis Kirim'
            },

            xAxis: {
            categories: ['Langsung', 'COD']
            },

            yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Jumlah Jenis Kirim'
            }
            },

            tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
            }
            },

            plotOptions: {
            column: {
                stacking: 'normal'
            }
            },

            series: [
                {
            name: 'Langsung',
            data: [jml_langsung, jml_cod],
            stack: 'male'
            }, 
            {
            name: 'COD',
            data: [jml_cod],
            stack: 'male'
            },
            //  {
            // name: 'Jane',
            // data: [2, 5, 6, 2, 1],
            // stack: 'female'
            // }, {
            // name: 'Janet',
            // data: [3, 0, 4, 4, 3],
            // stack: 'female'
            // }
        ]
        });
        //grafik duta paket
        Highcharts.chart('duta_paket', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Duta Paktean'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: 
                // [
                    data.paketan_admin
                //     {
                //     name: 'Chrome',
                //     y: 61.41,
                //     sliced: true,
                //     selected: true
                // }, 
                // {
                //     name: data.paketan_admin,
                //     y: 10.85
                // }, {
                //     name: 'Edge',
                //     y: 4.67
                // }, {
                //     name: 'Safari',
                //     y: 4.18
                // }, {
                //     name: 'Sogou Explorer',
                //     y: 1.64
                // }, {
                //     name: 'Opera',
                //     y: 1.6
                // }, {
                //     name: 'QQ',
                //     y: 1.2
                // }, {
                //     name: 'Other',
                //     y: 2.61
                // }
            // ]
            }]
        });

        //grafik duta peneruma
        Highcharts.chart('duta_penerima', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Duta Penerima'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Persentase',
                colorByPoint: true,
                data: data.data_admin_penerima
                // [
                //     {
                //     name: 'Chrome',
                //     y: 61.41,
                //     sliced: true,
                //     selected: true
                // }, 
                // {
                //     name: 'Firefox',
                //     y: 10.85
                // },
                //  {
            //         name: 'Edge',
            //         y: 4.67
            //     }, {
            //         name: 'Safari',
            //         y: 4.18
            //     }, {
            //         name: 'Sogou Explorer',
            //         y: 1.64
            //     }, {
            //         name: 'Opera',
            //         y: 1.6
            //     }, {
            //         name: 'QQ',
            //         y: 1.2
            //     }, {
            //         name: 'Other',
            //         y: 2.61
            //     }
            // ]
            }]
        });
    });

})
</script>
<script src="<?= base_url('assets/highcharts/code/exporting.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/code/export-data.js') ?>"></script>