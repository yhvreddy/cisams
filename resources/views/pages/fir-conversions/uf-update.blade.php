@extends('layouts.app')

@section('title', 'FIR Conversions | Total Complaints')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', ['title' => 'UPDATE FIR DETAILS'])

    <div class="row ">
        <form>
            <div class="mt-2">
                <label for="firNo" class="form-label ">FIR No</label><br>
                <input type="text" class="form-control" id="firNo" placeholder="Enter FIR No">
            </div>
            <div class="mb-2">
                <label for="sectionOfLaw" class="form-label ">Section of Law</label><br>
                <input type="text" class="form-control" id="sectionOfLaw" placeholder="Enter Section of Law">
            </div>
            <div class="mb-2">
                <label for="dateOfFIR" class="form-label ">Date of FIR</label><br>
                <input type="date" class="form-control" id="dateOfFIR" placeholder="Select Date of FIR">
            </div>
            <div class="mt-2">
                <label for="firNo" class="form-label ">District / Unit</label><br>
                <input type="text" class="form-control" id="dist" placeholder="District / Unit">
            </div>
            <div class="mt-2">
                <label for="firNo" class="form-label ">Police Station</label><br>
                <input type="text" class="form-control" id="ps" placeholder="Police Station">
            </div>
            <button type="submit" class="btn-submit">SUBMIT</button>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
