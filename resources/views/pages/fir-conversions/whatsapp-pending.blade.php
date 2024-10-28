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
                    <th>HANDLE</th>
                    <th>DATE Of REQUEST</th>
                    <th>GENERATE REMINDER</th>
                </tr>
            </thead>

            <tbody class="wht-box ">
                <tr>
                    <td data-label="S.No"> 1</td>
                    <td data-label="HANDLE">2344</td>
                    <td data-label="DATE Of REQUEST">23-07-2024</td>
                    <td data-label="GENERATE REMINDER">
                        <a href="{{ route('fir-conversions.generate-request', ['type' => $type, 'requestId' => $ncrpId, 'firNo' => $firNo]) }}"
                            class="genera-button">GENERATE REQUEST</a>
                    </td>
                </tr>

                <!-- Repeat rows as needed -->
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
@endsection
