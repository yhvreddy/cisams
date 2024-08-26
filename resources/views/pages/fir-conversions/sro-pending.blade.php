@extends('layouts.app')

@section('title', 'FIR Conversions | Total Complaints')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', [
        'titleOne' => 'FIR Conversions',
        'titleTwo' => 'FIR Converted',
    ])

    <div class="row mt-4">
        <table class="table">
            <thead class="rounded-header">
                <tr>
                    <th>S.NO.</th>
                    <th>DATE Of PETITION</th>
                    <th>BANK INfO GATHERED (YES/NO/PENDING)</th>
                    <th>NOTICE TO AC HOLDER (YES/NO/PENDING) </th>
                    <th>DATE Of PETITION & DOCS SUBMISSION TO COURT</th>
                    <th>STATUS - REFUND ORDER (RECEIVED/PENDING)</th>

                </tr>
            </thead>

            <tbody class="wht-box ">
                <tr>
                    <td data-label="S.No"> 1</td>
                    <td data-label="DATE Of PETITION">22-07-2024</td>
                    <td data-label="BANK INfO GATHERED">
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="NOTICE TO AC HOLDER">
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="DATE Of PETITION & DOCS">30-07-2024</td>
                    <td data-label="STATUS - REFUND ORDER">
                        <btn class="gree-btn">Received</btn>
                    </td>
                </tr>

                <!-- Repeat rows as needed -->
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
@endsection
