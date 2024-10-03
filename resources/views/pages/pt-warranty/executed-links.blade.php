@extends('layouts.app')

@section('title', 'Executed Links - District Graph | PT Warranty')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', [
        'title' => 'Executed Links - District Graph',
    ])


    <div class="row mt-1">
        <canvas id="myBarChart"></canvas>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('myBarChart').getContext('2d');

                const districtLabels = @json($districtLabels); // Dynamic labels
                const districtData = @json($districtData); // Dynamic data
                const districtLinks = @json($districtLinks); // Dynamic links
                const backgroundColors = @json($colors); // Dynamic colors for each bar

                const myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: districtLabels,
                        datasets: [{
                            label: '',
                            data: districtData,
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
                        // On clicking a bar, open the respective district link
                        onClick: (event) => {
                            const elements = myBarChart.getElementsAtEventForMode(event, 'nearest', {
                                intersect: true
                            }, true);
                            if (elements.length > 0) {
                                const index = elements[0].index;
                                const url = districtLinks[index];
                                if (url) {
                                    window.open(url, '_self');
                                }
                            }
                        },
                        // Change cursor to pointer on hover over bars
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
