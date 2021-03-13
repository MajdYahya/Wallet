@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-4 border-right ">
                                    <div class="h-100 justify-content-center align-items-center">
                                        <h4 class="text-center">Wallet Balance</h4>
                                        <h2 class="text-center">{{ $balance }}</h2>
                                    </div>
                                </div>
                                <div class="col-4 justify-content-center">
                                    <div class="h-100 justify-content-center align-items-center">
                                        <h4 class="text-center">Income</h4>
                                        <h2 class="text-center">+{{ $income }}</h2>
                                    </div>
                                </div>
                                <div class="col-4 border-left justify-content-center">
                                    <div class="h-100 justify-content-center align-items-center">
                                        <h4 class="text-center">Expenses</h4>
                                        <h2 class="text-center">-{{ $expanse }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <!-- FusionCharts begin -->
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <select class="form-control" name="filteration" id="filteration">
                    <option value="daily"> daily</option>
                    <option value="monthly"> monthly</option>
                    <option value="yearly"> monthly</option>
                </select>
            </div>
        </div>
        <div class="chart">
            <script src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
            <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
            <h1>Chart #6 <a href="https://www.fusioncharts.com/">FusionCharts</a></h1>
            <div id="fusioncharts"></div>
        </div>
        <!-- FusionCharts end -->
        <script type="application/javascript">
            // Generate data
            // --------------------------------
            var CHART_TITLE = 'Trend of Sales of the Most Popular Products';
            var VALUE_AXIS_TITLE = 'Number of Bottles Sold (thousands)';
            var SERIES_TITLE = ['Brandy', 'Whiskey', 'Tequila'];

            function getData() {
                return [
                    ['1986', 3.6, 2.3, 2.8],
                    ['1987', 7.1, 4.0, 4.1],
                    ['1988', 8.5, 6.2, 5.1],
                    ['1989', 9.2, 11.8, 6.5],
                    ['1990', 10.1, 13.0, 12.5],
                    ['1991', 11.6, 13.9, 18.0],
                    ['1992', 16.4, 18.0, 21.0],
                    ['1993', 18.0, 23.3, 20.3],
                    ['1994', 13.2, 24.7, 19.2],
                    ['1995', 12.0, 18.0, 14.4],
                    ['1996', 3.2, 15.1, 9.2],
                    ['1997', 4.1, 11.3, 5.9],
                    ['1998', 6.3, 14.2, 5.2],
                    ['1999', 9.4, 13.7, 4.7],
                    ['2000', 11.5, 9.9, 4.2],
                    ['2001', 13.5, 12.1, 1.2],
                    ['2002', 14.8, 13.5, 5.4],
                    ['2003', 16.6, 15.1, 6.3],
                    ['2004', 18.1, 17.9, 8.9],
                    ['2005', 17.0, 18.9, 10.1],
                    ['2006', 16.6, 20.3, 11.5],
                    ['2007', 14.1, 20.7, 12.2],
                    ['2008', 15.7, 21.6, 10],
                    ['2009', 12.0, 22.5, 8.9]
                ]
            }

            function getDataColumn(data, сolumn) {
                var сolumtData = [];
                data.forEach(function(element) {
                    сolumtData.push(element[сolumn]);
                });
                return сolumtData;
            };





            // FusionCharts
            // --------------------------------
            // Convert data function
            function returnLabelFusionCharts(data) {
                var сolumtData = [];
                data.forEach(function(element) {
                    var returnObj = new Object();
                    returnObj.label = element[0];
                    сolumtData.push(returnObj);
                });
                return сolumtData;
            };

            function returnDataColumnFusionCharts(data, сolumn) {
                var сolumtData = [];
                data.forEach(function(element) {
                    var returnObj = new Object();
                    returnObj.value = element[сolumn];
                    сolumtData.push(returnObj);
                });
                return сolumtData;
            };

            // Create data set and series
            var data = getData();

            const dataSource = {
                chart: {
                    //caption: CHART_TITLE,
                    //yaxisname: VALUE_AXIS_TITLE,
                    showhovereffect: "1",
                    drawcrossline: "1",
                    plottooltext: "<b>$dataValue</b> $seriesName",
                    theme: "fusion"
                },
                categories: [{
                    category: returnLabelFusionCharts(data)
                }],
                dataset: [{
                        seriesname: SERIES_TITLE[0],
                        data: returnDataColumnFusionCharts(data, 1)
                    },
                    {
                        seriesname: SERIES_TITLE[1],
                        data: returnDataColumnFusionCharts(data, 2)
                    },
                    {
                        seriesname: SERIES_TITLE[2],
                        data: returnDataColumnFusionCharts(data, 3)
                    }
                ]
            };

            FusionCharts.ready(function() {
                var myChart = new FusionCharts({
                    type: "msline",
                    renderAt: "fusioncharts",
                    width: "100%",
                    height: "100%",
                    dataFormat: "json",
                    dataSource
                }).render();
            });

        </script>
    </div>
@endsection
