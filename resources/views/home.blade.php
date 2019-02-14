@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User details</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome <b>{{ Auth::user()->name }}</b>. Following is your user information:<br><br>

                    <div class="row justify-content-left">
                            <div class="col-sm-2">Role:</div>
                            <div class="col-sm-10">
                            @auth

                                @if (Auth::user()->profession)
                                    AGENT
                                @else
                                    NORMAL USER
                                @endif

                            @endauth
                        </div>
                        </div>
                        <div class="row justify-content-left">
                            <div class="col-sm-2">Name:</div>
                            <div class="col-sm-10">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="row justify-content-left">
                            <div class="col-sm-2">Last name:</div>
                            <div class="col-sm-10">{{ Auth::user()->lastname }}</div>
                        </div>
                        <div class="row justify-content-left">
                            <div class="col-sm-2">Age:</div>
                            <div class="col-sm-10">{{ Auth::user()->age }}</div>
                        </div>
                        <div class="row justify-content-left">
                            <div class="col-sm-2">Age:</div>
                            <div class="col-sm-10">{{ Auth::user()->gender }}</div>
                        </div>
                        <div class="row justify-content-left">
                            <div class="col-sm-2">Zip code:</div>
                            <div class="col-sm-10">{{ Auth::user()->zipcode }}</div>
                        </div>      
                        <div class="row justify-content-left">
                            <div class="col-sm-2">Profession:</div>
                            <div class="col-sm-10">{{ Auth::user()->profession }}</div>
                        </div>          
                        <div class="row justify-content-left">
                            <div class="col-sm-2">Email:</div>
                            <div class="col-sm-10">{{ Auth::user()->email }}</div>
                        </div>                                                                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
