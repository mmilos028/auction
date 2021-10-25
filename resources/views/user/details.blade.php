@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __("Subjects and Questions") }}
                                    </div>
                                    <div class="card-body">

                                        <p>
                                            <a href="{{ route('list_auctions_from_user', ['user_id' => $user->id]) }}">
                                                {{ __("All Auctions from Member") }}
                                            </a>
                                        </p>
                                        <p>
                                            Ask Member
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h1> {{ __('translate.Salesman') }} </h1>
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
