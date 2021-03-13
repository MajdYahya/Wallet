@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>
                My walllet transactions and summary
            </h2>
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
        <div class="row mt-3">
            <div class="col-8">
                <h1>Chart using <a href="https://www.fusioncharts.com/">FusionCharts</a><span style="font-size:20px"> (Not
                        working)</span></h1>
            </div>
            <div class="col-4">
                <select class="form-control" name="filteration" id="filteration">
                    <option value="daily"> daily</option>
                    <option value="monthly"> monthly</option>
                    <option value="yearly"> yearly</option>
                </select>
            </div>
        </div>
        <div class="chart">
            <script src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
            <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
            <div id="fusioncharts"></div>

        </div>
        <!-- FusionCharts end -->
        <script type="application/javascript">
            // Generate data
            // --------------------------------
            var CHART_TITLE = 'Wallet transactions chart';
            var VALUE_AXIS_TITLE = 'Amount of transactions in JOD';
            var SERIES_TITLE = ['Income ', 'Expense'];

            function getData() {
                return [
                    ['1986', 3.6, 2.3],
                    ['1987', 7.1, 4.0],
                    ['1988', 8.5, 6.2],
                    ['1989', 9.2, 11.8],
                    ['1990', 10.1, 13.0],
                    ['1991', 11.6, 13.9],
                    ['1992', 16.4, 18.0],
                    ['1993', 18.0, 23.3],
                    ['1994', 13.2, 24.7],
                    ['1995', 12.0, 18.0],
                    ['1996', 3.2, 15.1],
                    ['1997', 4.1, 11.3],
                    ['1998', 6.3, 14.2],
                    ['1999', 9.4, 13.7],
                    ['2000', 11.5, 9.9],
                    ['2001', 13.5, 12.1],
                    ['2002', 14.8, 13.5],
                    ['2003', 16.6, 15.1],
                    ['2004', 18.1, 17.9],
                    ['2005', 17.0, 18.9],
                    ['2006', 16.6, 20.3],
                    ['2007', 14.1, 20.7],
                    ['2008', 15.7, 21.6],
                    ['2009', 12.0, 22.5]
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
