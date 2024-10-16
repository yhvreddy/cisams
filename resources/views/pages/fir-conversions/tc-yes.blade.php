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
                <tr>
                    <td data-label="S.No"> 1</td>
                    <td data-label="FIR NO">210/2022</td>
                    <td data-label="SEC OF LAW">60(D) IT Act</td>
                    <td data-label="DATE OF FIR">23-07-2024</td>
                    <td data-label="EVIDENCE GATHERED"><a href="{{ route('fir-conversions.ev-no') }}"
                            class="borderr-button">No</a> </td>
                    <td data-label="ACCUSED ARRESTED">
                        <btn class="borderr-button">No</btn>
                    </td>
                    <td data-label="STATUS-UI">
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="STATUS - CHARGED">
                        <btn class="borderr-button">No</btn>
                    </td>
                    <td data-label="STATUS - PT">
                        <btn class="borderr-button">No</btn>
                    </td>
                </tr>

                <!-- Repeat rows as needed -->
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
@endsection
