@extends('layouts.app')

@section('title', $district . ' List')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.1/dist/chart.umd.min.js"></script>
@endsection


@section('content')

    @include('pages.fir-conversions.components.header-title', ['title' => $district . ' List'])

    <div class="row mt-1">
        <div class="container">

            <div>
                <form method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" id="search"
                                    placeholder="Search..." />
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
                        <th>ACCUSED NO</th>
                        <th>FULNAME</th>
                        <th>PARENTAGE</th>
                        <th>AGE</th>
                        <th>GENDER</th>
                        <th>Date Of Birth</th>
                        <th>FIR Registered Number</th>
                    </tr>
                </thead>

                <tbody class="wht-box">
                    @foreach ($habitualOffenders as $key => $habitualOffender)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $habitualOffender->ACCUSED_NO }}</td>
                            <td>{{ $habitualOffender->FULNAME }}</td>
                            <td>{{ $habitualOffender->PARENTAGE ?? '-' }}</td>
                            <td>{{ $habitualOffender->AGE ?? '-' }}</td>
                            <td>{{ $habitualOffender->GENDER ?? '-' }}</td>
                            <td>{{ $habitualOffender->dateBirth ?? '-' }}</td>
                            <td>{{ $habitualOffender->fir_reg_num ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $habitualOffenders->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>

@endsection

@section('scripts')
@endsection
