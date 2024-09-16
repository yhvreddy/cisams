@extends('layouts.app')

@section('title', 'Search')

@section('styles')
@endsection


@section('content')
    @include('pages.fir-conversions.components.header-title', [
        'titleOne' => 'Search',
    ])


    <div class="row mt-2">
        <div class="sear-whtbox">
            <!-- Radio Buttons -->
            <div class="radio-group">
                <label>
                    <input type="radio" name="option" value="Either of Following Combinations" checked> Either of Following
                    Combinations&nbsp;&nbsp;&nbsp;&nbsp; <B>or</B>&nbsp;&nbsp;&nbsp;&nbsp;
                </label>
                <label>
                    <input type="radio" name="option" value="All Combinations"> All Combinations
                </label>
            </div>

            <!-- Form Fields -->
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="account-no">Account No</label>
                    <input type="text" id="account-no" name="account-no" placeholder="Enter your account number">
                </div>
                <div class="form-group">
                    <label for="mobile-no">Mobile No</label>
                    <input type="tel" id="mobile-no" name="mobile-no" placeholder="Enter your mobile number">
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="url" id="url" name="url" placeholder="Enter your url">
                </div>
                <div class="form-group">
                    <label for="sm-id">SM ID</label>
                    <input type="text" id="sm-id" name="sm-id" placeholder="Enter your sm id">
                </div>
            </div>

            <!-- Search Field -->
            <div class="search-group ">
                <input type="search" id="search" name="search" placeholder="Search">
                <button type="submit" class="btn-submit">Search</button>
            </div>
        </div>


    </div>


    <div class="row mt-5">
        <div class="col-md-10">
            <h4 class="search-subtil">Search --- &nbsp; Account no : 8675089920</h4>
        </div>

        <div class="row mt-1">
            <table class="table">
                <thead class="rounded-header">
                    <tr>
                        <th>S.NO.</th>
                        <th>NCRP NO</th>
                        <th>MO</th>
                        <th>PS</th>
                        <th>DISTRICT</th>
                        <th>STATE</th>
                        <th>ACCOUNT NO</th>
                        <th>PHONE NO</th>
                        <th>SM ID</th>
                    </tr>
                </thead>

                <tbody class="wht-box ">
                    <tr>
                        <td data-label="S.No"> 1</td>
                        <td data-label="NCRP NO">2367</td>
                        <td data-label="MO">Identity</td>
                        <td data-label="PS">Asif Nagar</td>
                        <td data-label="DISTRICT">Hyderabad</td>
                        <td data-label="STATE">Telangana</td>
                        <td data-label="ACCOUNT NO">8675089920</td>
                        <td data-label="PHONE NO">8800054768</td>
                        <td data-label="SM ID">67854</td>

                    </tr>

                    <tr>
                        <td data-label="S.No">2</td>
                        <td data-label="NCRP NO">4387</td>
                        <td data-label="MO">Identity</td>
                        <td data-label="PS">Humayun Nagar</td>
                        <td data-label="DISTRICT">Hyderabad</td>
                        <td data-label="STATE">Telangana</td>
                        <td data-label="ACCOUNT NO">567843092</td>
                        <td data-label="PHONE NO">9855687320</td>
                        <td data-label="SM ID">34621</td>

                    </tr>

                    <!-- Repeat rows as needed -->
                </tbody>
            </table>
        </div>

    </div>

@endsection

@section('scripts')
@endsection
