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
                    <th>MOBILE NO</th>
                    <th>REQUEST SENT (YES/NO)</th>
                    <th>DATE OF REQUEST</th>
                    <th>GENERATE REQUEST/REMINDER</th>

                </tr>
            </thead>

            <tbody class="wht-box">
                <tr>
                    <td data-label="S.No"> 1 </td>
                    <td data-label="MOBILE NO">9849098490 </td>
                    <td data-label="REQUEST SENT">
                        <btn class="border-button">Yes</btn>
                    </td>
                    <td data-label="DATE OF REQUEST">23-07-2024</td>
                    <td data-label="GENERATE REQUEST">GENERATE REMINDER</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
@endsection
