@extends('layouts.app')

@section('title', 'FIR Conversions | Total Complaints')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', ['title' => $type . ' Generate Request'])
    <div class="row ">
        <form class="mt-2" method="POST"
            action="{{ route('fir-conversions.generate-request', ['type' => $type, 'requestId' => request()->requestId ?? 123]) }}">
            @csrf

            <div class="mb-2">
                <label for="toEmail" class="form-label ">To Email</label><br>
                <input type="email" class="form-control" name="email" id="toEmail" placeholder="Enter to email">
            </div>

            <button type="submit" class="btn-submit">SUBMIT</button>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
