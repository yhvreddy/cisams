@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-md-4 box ">
            <h5 class="titl">NCRP Complaints</h5>

            <div class="chart-container">
                <canvas id="mainChartNIK"></canvas>
                <div class="small-chart-container">
                    <a href='{{ route('complaints.non-financial') }}'> <canvas id="nonFinancialChartNIK"></canvas></a>
                    <a href='{{ route('complaints.financial') }}'> <canvas id="financialChartNIK"></canvas></a>
                </div>
            </div>

            <div class="legend-container">
                <div class="legend">
                    <div class="legend-color nonFinancial-color"></div>
                    <a href='{{ route('complaints.non-financial') }}'> <span>Non-Financial</span></a>
                </div>
                <div class="legend">
                    <div class="legend-color financial-color"></div>
                    <a href='{{ route('complaints.financial') }}'> <span>Financial</span></a>
                </div>
            </div>

            <script>
                // Main Doughnut Chart
                const mainChartNIK = new Chart(document.getElementById('mainChartNIK').getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: {!! $graphOneCountJson !!},
                            backgroundColor: ['#002F8A', '#3E77FF'],
                            borderWidth: 0
                        }],
                        labels: ['Financial', 'Non-Financial']
                    },
                    options: {
                        cutout: '55%', // This value makes the doughnut chart thicker
                        responsive: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            },
                            datalabels: {
                                color: '#ffffff',
                                font: {
                                    size: 16,
                                    weight: 'bold'
                                },
                                formatter: (value, ctx) => {
                                    let datasets = ctx.chart.data.datasets;
                                    if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                                        return value;
                                    } else {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                });

                // Non-Financial Pie Chart
                const nonFinancialChartNIK = new Chart(document.getElementById('nonFinancialChartNIK').getContext('2d'), {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: {!! $nonFinancialChartJson !!},
                            backgroundColor: ['#3E77FF', '#E0E0E0'],
                            borderWidth: 0
                        }],
                        labels: ['Non-Financial', 'Other']
                    },
                    options: {
                        responsive: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            },
                            datalabels: {
                                color: '#ffffff',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                },
                                formatter: (value, ctx) => {
                                    let datasets = ctx.chart.data.datasets;
                                    if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                                        return value;
                                    } else {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                });

                // Financial Pie Chart
                const financialChartNIK = new Chart(document.getElementById('financialChartNIK').getContext('2d'), {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: {!! $financialChartJson !!},
                            backgroundColor: ['#002F8A', '#E0E0E0'],
                            borderWidth: 0
                        }],
                        labels: ['Financial', 'Other']
                    },
                    options: {
                        responsive: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: true,
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            },
                            datalabels: {
                                color: '#ffffff',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                },
                                formatter: (value, ctx) => {
                                    let datasets = ctx.chart.data.datasets;
                                    if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                                        return value;
                                    } else {
                                        return value;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>


        </div>

        <div class="col-md-4 box ">
            <h5 class="titl">Trending MO's</h5>
            <canvas id="uniqueChartId" class="chart" style="height: 240px; width: 100%;"></canvas>

            <script>
                const ctx = document.getElementById('uniqueChartId').getContext('2d');
                const uniqueChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! $categoryNamesJson !!},
                        datasets: [{
                                label: '{{ $lastThreeMonths[0] }}',
                                data: {!! $monthDataJson[$lastThreeMonths[0]] !!},
                                backgroundColor: '#375CE1',
                                borderRadius: 10, // Rounded top corners
                                borderWidth: 0
                            },
                            {
                                label: '{{ $lastThreeMonths[1] }}',
                                data: {!! $monthDataJson[$lastThreeMonths[1]] !!},
                                backgroundColor: '#C6D2FF',
                                borderRadius: 10, // Rounded top corners
                                borderWidth: 0
                            },
                            {
                                label: '{{ $lastThreeMonths[2] }}',
                                data: {!! $monthDataJson[$lastThreeMonths[2]] !!},
                                backgroundColor: '#092081',
                                borderRadius: 10, // Rounded top corners
                                borderWidth: 0
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 9
                                    }
                                }
                            },
                            title: {
                                display: false,
                                text: '',
                                font: {
                                    size: 14,
                                    family: 'Red Hat Display',
                                    weight: 'bold',
                                    color: '#262626'
                                }
                            }
                        },
                        scales: {
                            x: {
                                stacked: false, // Do not stack bars
                                ticks: {
                                    font: {
                                        size: 9
                                    },
                                    stepSize: 10,
                                    min: 0,
                                    max: 40,
                                    padding: 10 // Increase space around x-axis labels
                                },
                                grid: {
                                    offset: true,
                                    borderColor: 'rgba(0, 0, 0, 0.1)',
                                    borderWidth: 1
                                }
                            },
                            y: {
                                beginAtZero: true,
                                stacked: false, // Do not stack bars
                                ticks: {
                                    font: {
                                        size: 9
                                    },
                                    callback: function(value) {
                                        // Ensure horizontal display and multi-line if needed
                                        return value.toString();
                                    },
                                    maxRotation: 0, // Ensure labels are horizontal
                                    minRotation: 0
                                },
                                grid: {
                                    borderColor: 'rgba(0, 0, 0, 0.1)',
                                    borderWidth: 1
                                }
                            }
                        }
                    }
                });
            </script>



        </div>

        <div class="col-md-4 box">
            <h5 class="titl"> FIR Conversions</h5>
            <a href='{{ route('fir-conversions.complaints') }}'>
                <canvas id="chartNik2024TwoCols" class="chart" style="height: 240px; width: 100%;"></canvas>
            </a>

            <script>
                (function() {
                    const ctx = document.getElementById('chartNik2024TwoCols').getContext('2d');
                    const uniqueChartTwoCols = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: @json($firConversionData['categories']),
                            datasets: [{
                                    label: 'Total Complaints',
                                    data: @json($firConversionData['total_complaints']),
                                    backgroundColor: '#375CE1',
                                    borderRadius: 10, // Rounded top corners
                                    borderWidth: 0
                                },
                                {
                                    label: 'FIR Converted',
                                    data: @json($firConversionData['fir_converted']),
                                    backgroundColor: '#C6D2FF',
                                    borderRadius: 10, // Rounded top corners
                                    borderWidth: 0
                                },
                                {
                                    label: 'Pending Conversion',
                                    data: @json($firConversionData['pending_conversion']),
                                    backgroundColor: '#092081',
                                    borderRadius: 10, // Rounded top corners
                                    borderWidth: 0
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // Allows the chart to resize to the container's height
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        font: {
                                            size: 9
                                        }
                                    }
                                },
                                title: {
                                    display: false,
                                    text: '',
                                    font: {
                                        size: 14,
                                        family: 'Red Hat Display',
                                        weight: 'bold',
                                        color: '#262626'
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    stacked: false, // Do not stack bars
                                    ticks: {
                                        font: {
                                            size: 9
                                        },
                                        padding: 10 // Increase space around x-axis labels
                                    },
                                    grid: {
                                        offset: true,
                                        borderColor: 'rgba(0, 0, 0, 0.1)',
                                        borderWidth: 1
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    stacked: false, // Do not stack bars
                                    ticks: {
                                        font: {
                                            size: 9
                                        },
                                        min: 0,
                                        max: 250,
                                        stepSize: 50,
                                        callback: function(value) {
                                            return value.toString();
                                        },
                                        maxRotation: 0, // Ensure labels are horizontal
                                        minRotation: 0
                                    },
                                    grid: {
                                        borderColor: 'rgba(0, 0, 0, 0.1)',
                                        borderWidth: 1
                                    }
                                }
                            }
                        }
                    });
                })(); // Encapsulating the script to prevent conflicts
            </script>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4 box">
            <h5 class="titl">Case Status</h5>
            <a href='{{ route('case-status.pe') }}'> <canvas id="uniqueCaseStatusChart" height="240"></canvas>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const ctx = document.getElementById('uniqueCaseStatusChart').getContext('2d');
                        const uniqueCaseStatusChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [
                                    'Pending\nEvidence',
                                    'Pending\nArrest',
                                    'Pending\nChargesheet',
                                    'Charged',
                                    'Unter\nTrial',
                                    'Closed'
                                ],
                                datasets: [{
                                        label: 'Pending Evidence',
                                        data: [80, 0, 0, 0, 0, 0],
                                        backgroundColor: '#1F3C88'
                                    },
                                    {
                                        label: 'Pending Arrest',
                                        data: [0, 30, 0, 0, 0, 0],
                                        backgroundColor: '#A3BFFA'
                                    },
                                    {
                                        label: 'Pending Chargesheet',
                                        data: [0, 0, 20, 0, 0, 0],
                                        backgroundColor: '#7396FF'
                                    },
                                    {
                                        label: 'Charged',
                                        data: [0, 0, 0, 70, 0, 0],
                                        backgroundColor: '#7080FF'
                                    },
                                    {
                                        label: 'Unter Trial',
                                        data: [0, 0, 0, 0, 40, 0],
                                        backgroundColor: '#A9B6FF'
                                    },
                                    {
                                        label: 'Closed',
                                        data: [0, 0, 0, 0, 0, 10],
                                        backgroundColor: '#A8AEDB'
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    x: {
                                        ticks: {
                                            autoSkip: false,
                                            maxRotation: 0, // Ensure labels are horizontal
                                            minRotation: 0,
                                            font: {
                                                size: 10, // Smaller font size for labels
                                                family: 'Red Hat Display'
                                            }
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        max: 90,
                                        ticks: {
                                            stepSize: 10
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        align: 'end',
                                        labels: {
                                            usePointStyle: true,
                                            color: '#000',
                                            font: {
                                                size: 10
                                            }
                                        }
                                    }
                                },
                                maintainAspectRatio: false,
                                responsive: true
                            }
                        });
                    });
                </script>

            </a>




        </div>

        <div class="col-md-4 box">
            <h5 class="titl">PT Warrant Status</h5>

            <div id="myNewChartContainer">
                <canvas id="myNewChart"></canvas>
            </div>

            <script>
                const ptWarrantyUrls = [
                    "{{ route('pt_warranty.fir-links') }}", // URL for Fir Links
                    "{{ route('pt_warranty.ncrp-links') }}", // URL for NCRP Links
                    "{{ route('pt_warranty.executed') }}", // URL for PT Warrants Executed
                    "{{ route('pt_warranty.pending') }}" // URL for PT Warrants Pending
                ];
                const ctxNewChart = document.getElementById('myNewChart').getContext('2d');
                const myNewChartInstance = new Chart(ctxNewChart, {
                    type: 'bar',
                    data: {
                        labels: [
                            'Fir\nLinks',
                            'NCRP\nLinks',
                            'PT Warrants\nExecuted',
                            'PT Warrants\nPending'
                        ],
                        datasets: [{
                            data: {!! $ptWarrantCountsJSON !!},
                            backgroundColor: [
                                '#375CE1',
                                '#C6D2FF',
                                '#092081',
                                '#6F8CF1'
                            ],
                            borderWidth: 0,
                            barThickness: 40,
                            borderRadius: {
                                topRight: 10,
                                bottomRight: 10,
                            },
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            x: {
                                display: true,
                                max: 1500
                            },
                            y: {
                                display: false, // Hide the bar titles
                                beginAtZero: true,
                                min: 0,
                                max: 1500,
                                ticks: {
                                    display: false // Hide the ticks on the Y-axis
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                align: 'end',
                                labels: {
                                    boxWidth: 8,
                                    font: {
                                        size: 8,
                                        padding: 4
                                    },
                                    generateLabels: function(chart) {
                                        const labels = chart.data.labels;
                                        const backgroundColor = chart.data.datasets[0].backgroundColor;
                                        return labels.map((label, index) => ({
                                            text: label.replace(/\n/g, ' '),
                                            fillStyle: backgroundColor[index],
                                            hidden: false,
                                            lineCap: 'round',
                                            lineDash: [],
                                            lineDashOffset: 0,
                                            lineJoin: 'round',
                                            strokeStyle: backgroundColor[index],
                                            pointStyle: 'rectRounded',
                                            rotation: 0,
                                        }));
                                    }
                                }
                            }
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        onClick: function(e) {
                            const activePoints = myNewChartInstance.getElementsAtEventForMode(e, 'nearest', {
                                intersect: true
                            }, false);
                            if (activePoints.length) {
                                const index = activePoints[0].index;
                                window.location.href = ptWarrantyUrls[index]; // Redirect to the corresponding URL
                            }
                        }
                    }
                });
            </script>
        </div>

        <div class="col-md-4 box">
            <h5 class="titl">Refund Status</h5>
            <canvas id="myChartRefundStatus" height="240"></canvas>

            <script>
                const ctxRefundChart = document.getElementById('myChartRefundStatus').getContext('2d');
                const myRefundChart = new Chart(ctxRefundChart, {
                    type: 'bar',
                    data: {
                        labels: ['POH-<25000', 'POH-FIR'],
                        datasets: [{
                                label: 'Refund Orders Pending',
                                data: [50, 60],
                                backgroundColor: '#375CE1',
                                borderRadius: 10
                            },
                            {
                                label: 'Refund Orders Received',
                                data: [75, 70],
                                backgroundColor: '#C6D2FF',
                                borderRadius: 10
                            },
                            {
                                label: 'Refund Petitions Pending',
                                data: [65, 20],
                                backgroundColor: '#092081',
                                borderRadius: 10
                            },
                            {
                                label: 'Refund Petitions Filed',
                                data: [85, 40],
                                backgroundColor: '#000000',
                                borderRadius: 10
                            },
                            {
                                label: 'Total Cases',
                                data: [105, 110],
                                backgroundColor: '#092081',
                                borderRadius: 10
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                });
            </script>

            <!-- 6-column chart end - Refund Status -->

        </div>

    </div>
@endsection

@section('scripts')
@endsection
