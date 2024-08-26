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
                <tr>
                    <td data-label="S.No"> 1 </td>
                    <td data-label="NCRP NO">352534567092</td>
                    <td data-label="FIR NO"><a href="{{ route('case-status.pe-fir-no') }}"
                            style="text-decoration: none;">212/2004</a>
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

                <!-- Repeat rows as needed -->
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
@endsection
