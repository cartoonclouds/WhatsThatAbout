@extends('layouts.app')
@section('title', 'User Editing')
@section('content')
    <div id="content" >

        <div class="card">
            <div class="card-header">Edit Profile</div>

            <div class="card-body">

                    <div class="row">
                        <div class="col-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
                                <a class="list-group-item list-group-item-action" id="list-security-list" data-toggle="list" href="#list-security" role="tab" aria-controls="security">Security</a>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

                                    @include('users.partials.update-profile-information-form')

                                </div>
                                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">

                                    <strong>settings</strong>

                                </div>
                                <div class="tab-pane fade" id="list-security" role="tabpanel" aria-labelledby="list-security-list">

                                    @include('users.partials.update-password-form')

                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
