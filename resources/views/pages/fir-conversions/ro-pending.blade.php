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
                    <th>DATE OF PETITION</th>
                    <th>BANk INFO GATHERED (YES/NO/PENDING)</th>
                    <th>NOTICE TO AC HOLDER (YES/NO/PENDING)</th>
                    <th>DATE OF PETITION & DOCS SUBMISSION TO COURT</th>
                    <th>STATUS - REFUND ORDER (RECEIVED/PENDING)</th>
                </tr>
            </thead>

            <tbody class="wht-box ">
                <tr>
                    <td data-label="S.No"> 1</td>
                    <td data-label="DATE OF PETITION">30-07-2024</td>
                    <td data-label="BANk INFO GATHERED">
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="NOTICE TO AC HOLDER">
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="DATE OF PETITION & DOCS">30-07-2024 </td>
                    <td data-label="STATUS - REFUND ORDER">Pending</td>
                </tr>

                <!-- Repeat rows as needed -->
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
@endsection
