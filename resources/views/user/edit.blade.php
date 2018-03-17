@extends('layouts.assetmgr')


@section('content')


{!! Form::model($data, ['action' => 'UsersController@update']) !!}

<div class="card create-user-card">
    <div class="card-header">
        Edit User
</div>
<div class="card-body create-user-card-body">

    <div class="input-group input-group-sm mb-4">
        <div class="input-group-prepend ">
            <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm"><div class="user-create-edit-label">Username</div></span>
        </div>
        {{ Form::text("username", $data["user"]->userName, ['disabled', 'class' => 'form-control first-name-input']) }}
    </div>
    <div class="input-group input-group-sm mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm"><div class="user-create-edit-label">First Name</div></span>
        </div>
        {{ Form::text("first_name", $data["user"]->givenName, ['required', 'class' => 'form-control first-name-input']) }}
    </div>
    <div class="input-group input-group-sm mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm"><div class="user-create-edit-label">Last Name</div></span>
        </div>
        {{ Form::text("last_name", $data["user"]->surName, ['required', 'class' => 'form-control first-name-input']) }}
    </div>
    <div class="input-group input-group-sm mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm"><div class="user-create-edit-label">Password</div></span>
        </div>
        {{ Form::password("userpassword", ['class' => 'form-control ']) }}
    </div>
    <div class="input-group input-group-sm mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm"><div class="user-create-edit-label">Confirm<br>Password</div></span>
        </div>
        {{ Form::password("rentered_password", ['class' => 'form-control']) }}
    </div>
    <div class="input-group input-group-sm mb-4">
        <div class="input-group-prepend">
            <span class="input-group-text user-create-edit-label" id="inputGroup-sizing-sm"><div class="user-create-edit-label">Group</div></span>
        </div>
        {{ Form::select('group', $data["groups"], $data["user"]->groupId,  ['class' => 'form-select department-select']) }}
    </div>  

    <div class="form-group" style="text-align: center">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>    
</card>

{!! Form::close() !!}

@endsection
    </div>

    
