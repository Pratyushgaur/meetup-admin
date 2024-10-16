@extends('influencer.login_pages.app')

@section('content')
<header>
    <nav class="navbar--verify">
        <div class="back--nav">
            <a href="javascript:void(0)" onclick="history.back()" class="back--btn">
                <img src="{{ asset('assets/images/back-arrow.png') }}" alt="" class="back--arrow">
            </a>
            <span class="header-text verify--text--nav nav-link">
                Analysis
            </span>
        </div>
    </nav>
</header>
<main>
    <div class="container-fluid">
        <div class="graph--section mt-5">
            <p class="graph--heading">Websites Visits</p>
            <div id='website_chart' class="chart--box"></div>
        </div>

        <div class="graph--section mt-5">
            <p class="graph--heading">Order Amount</p>
            <div id='order_chart' class="chart--box"></div>
        </div>

        <div class="graph--section mt-5">
            <p class="graph--heading">Number of Order</p>
            <div id='number_chart' class="chart--box"></div>
        </div>
    </div>

</main>
@endsection

@push('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(websiteChart);
    google.charts.setOnLoadCallback(orderChart);
    google.charts.setOnLoadCallback(numberChart);

    function websiteChart() {
        var data = google.visualization.arrayToDataTable([
            ['date', 'Activity'],
            [new Date(2014, 2, 15),1],
            [new Date(2014, 3, 15),3],
            [new Date(2014, 4, 15),4],
            [new Date(2014, 5, 15),5],
            [new Date(2014, 6, 15),8],
            [new Date(2014, 7, 15),6],
            [new Date(2014, 8, 15),7],
            [new Date(2014, 9, 15),3],
        ]);

        var options = {
            legend: 'none',
            crosshair: {
                trigger: 'both',
                orientation: 'both'
            },

            hAxis: {
                format: 'd-M-yyyy',
                gridline: {
                    count:15
                }
            },
            chartArea: {
                top: 5,
                left: 25,
                right: 10,
                bottom: 50,
            },
        };

        var chart = new google.visualization.LineChart(document.getElementById('website_chart'));
        chart.draw(data, options);
    }
    
    function orderChart() {
        var data = google.visualization.arrayToDataTable([
            ['date', 'Activity'],
            [new Date(2014, 2, 15),1],
            [new Date(2014, 3, 15),3],
            [new Date(2014, 4, 15),4],
            [new Date(2014, 5, 15),5],
            [new Date(2014, 6, 15),8],
            [new Date(2014, 7, 15),6],
            [new Date(2014, 8, 15),7],
            [new Date(2014, 9, 15),3],
        ]);

        var options = {
            legend: 'none',
            crosshair: {
                trigger: 'both',
                orientation: 'both'
            },

            hAxis: {
                format: 'd-M-yyyy',
                gridline: {count:8}
            },
            chartArea: {
                top: 5,
                left: 25,
                right: 10,
                bottom: 50,
            },
        };

        var chart = new google.visualization.AreaChart(document.getElementById('order_chart'));
        chart.draw(data, options);
    }

    function numberChart() {
        var data = google.visualization.arrayToDataTable([
            ['date', 'Activity'],
            [new Date(2014, 2, 15),1],
            [new Date(2014, 3, 15),3],
            [new Date(2014, 4, 15),4],
            [new Date(2014, 5, 15),5],
            [new Date(2014, 6, 15),8],
            [new Date(2014, 7, 15),6],
            [new Date(2014, 8, 15),7],
            [new Date(2014, 9, 15),3],
        ]);

        var options = {
            legend: 'none',
            crosshair: {
                trigger: 'both',
                orientation: 'both'
            },

            hAxis: {
                format: 'd-M-yyyy',
                gridline: {count:8}
            },
            chartArea: {
                top: 5,
                left: 25,
                right: 10,
                bottom: 50,
            },
        };

        var chart = new google.visualization.AreaChart(document.getElementById('number_chart'));
        chart.draw(data, options);
    }

    
</script>
@endpush