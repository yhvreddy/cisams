@extends('layouts.app')

@section('title', 'FIR Conversions')

@section('styles')
@endsection


@section('content')
    <div class="row ">
        <h4 class="fir-head">{{ $listName }} - FIR Conversions</h4>

        <div class="container">

            <div>
                <form method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" id="search"
                                    placeholder="Search..." />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn-submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


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
                    @foreach ($firConversionListing as $key => $ai)
                        <tr>
                            <td data-label="S.No">{{ $ai->sno }}</td>
                            <td data-label="NCRP NO">{{ $ai->NCRP_No }}</td>
                            <td data-label="DATE Of REPORT">
                                {{ !empty($ai->Complaint_Date) ? date('d-m-Y', strtotime($ai->Complaint_Date)) : '-' }}</td>
                            <td data-label="MO">{{ $ai->Mo ?? '-' }}</td>
                            <td data-label="AMOUNT LOST">{{ $ai->amount_lost }}</td>
                            <td data-label="AMOUNT POH">{{ $ai->amount_poh }}</td>
                            <td data-label="FIR CONVERSION">
                                @if (in_array($ai->POH_Status, ['Registered', 'FIR Registered']))
                                    <a href="{{ route('fir-conversions.tc-yes', ['district' => $district, 'listType' => $listType, 'ncrpId' => $ai->NCRP_No, 'FIR_NO' => $ai->FIR_NO]) }}"
                                        class="border-button">Yes</a>
                                @elseif($ai->POH_Status == 'Closed')
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

            {{ $firConversionListing->links('vendor.pagination.custom-pagination') }}
        </div>

    </div>
@endsection

@section('scripts')
@endsection
