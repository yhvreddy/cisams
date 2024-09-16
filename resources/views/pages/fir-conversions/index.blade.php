@extends('layouts.app')

@section('title', 'FIR Conversions')

@section('styles')
@endsection


@section('content')
    <div class="row ">
        <h4 class="fir-head">FIR Conversions</h4>
        <div class="tabs">
            <button class="tabLinks" onclick="openTab(event,'totalComplaints')">Total Complaints</button>
            <button class="tabLinks" onclick="openTab(event,'firConverted')">FIR Converted</button>
            <button class="tabLinks" onclick="openTab(event,'pendingFIRs')">Pending FIRs</button>
        </div>

        <div id="totalComplaints" class="tabContent">
            <table class="table">
                <thead class="rounded-header">
                    <tr>
                        <th>S.NO.</th>
                        <th>NCRP NO</th>
                        <th>DATE OF <br>REPORT</th>
                        <th>MO</th>
                        <th>AMOUNT<br> LOST</th>
                        <th>AMOUNT <br>POH</th>
                        <th>FIR CONVERSION </th>
                        <th>STATUS - REfUND ORDER<br> (RECEIVED/PENdING)</th>
                        <th>UPDATE (FIR)</th>
                        <th>UPDATE (REfUND)</th>
                    </tr>
                </thead>

                <tbody class="wht-box ">
                    @foreach ($allTotalPoh as $key => $poh)
                        <tr>
                            <td data-label="S.No">{{ $poh->sno }}</td>
                            <td data-label="NCRP NO">{{ $poh->ncrp_no }}</td>
                            <td data-label="DATE Of REPORT">{{ $poh->date }}</td>
                            <td data-label="MO">Identity Theft</td>
                            <td data-label="AMOUNT LOST">{{ $poh->amount_lost }}</td>
                            <td data-label="AMOUNT POH">{{ $poh->amount_poh }}</td>
                            <td data-label="FIR CONVERSION">
                                @if ($poh->status == 'Under Process')
                                    <a href="{{ route('fir-conversions.tc-yes', ['sno' => $poh->sno]) }}"
                                        class="border-button">Yes</a>
                                @elseif ($poh->status == 'FIR Registered')
                                    <btn class="borderr-button">No</btn>
                                @elseif($poh->status == 'Closed')
                                    <btn class="borderr-button">Closed</btn>
                                @endif
                            </td>
                            <td data-label="STATUS - REFUND ORDER">
                                <btn class="gree-btn">Received</btn>
                            </td>
                            <td data-label="REFUND PETITION"></td>
                            <td data-label="REFUND ORDERS"></td>
                        </tr>
                    @endforeach
                    <!-- Repeat rows as needed -->
                </tbody>
            </table>
        </div>

        <div id="firConverted" class="tabContent">
            <table class="table">
                <thead class="rounded-header">
                    <tr>
                        <th>S.NO.</th>
                        <th>NCRP NO</th>
                        <th>DATE OF REPORT</th>
                        <th>MO</th>
                        <th>AMOUNT LOST</th>
                        <th>AMOUNT POH</th>
                        <th>FIR CONVERSION </th>
                        <th>STATUS - REFUND ORDER (RECEIVED/PENDING)</th>
                        <th>UPDATE (REFUND)</th>
                    </tr>
                </thead>

                <tbody class="wht-box ">
                    @foreach ($totalConvertedPoh as $key => $poh)
                        <tr>
                            <td data-label="S.No">{{ $poh->sno }}</td>
                            <td data-label="NCRP NO">{{ $poh->ncrp_no }}</td>
                            <td data-label="DATE Of REPORT">{{ $poh->date }}</td>
                            <td data-label="MO">Identity Theft</td>
                            <td data-label="AMOUNT LOST">{{ $poh->amount_lost }}</td>
                            <td data-label="AMOUNT POH">{{ $poh->amount_poh }}</td>
                            <td data-label="FIR CONVERSION">
                                @if ($poh->status == 'Under Process')
                                    <a href="{{ route('fir-conversions.tc-yes', ['sno' => $poh->sno]) }}"
                                        class="border-button">Yes</a>
                                @elseif ($poh->status == 'FIR Registered')
                                    <btn class="borderr-button">No</btn>
                                @elseif($poh->status == 'Closed')
                                    <btn class="borderr-button">Closed</btn>
                                @endif
                            </td>
                            <td data-label="STATUS - REFUND ORDER">
                                <btn class="gree-btn">Received</btn>
                            </td>
                            <td data-label="REFUND ORDERS"></td>
                        </tr>
                    @endforeach
                    <!-- Repeat rows as needed -->
                </tbody>
            </table>
        </div>

        <div id="pendingFIRs" class="tabContent">
            <div class="container mt-5"></div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
