@extends('layouts.app')

@section('title', 'FIR Conversions | Total Complaints')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title')


    <div class="row mt-4">
        {{-- <div>
            <form method="GET">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search..." />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn-submit">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}

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
                        <td data-label="FIR NO">{{ $cyberCrime->FIR_NO . '/' . $cyberCrime->YEAR }}</td>
                        <td data-label="SEC OF LAW">{{ $cyberCrime->SEC_OF_LAW }}</td>
                        <td data-label="DATE OF FIR">
                            {{ !empty($cyberCrime->CRIME_CRTD_DATE) ? date('d-m-Y', strtotime($cyberCrime->CRIME_CRTD_DATE)) : '-' }}
                        </td>
                        <td data-label="EVIDENCE GATHERED">
                            @if (in_array($cyberCrime->FIR_STATUS, [null, 'New', '']))
                                <a href="{{ route('fir-conversions.ev-no', ['firNo' => $firNo, 'ncrpId' => $ncrpId]) }}"
                                    class="borderr-button">No</a>
                            @else
                                <btn class="border-button">Yes</btn>
                            @endif

                        </td>
                        <td data-label="ACCUSED ARRESTED">
                            @if (!in_array($cyberCrime->ARREST_STATUS, [null, 'N', '', 'n']))
                                <btn class="border-button">Yes</btn>
                            @else
                                <btn class="borderr-button">No</btn>
                            @endif
                        </td>
                        <td data-label="STATUS-UI">
                            @if (!in_array($cyberCrime->FIR_STATUS, ['UI Cases']))
                                <btn class="border-button">Yes</btn>
                            @else
                                <btn class="borderr-button">No</btn>
                            @endif
                        </td>
                        <td data-label="STATUS - CHARGED">
                            @if (!in_array($cyberCrime->FIR_STATUS, ['Chargesheet Created', 'CHARGED']))
                                <btn class="border-button">Yes</btn>
                            @else
                                <btn class="borderr-button">No</btn>
                            @endif
                        </td>
                        <td data-label="STATUS - PT">
                            @if (!in_array($cyberCrime->FIR_STATUS, ['PT Cases']))
                                <btn class="border-button">Yes</btn>
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
