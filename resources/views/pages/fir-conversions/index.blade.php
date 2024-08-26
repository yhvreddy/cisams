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
                    <tr>
                        <td data-label="S.No"> 1</td>
                        <td data-label="NCRP NO">352534567092</td>
                        <td data-label="DATE Of REPORT">21-07-2024</td>
                        <td data-label="MO">Identity Theft</td>
                        <td data-label="AMOUNT LOST">50000</td>
                        <td data-label="AMOUNT POH">50000</td>
                        <td data-label="FIR CONVERSION"><a href="{{ route('fir-conversions.tc-yes') }}"
                                class="border-button">Yes</a>
                        </td>
                        <td data-label="STATUS - REFUND ORDER">
                            <btn class="gree-btn">Received</btn>
                        </td>
                        <td data-label="REFUND PETITION"></td>
                        <td data-label="REFUND ORDERS"></td>
                    </tr>
                    <tr>
                        <td data-label="S.No"> 2</td>
                        <td data-label="NCRP NO">332534556432</td>
                        <td data-label="DATE Of REPORT">25-07-2024</td>
                        <td data-label="MO">Courier Scam</td>
                        <td data-label="AMOUNT LOST">50000</td>
                        <td data-label="AMOUNT POH">50000</td>
                        <td data-label="FIR CONVERSION">
                            <btn class="borderr-button">No</btn>
                        </td>
                        <td data-label="STATUS - REFUND ORDER"><a href="{{ route('fir-conversions.ro-pending') }}"
                                class="pink-btn">Pending</a>
                        </td>
                        <td data-label="REFUND PETITION">
                            <a href="{{ route('fir-conversions.uf-update') }}" class="update-btn ">Update</a>
                        </td>
                        <td data-label="REFUND ORDERS">
                            <a href="{{ route('fir-conversions.ur-update') }}" class="update-btn ">Update</a>
                        </td>
                    </tr>

                    <tr>
                        <td data-label="S.No"> 3</td>
                        <td data-label="NCRP NO">352534567092</td>
                        <td data-label="DATE Of REPORT">21-07-2024</td>
                        <td data-label="MO">Identity Theft</td>
                        <td data-label="AMOUNT LOST">50000</td>
                        <td data-label="AMOUNT POH">50000</td>
                        <td data-label="FIR CONVERSION"><a href="{{ route('fir-conversions.tc-yes') }}"
                                class="border-button">Yes</a>
                        </td>
                        <td data-label="STATUS - REFUND ORDER">
                            <btn class="gree-btn">Received</btn>
                        </td>
                        <td data-label="REFUND PETITION"></td>
                        <td data-label="REFUND ORDERS"></td>
                    </tr>
                    <tr>
                        <td data-label="S.No"> 2</td>
                        <td data-label="NCRP NO">332534556432</td>
                        <td data-label="DATE Of REPORT">25-07-2024</td>
                        <td data-label="MO">Courier Scam</td>
                        <td data-label="AMOUNT LOST">50000</td>
                        <td data-label="AMOUNT POH">50000</td>
                        <td data-label="FIR CONVERSION"><a href="{{ route('fir-conversions.tc-yes') }}"
                                class="border-button">Yes</a>
                        </td>
                        <td data-label="STATUS - REFUND ORDER"><a href="{{ route('fir-conversions.ro-pending') }}"
                                class="pink-btn">Pending</a>
                        </td>
                        <td data-label="REFUND PETITION"><a href="{{ route('fir-conversions.uf-update') }}"
                                class="update-btn ">Update</a>
                        </td>
                        <td data-label="REFUND ORDERS"><a href="{{ route('fir-conversions.ur-update') }}"
                                class="update-btn ">Update</a>
                        </td>
                    </tr>

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
                    <tr>
                        <td data-label="S.No"> 1</td>
                        <td data-label="NCRP NO">352534567092</td>
                        <td data-label="DATE Of REPORT">21-07-2024</td>
                        <td data-label="MO">Identity Theft</td>
                        <td data-label="AMOUNT LOST">50000</td>
                        <td data-label="AMOUNT POH">50000</td>
                        <td data-label="FIR CONVERSION"><a href="{{ route('fir-conversions.fc-yes') }}"
                                class="border-button">Yes</a></td>
                        <td data-label="STATUS - REFUND ORDER">
                            <btn class="gree-btn">Received</btn>
                        </td>
                        <td data-label="REFUND ORDERS"></td>
                    </tr>
                    <tr>
                        <td data-label="S.No"> 2</td>
                        <td data-label="NCRP NO">332534556432</td>
                        <td data-label="DATE Of REPORT">25-07-2024</td>
                        <td data-label="MO">Courier Scam</td>
                        <td data-label="AMOUNT LOST">50000</td>
                        <td data-label="AMOUNT POH">50000</td>
                        <td data-label="FIR CONVERSION"><a href="{{ route('fir-conversions.fc-yes') }}"
                                class="border-button">Yes</a></td>
                        <td data-label="STATUS - REFUND ORDER">
                            <a href="{{ route('fir-conversions.sro-pending') }}" class="pink-btn">Pending</a>
                        </td>
                        <td data-label="REFUND ORDERS"></td>
                    </tr>

                    <tr>
                        <td data-label="S.No"> 3</td>
                        <td data-label="NCRP NO">352534567092</td>
                        <td data-label="DATE Of REPORT">21-07-2024</td>
                        <td data-label="MO">Identity Theft</td>
                        <td data-label="AMOUNT LOST">50000</td>
                        <td data-label="AMOUNT POH">50000</td>
                        <td data-label="FIR CONVERSION">
                            <btn class="border-button">Yes</btn>
                        </td>
                        <td data-label="STATUS - REFUND ORDER">
                            <btn class="gree-btn">Received</btn>
                        </td>
                        <td data-label="REFUND ORDERS"></td>
                    </tr>
                    <tr>
                        <td data-label="S.No"> 4</td>
                        <td data-label="NCRP NO">332534556432</td>
                        <td data-label="DATE Of REPORT">23-07-2024</td>
                        <td data-label="MO">Courier Scam</td>
                        <td data-label="AMOUNT LOST">7500000</td>
                        <td data-label="AMOUNT POH">50000</td>
                        <td data-label="FIR CONVERSION"><a href="{{ route('fir-conversions.fc-yes') }}"
                                class="border-button">Yes</a></td>
                        <td data-label="STATUS - REFUND ORDER">
                            <btn class="pink-btn">Pending</btn>
                        </td>
                        <td data-label="REFUND ORDERS">
                            <btn class="update-btn ">Update</btn>
                        </td>
                    </tr>


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
