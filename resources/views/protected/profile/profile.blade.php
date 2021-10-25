@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="card mb-2">
                                    <div class="card-header">
                                        {{ __("translate.My Profile") }}
                                    </div>
                                    <div class="card-body">

                                        <p>
                                            <a href="{{ route('profile') }}">
                                                {{ __("translate.My Information") }}
                                            </a>
                                        </p>
                                        <p>
                                            {{ __("translate.Messages") }} (0)
                                        </p>
                                        <p>
                                            {{ __("translate.Bill") }} (0 din)
                                        </p>
                                    </div>
                                </div>

                                <div class="card mb-2">
                                    <div class="card-header">
                                        {{ __("translate.Buying") }}
                                    </div>
                                    <div class="card-body">

                                        <p>
                                            {{ __("translate.Observing") }} (0)
                                        </p>
                                        <p>
                                            {{ __("translate.Offering") }} (0)
                                        </p>
                                        <p>
                                            {{ __("translate.Won auctions") }} (0)
                                        </p>
                                    </div>
                                </div>

                                <div class="card mb-2">
                                    <div class="card-header">
                                        {{ __("translate.Selling") }}
                                    </div>
                                    <div class="card-body">

                                        <p>
                                            {{ __("translate.New auction") }}
                                        </p>
                                        <p>
                                            <a href="{{ route('selling__my_auctions') }}">
                                            {{ __("translate.My auctions") }} (0)
                                            </a>
                                        </p>
                                        <p>
                                            {{ __("translate.Completed auctions") }} (0)
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-9">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h1> {{ __('Salesman') }} </h1>
                                        <p class="card-text">
                                            {{ __('User number') }}: {{ $user->id }}
                                        </p>

                                        <p class="card-text">
                                            {{ __('Member') }}: {{ $user->name }}
                                        </p>

                                        <p class="card-text">
                                            {{ __('Member from') }}: {{ $user->created_at->format('d-M-Y H:i:s') }}
                                        </p>

                                        <p class="card-text">
                                            {{ __('Last activity') }}: {{ $user->last_activity_at->format('d-M-Y H:i:s') }}
                                        </p>

                                        <p class="card-text">
                                            {{ __('Status') }}: {{ $user->user_public_status }}
                                        </p>

                                        <p class="card-text">
                                            {{ __('Favourite quote') }}: {{ $user->favourite_quote }}
                                        </p>

                                        <p class="card-text">
                                            {{ __('Member details') }}: {{ $user->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
