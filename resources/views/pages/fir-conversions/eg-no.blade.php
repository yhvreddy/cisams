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
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="IPDR">
                        <btn class="borderr-button">No</btn>
                    </td>
                    <td data-label="WHATSAPP"><a href="{{ route('fir-conversions.whatsapp-pending') }}"
                            class="pink-btn">Pending</a> </td>
                    <td data-label="SM HANDLES">
                        <btn class="borderr-button">No</btn>
                    </td>
                    <td data-label="KYC">
                        <btn class="borderr-button">No</btn>
                    </td>
                    <td data-label="BANK STATEMENTS">
                        <btn class="border-button">Yes</btn>
                    </td>

                </tr>

                <!-- Repeat rows as needed -->
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
@endsection
