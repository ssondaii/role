@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Your User</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('role')}}">Role Management</a>
                    <br>
                    <br>
                    <a href="{{route('user')}}">User Management</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
