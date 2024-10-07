@extends('layouts.app')

@section('title', 'Non Financial')

@section('styles')
@endsection


@section('content')
    <div class="row ">
        <div class="d-flex justify-content-end">
            <a href="{{ route('home') }}" class="btn-back " onclick="history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 1-.5.5H3.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z" />
                </svg> Back
            </a>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-8 dbox1 p-4">
            <span class="finan">Financial Complaints</span>

            <canvas id="myChart" height="240"style="margin-top: 15px;"></canvas>

            <script>
                const ctx = document.getElementById('myChart').getContext('2d');

                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($labels) !!}, // Dynamic category labels (X-axis)
                        datasets: {!! json_encode($datasets) !!} // Dynamic datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                min: 0,
                                max: parseInt("{{ $maxValue }}") + 10,
                            }
                        },
                        plugins: {
                            legend: {
                                display: false // Position the legend at the bottom
                            }
                        },
                    }
                });
            </script>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        @foreach ($labels as $label)
                            <th>{{ $label }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="wht-box ">
                    <tr>
                        <td><img src="{{ url('assets/images/blue1.png') }}" class="blu"> Complaints</td>
                        @foreach ($datasets[0]['data'] as $count)
                            <td data-label="">{{ $count }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/blue2.png') }}" class="blu1"> FIR Conversion</td>
                        @foreach ($datasets[1]['data'] as $count)
                            <td data-label="">{{ $count }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><img src="{{ url('assets/images/blue3.png') }}" class="blu"> FIR Pending</td>
                        @foreach ($datasets[2]['data'] as $count)
                            <td data-label="">{{ $count }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
