@extends('layouts.app')

@section('title', 'HABITUAL OFFENDERS')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
@endsection


@section('content')

    @include('pages.fir-conversions.components.header-title', ['title' => 'HABITUAL OFFENDERS'])

    <div class="row mt-1">
        <canvas id="myBarChart"></canvas>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('myBarChart').getContext('2d');

                const labels = @json($labels);
                const data = @json($data);
                const urls = @json($urls);
                const backgroundColors = @json($backgroundColors);

                const myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '',
                            data: data,
                            backgroundColor: backgroundColors,
                            borderRadius: {
                                topLeft: 10,
                                topRight: 10
                            },
                            borderSkipped: false
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: '#000',
                                    font: {
                                        size: 12.5,
                                        family: 'Arial, sans-serif',
                                        weight: 'bold'
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#000',
                                    font: {
                                        size: 12.5,
                                        family: 'Arial, sans-serif',
                                        weight: 'bold'
                                    }
                                }
                            }
                        },
                        onClick: (event) => {
                            const elements = myBarChart.getElementsAtEventForMode(event, 'nearest', {
                                intersect: true
                            }, true);
                            if (elements.length > 0) {
                                const index = elements[0].index;
                                // Open the URL for the clicked district
                                window.open(urls[index], '_blank');
                            }
                        },
                        onHover: (event, chartElement) => {
                            event.native.target.style.cursor = chartElement[0] ? 'pointer' : 'default';
                        }
                    }
                });
            });
        </script>
    </div>

@endsection

@section('scripts')
@endsection
