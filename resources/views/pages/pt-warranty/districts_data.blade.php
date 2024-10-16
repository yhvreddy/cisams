@extends('layouts.app')

@section('title', 'FIR Conversions | Total Complaints')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', [
        'title' => ($district ?? '') . ' - ' . $typeName . ' List',
        'routeLink' => url()->previous(),
    ])

    <div class="row mt-4">
        <table class="table">
            <thead class="rounded-header">
                <tr>
                    <th>S.NO.</th>
                    <th>Accused Name</th>
                    <th>Phone</th>
                    <th>IMEI</th>
                    <th>FIR Number</th>
                    <th>PT Executed</th>
                    <th>Arrested Crime</th>
                    <th></th>
                </tr>
            </thead>

            <tbody class="wht-box">
                @foreach ($listingData as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->ACCUSED_NAME }}</td>
                        <td>--</td>
                        <td>--</td>
                        <td>{{ $data->FIR_NO }}</td>
                        <td>{{ $data->PT_EXECUTED }}</td>
                        <td>{{ $data->ARRESTED_CRIME }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $listingData->links() }}
    </div>

@endsection

@section('scripts')
@endsection
