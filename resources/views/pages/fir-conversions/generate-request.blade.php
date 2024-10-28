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

            <input type="hidden" name="firNo" value="{{ $firNo ?? null }}" />
            <input type="hidden" name="ncrpId" value="{{ $ncrpId ?? null }}" />

            @if ($type === 'soa')
                <div class="mb-2">
                    <label for="bankName" class="form-label ">Bank Name</label><br>
                    <input type="text" class="form-control" name="bankName" required id="bankName"
                        placeholder="Enter Bank Name">
                </div>
            @endif

            <div class="mb-2">
                <label for="toEmail" class="form-label ">To Email</label><br>
                <input type="email" class="form-control" name="email" required id="toEmail"
                    placeholder="Enter to email">
            </div>

            <button type="submit" class="btn-submit mt-3">SUBMIT</button>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
