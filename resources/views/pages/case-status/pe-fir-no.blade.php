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
                    <th>FIR NO</th>
                    <th>SEC Of LAW</th>
                    <th>DATE Of FIR</th>
                    <th>EVIDENCE GATHERED</th>
                    <th>ACCUSED ARRESTED </th>
                    <th>STATUS - UI</th>
                    <th>STATUS - CHARGED</th>
                    <th>STATUS - PT</th>
                </tr>
            </thead>

            <tbody class="wht-box ">
                <tr>
                    <td data-label="S.No"> 1 </td>
                    <td data-label="FIR NO">210/2014</td>
                    <td data-label="SEC Of LAW">60(D) IT Act</td>
                    <td data-label="DATE Of FIR">23-07-2024</td>
                    <td data-label="EVIDENCE GATHERED">
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="ACCUSED ARRESTED">
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="STATUS - UI">
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
