@extends('layouts.app')

@section('title', 'User Management')

@section('styles')
@endsection


@section('content')

    @include('pages.fir-conversions.components.header-title', [
        'titleOne' => 'User Management',
        'titleTwo' => 'Create User',
        'menus' => [['name' => 'User List', 'route' => route('user-management.index')]],
    ])

    <div class="row mt-4">
        <form method="POST" action="{{ route('user-management.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mt-2 form-group">
                <label for="Name" class="form-label ">Name *</label><br>
                <input type="text" class="form-control text" value="{{ old('name') }}" required name="name"
                    id="Name" placeholder="Enter Name">
                @if ($errors->has('name'))
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                @endif
            </div>

            <div class="mb-2 form-group">
                <label for="Email" class="form-label ">Email Id *</label><br>
                <input type="email" class="form-control email" value="{{ old('email') }}" required name="email"
                    id="Email" placeholder="Enter Email Id">
                @if ($errors->has('email'))
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                @endif
            </div>

            <div class="mb-2 form-group">
                <label for="UserName" class="form-label ">User Name *</label><br>
                <input type="text" class="form-control text-id" required name="username" id="UserName"
                    placeholder="Enter UserName">
                @if ($errors->has('username'))
                    <small class="text-danger">{{ $errors->first('username') }}</small>
                @endif
            </div>

            <div class="mb-2 form-group">
                <label for="Mobile" class="form-label">Mobile</label><br>
                <input type="text" class="form-control number" value="{{ old('mobile') }}" name="mobile" id="Mobile"
                    placeholder="Enter Mobile Number">
                @if ($errors->has('mobile'))
                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                @endif
            </div>

            <div class="mb-2 form-group">
                <label for="Password" class="form-label">Password *</label><br>
                <input type="password" class="form-control password" required name="password" id="Password"
                    placeholder="Enter Password">
                @if ($errors->has('password'))
                    <small class="text-danger">{{ $errors->first('password') }}</small>
                @endif
            </div>

            <div class="mb-2 form-group">
                <label for="RoleId" class="form-label">Role *</label><br>
                <select class="form-control" id="RoleId" name="role_id" required>
                    <option>Select User Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ ucwords(str_replace('-', ' ', $role->name)) }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role_id'))
                    <small class="text-danger">{{ $errors->first('role_id') }}</small>
                @endif
            </div>

            <div class="mb-2 form-group">
                <label for="Status" class="form-label">Status *</label><br>
                <select class="form-control" name="status" id="Status" required>
                    @foreach ($status as $sts)
                        <option value="{{ $sts }}">{{ $sts }}</option>
                    @endforeach
                </select>
                @if ($errors->has('status'))
                    <small class="text-danger">{{ $errors->first('status') }}</small>
                @endif
            </div>

            <button type="submit" class="btn-submit">SUBMIT</button>
        </form>
    </div>

@endsection

@section('scripts')
@endsection
