@extends('layouts.app')

@section('title', 'FIR Conversions | Total Complaints')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', [
        'titleOne' => 'FIR Conversions',
        'titleTwo' => 'Total Complaints',
    ])

    <div class="row mt-4">
        <table class="table">
            <thead class="rounded-header">
                <tr>
                    <th>S.NO.</th>
                    <th>CDR/CAF (YES/NO/PENDING) </th>
                    <th>IPDR (YES/NO/PENDING)</th>
                    <th>WHATSAPP (YES/NO/PENDING)</th>
                    <th>SM HANDLES (YES/NO/PENDING)</th>
                    <th>KYC (YES/NO/PENDING)</th>
                    <th>BANK STATEMENTS (YES/NO/PENDING)</th>
                </tr>
            </thead>

            <tbody class="wht-box ">
                <tr>
                    <td data-label="S.No"> 1</td>
                    <td data-label="CDR/CAF">
                        <a href="{{ route('fir-conversions.whatsapp-pending', ['type' => 'cdr', 'firNo' => $firNo, 'ncrpId' => $ncrpId]) }}"
                            class="borderr-button">No</a>
                    </td>
                    <td data-label="IPDR">
                        <a href="{{ route('fir-conversions.whatsapp-pending', ['type' => 'ipdr', 'firNo' => $firNo, 'ncrpId' => $ncrpId]) }}"
                            class="borderr-button">No</a>
                    </td>
                    <td data-label="WHATSAPP">
                        <a href="{{ route('fir-conversions.whatsapp-pending', ['type' => 'whatsapp', 'firNo' => $firNo, 'ncrpId' => $ncrpId]) }}"
                            class="borderr-button">No</a>
                    </td>
                    <td data-label="SM HANDLES">
                        <btn class="borderr-button">No</btn>
                    </td>
                    <td data-label="KYC">
                        <a href="{{ route('fir-conversions.whatsapp-pending', ['type' => 'kyc', 'firNo' => $firNo, 'ncrpId' => $ncrpId]) }}"
                            class="borderr-button">No</a>
                    </td>
                    <td data-label="BANK STATEMENTS">
                        <a href="{{ route('fir-conversions.whatsapp-pending', ['type' => 'soa', 'firNo' => $firNo, 'ncrpId' => $ncrpId]) }}"
                            class="borderr-button">No</a>
                    </td>

                </tr>

                <!-- Repeat rows as needed -->
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
@endsection
