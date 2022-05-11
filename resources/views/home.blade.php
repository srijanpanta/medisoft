@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <div class="container">
                        <h1>Location</h1>
                        <div class="card">
                            <div class="card-body">
                                @if($currentUserInfo)
                                    <h4>IP: {{ $currentUserInfo->ip }}</h4>
                                    <h4>Country Name: {{ $currentUserInfo->countryName }}</h4>
                                    <h4>Country Code: {{ $currentUserInfo->countryCode }}</h4>
                                    <h4>Region Code: {{ $currentUserInfo->regionCode }}</h4>
                                    <h4>Region Name: {{ $currentUserInfo->regionName }}</h4>
                                    <h4>City Name: {{ $currentUserInfo->cityName }}</h4>
                                    <h4>Zip Code: {{ $currentUserInfo->zipCode }}</h4>
                                    <h4>Latitude: {{ $currentUserInfo->latitude }}</h4>
                                    <h4>Longitude: {{ $currentUserInfo->longitude }}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
