@extends('layouts.app')

@section('title', 'Case Status')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', [
        'titleOne' => 'CASE STATUS',
        'titleTwo' => 'PENDING EVIDENCE',
    ])


    <div class="row mt-4">
        <table class="table">
            <thead class="rounded-header">
                <tr>
                    <th>S.NO.</th>
                    <th>NCRP NO</th>
                    <th>FIR NO</th>
                    <th>KYC</th>
                    <th>BANk STATEMENTS</th>
                    <th>CDR </th>
                    <th>IPDR</th>
                    <th>WHATSAPP</th>
                    <th>SM HANDLES</th>
                    <th>CAF</th>
                </tr>
            </thead>

            <tbody class="wht-box ">
                @foreach ($cyberCrimeRecords as $key => $cyberCrimeRecord)
                    <tr>
                        <td data-label="S.No"> {{ $key + 1 }} </td>
                        <td data-label="NCRP NO">{{ $cyberCrimeRecord->ACCUSED_NO }}</td>
                        <td data-label="FIR NO">
                            <a href="{{ route('case-status.pe-fir-no') }}" style="text-decoration: none;">
                                {{ $cyberCrimeRecord->FIR_NO . '/' . $cyberCrimeRecord->YEAR }}
                            </a>
                        </td>
                        <td data-label="KYC"><a href="{{ route('case-status.pe-fir-kyc') }}"
                                style="text-decoration: none;">Yes</a></td>
                        <td data-label="BANk STATEMENTS">No</td>
                        <td data-label="CDR"><a href="{{ route('case-status.pe-fir-cdr') }}"
                                style="text-decoration: none;">Yes</a></td>
                        <td data-label="IPDR">No</td>
                        <td data-label="WHATSAPP">No</td>
                        <td data-label="SM HANDLES">No</td>
                        <td data-label="CAF">No</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $cyberCrimeRecords->links('vendor.pagination.custom-pagination') }}
    </div>
@endsection

@section('scripts')
@endsection
