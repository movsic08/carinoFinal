@extends('admin.admin-layout')

@section('admin')

<div class="col-6">
    <form id="myForm" method="POST" action="{{ route('create-user-account') }}" class="forms-sample">
        @csrf
        <div class="form-group mb-3">
            <label for="exampleInputEmail1" class="form-label">Staff Name</label>
            <input type="text" name="name" class="form-control" value="{{ $client->first_name . ' ' . $client->last_name ?? '' }}">

        </div>
        <div class="form-group mb-3">
            <label for="exampleInputEmail1" class="form-label">Staff Email</label>
            <input type="email" name="email" class="form-control" value="{{ $client->email_address ?? '' }}">
        </div>
        <div class="form-group mb-3">
            <label for="exampleInputEmail1" class="form-label">Staff Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $client->contact_number ?? '' }}">
        </div>
        <div class="form-group mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ $client->client_idnumber ?? '' }}">
        </div>
        <div class="form-group mb-3">
            <label for="exampleInputEmail1" class="form-label">Staff Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <hr>
        <button type="submit" class="btn btn-secondary btn-sm float-end">
            <i class='bx bx-save'></i> Save
        </button>
    </form>
</div>

@endsection
