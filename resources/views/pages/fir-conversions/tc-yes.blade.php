@extends('layouts.app')

@section('title', 'FIR Conversions | Total Complaints')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title')


    <div class="row mt-4">
        <table class="table">
            <thead class="rounded-header">
                <tr>
                    <th>S.NO.</th>
                    <th>FIR NO</th>
                    <th>SEC OF LAW</th>
                    <th>DATE OF FIR</th>
                    <th>EVIDENCE GATHERED</th>
                    <th>ACCUSED ARRESTED</th>
                    <th>STATUS-UI</th>
                    <th>STATUS - CHARGED</th>
                    <th>STATUS - PT</th>
                </tr>
            </thead>

            <tbody class="wht-box ">
                @foreach ($cyberCrimeInfo as $key => $cyberCrime)
                    <tr>
                        <td data-label="S.No"> {{ $key + 1 }}</td>
                        <td data-label="FIR NO">{{ $cyberCrime->FIR_ID }}</td>
                        <td data-label="SEC OF LAW">{{ $cyberCrime->SEC_OF_LAW }}</td>
                        <td data-label="DATE OF FIR">
                            {{ !empty($cyberCrime->CRIME_CRTD_DATE) ? date('d-m-Y', strtotime($cyberCrime->CRIME_CRTD_DATE)) : '-' }}
                        </td>
                        <td data-label="EVIDENCE GATHERED">
                            @if (!in_array($cyberCrime->FIR_STATUS, [null, 'New', '']))
                                <a href="{{ route('fir-conversions.ev-no') }}" class="border-button">Yes</a>
                            @else
                                <btn class="borderr-button">No</btn>
                            @endif

                        </td>
                        <td data-label="ACCUSED ARRESTED">
                            @if (!in_array($cyberCrime->ARREST_STATUS, [null, 'N', '', 'n']))
                                <a href="{{ route('fir-conversions.ev-no') }}" class="border-button">Yes</a>
                            @else
                                <btn class="borderr-button">No</btn>
                            @endif
                        </td>
                        <td data-label="STATUS-UI">
                            @if (!in_array($cyberCrime->FIR_STATUS, ['UI Cases']))
                                <a href="{{ route('fir-conversions.ev-no') }}" class="border-button">Yes</a>
                            @else
                                <btn class="borderr-button">No</btn>
                            @endif
                        </td>
                        <td data-label="STATUS - CHARGED">
                            @if (!in_array($cyberCrime->FIR_STATUS, ['Chargesheet Created', 'CHARGED']))
                                <a href="{{ route('fir-conversions.ev-no') }}" class="border-button">Yes</a>
                            @else
                                <btn class="borderr-button">No</btn>
                            @endif
                        </td>
                        <td data-label="STATUS - PT">
                            @if (!in_array($cyberCrime->FIR_STATUS, ['PT Cases']))
                                <a href="{{ route('fir-conversions.ev-no') }}" class="border-button">Yes</a>
                            @else
                                <btn class="borderr-button">No</btn>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
@endsection
