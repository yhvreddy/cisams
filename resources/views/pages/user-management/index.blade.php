@extends('layouts.app')

@section('title', 'User Management')

@section('styles')
@endsection


@section('content')

    @include('pages.fir-conversions.components.header-title', [
        'titleOne' => 'User Management',
        'titleTwo' => 'Users List',
        'menus' => [['name' => 'Add User', 'route' => route('user-management.create')]],
    ])

    <div class="row mt-4">
        <table class="table">
            <thead class="rounded-header">
                <tr>
                    <th>S.NO.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>UserName</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody class="wht-box">
                @foreach ($users as $key => $user)
                    <tr>
                        <td data-label="S.No"> {{ $key + 1 }}</td>
                        <td data-label="Name">{{ $user->name }}</td>
                        <td data-label="Email">{{ $user->email }}</td>
                        <td data-label="UserName">{{ $user->username }}</td>
                        <td data-label="Role">
                            @foreach ($user->roles as $role)
                                <span class="label gree-btn">{{ ucwords(str_replace('-', ' ', $role->name)) }}</span>
                            @endforeach
                        </td>
                        <td data-label="Status">{{ $user->status }}</td>
                        <td data-label="Actions">
                            <a href="{{ route('user-management.edit', ['user' => $user->id]) }}" class="update-btn">Edit</a>
                            {{-- <a href="{{ route('user-management.delete', ['user' => $user->id]) }}"
                                class="pink-btn">Delete</a> --}}
                        </td>
                    </tr>
                    <!-- Repeat rows as needed -->
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
@endsection
