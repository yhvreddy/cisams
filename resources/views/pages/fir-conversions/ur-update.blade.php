@extends('layouts.app')

@section('title', 'FIR Conversions | Total Complaints')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', ['title' => 'UPDATE REFUND DETAILS'])
    <div class="row ">
        <form class="mt-2">
            <div class="mb-2">
                <label for="dateOfFIR" class="form-label ">Date of Refund Order</label><br>
                <input type="date" class="form-control" id="dateOfFIR" placeholder="Select Date of Refund">
            </div>

            <div class="mb-2">
                <label for="sectionOfLaw" class="form-label ">Refund Amount</label><br>
                <input type="text" class="form-control" id="sectionOfLaw" placeholder="Enter Refund Amount">
            </div>
            <button type="submit" class="btn-submit">SUBMIT</button>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
