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
            <div class="container mt-5">
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
                        @foreach ($allAdditionalInfo as $key => $ai)
                            <tr>
                                <td data-label="S.No">{{ $ai->S_No }}</td>
                                <td data-label="NCRP NO">{{ $ai->Acknowledgement_No }}</td>
                                <td data-label="DATE Of REPORT">
                                    {{ date('d-m-Y', strtotime($ai->Complaint_Date)) }}</td>
                                <td data-label="MO">{{ $ai->Category }}</td>
                                <td data-label="AMOUNT LOST">{{ $ai->amount_lost }}</td>
                                <td data-label="AMOUNT POH">{{ $ai->amount_poh }}</td>
                                <td data-label="FIR CONVERSION">
                                    @if (in_array($ai->Status, ['Registered', 'FIR Registered']))
                                        <a href="{{ route('fir-conversions.tc-yes', ['sno' => $ai->S_No]) }}"
                                            class="border-button">Yes</a>
                                    @elseif($ai->Status == 'Closed')
                                        <btn class="gree-btn">Closed</btn>
                                    @else
                                        <btn class="borderr-button">No</btn>
                                    @endif
                                </td>
                                <td data-label="STATUS - REFUND ORDER">
                                    <btn class="gree-btn">--</btn>
                                </td>
                                <td data-label="REFUND PETITION"></td>
                                <td data-label="REFUND ORDERS"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $allAdditionalInfo->links() }}
            </div>
        </div>

        <div id="firConverted" class="tabContent">
            <div class="container mt-5">
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
                        @foreach ($convertedAdditionalInfo as $key => $ai)
                            <tr>
                                <td data-label="S.No">{{ $ai->S_No }}</td>
                                <td data-label="NCRP NO">{{ $ai->Acknowledgement_No }}</td>
                                <td data-label="DATE Of REPORT">
                                    {{ date('d-m-Y', strtotime($ai->Complaint_Date)) }}</td>
                                <td data-label="MO">{{ $ai->Category }}</td>
                                <td data-label="AMOUNT LOST">{{ $ai->amount_lost }}</td>
                                <td data-label="AMOUNT POH">{{ $ai->amount_poh }}</td>
                                <td data-label="FIR CONVERSION">
                                    @if (in_array($ai->Status, ['Registered', 'FIR Registered']))
                                        <a href="{{ route('fir-conversions.tc-yes', ['sno' => $ai->S_No]) }}"
                                            class="border-button">Yes</a>
                                    @elseif($ai->Status == 'Closed')
                                        <btn class="gree-btn">Closed</btn>
                                    @else
                                        <btn class="borderr-button">No</btn>
                                    @endif
                                </td>
                                <td data-label="STATUS - REFUND ORDER">
                                    <btn class="gree-btn">--</btn>
                                </td>
                                <td data-label="REFUND ORDERS"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $convertedAdditionalInfo->links() }}
            </div>
        </div>

        <div id="pendingFIRs" class="tabContent">
            <div class="container mt-5">
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
                        </tr>
                    </thead>

                    <tbody class="wht-box ">
                        @foreach ($pendingAdditionalInfo as $key => $ai)
                            <tr>
                                <td data-label="S.No">{{ $ai->S_No }}</td>
                                <td data-label="NCRP NO">{{ $ai->Acknowledgement_No }}</td>
                                <td data-label="DATE Of REPORT">
                                    {{ date('d-m-Y', strtotime($ai->Complaint_Date)) }}</td>
                                <td data-label="MO">{{ $ai->Category }}</td>
                                <td data-label="AMOUNT LOST">{{ $ai->amount_lost }}</td>
                                <td data-label="AMOUNT POH">{{ $ai->amount_poh }}</td>
                                <td data-label="FIR CONVERSION">
                                    @if (in_array($ai->Status, ['Registered', 'FIR Registered']))
                                        <a href="{{ route('fir-conversions.tc-yes', ['sno' => $ai->S_No]) }}"
                                            class="border-button">Yes</a>
                                    @elseif($ai->Status == 'Closed')
                                        <btn class="gree-btn">Closed</btn>
                                    @else
                                        <btn class="borderr-button">No</btn>
                                    @endif
                                </td>
                                <td data-label="STATUS - REFUND ORDER">
                                    <btn class="gree-btn">--</btn>
                                </td>
                                <td data-label="REFUND PETITION"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $pendingAdditionalInfo->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
