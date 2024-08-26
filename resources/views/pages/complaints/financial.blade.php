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
                        labels: ['Set1', 'Set2', 'Set3', 'Set4', 'Set5'],
                        datasets: [{
                                label: 'Set1',
                                data: [140, 60, 67, 89, 57],
                                backgroundColor: '#092081',
                                borderRadius: 10 // Adjust the radius as needed
                            },
                            {
                                label: 'Set2',
                                data: [20, 70, 23, 45, 30],
                                backgroundColor: '#375CE1',
                                borderRadius: 10
                            },
                            {
                                label: 'Set3',
                                data: [100, 20, 29, 60, 80],
                                backgroundColor: '#C6D2FF',
                                borderRadius: 10
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                min: 0,
                                max: 160,
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
                        <th>Cyber Stalking</th>
                        <th>Cyber Bullying </th>
                        <th>Defamation</th>
                        <th>Child Abuse </th>
                        <th>Others</th>

                    </tr>
                </thead>
                <tbody class="wht-box ">
                    <tr>
                        <td data-label="S.No"><img src="{{ asset('assets/images/blue1.png') }}" class="blu"> Complaints
                        </td>
                        <td data-label="NCRP NO">150</td>
                        <td data-label="DATE Of REPORT">45</td>
                        <td data-label="POLICE STATION">80</td>
                        <td data-label="MO">25</td>
                        <td data-label="AMOUNT LOST">10</td>

                    </tr>
                    <tr>
                        <td data-label="S.No"><img src="{{ asset('assets/images/blue2.png') }}" class="blu1"> Fir
                            Conversion</td>
                        <td data-label="NCRP NO">35</td>
                        <td data-label="DATE Of REPORT">55</td>
                        <td data-label="POLICE STATION">15</td>
                        <td data-label="MO">25</td>
                        <td data-label="AMOUNT LOST">5</td>

                    </tr>

                    <tr>
                        <td data-label="S.No"><img src="{{ asset('assets/images/blue3.png') }}" class="blu">Fir Pending
                        </td>
                        <td data-label="NCRP NO">65</td>
                        <td data-label="DATE Of REPORT">35</td>
                        <td data-label="POLICE STATION">6</td>
                        <td data-label="MO">34</td>
                        <td data-label="AMOUNT LOST">7</td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
