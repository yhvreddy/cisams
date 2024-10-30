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
        <div>
            <form method="GET">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search..." />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn-submit">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

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

        {{ $listingData->links('vendor.pagination.custom-pagination') }}
    </div>

@endsection

@section('scripts')
@endsection
