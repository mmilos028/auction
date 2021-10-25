@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
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

            <div class="col-md-9">
                <div class="card">

                    <div class="card-body">

                        @foreach($auctions as $auction)
                            <div class="row">
                                <div class="col-3">
                                    <a href="{{ route('auction_details', ['auction_id' => $auction->auction_id]) }}">
                                        <img border="0" width="180" src="{{ asset($auction->getThumbnailImage($auction->image)) }}" class="img-thumbnail mt-5" />
                                    </a>
                                </div>
                                <div class="col-9">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h4>
                                                <a href="{{ route('auction_details', ['auction_id' => $auction->auction_id]) }}">
                                                    {{ $auction->title  }}
                                                </a>
                                            </h4>

                                            <div class="row">
                                                <div class="col-9">
                                                    <p class="card-text">
                                                        {{Str::limit(strip_tags($auction->description), 150,'...')}}
                                                    </p>
                                                    <a href="{{ route('user_details', ['user_id' => $auction->user->id]) }}">{{ $auction->user->name }}</a>

                                                    <div class="card-text">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <span class="auction-card-price-label"> {{ __('Price') }}: </span>
                                                                <div class="auction-card-price">
                                                                    {{ number_format($auction->start_price, 2, '.', '') }}
                                                                    <span class="auction-card-currency">
                                                                        din.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @if($auction->buy_now_price != null)
                                                                <div class="col-6">
                                                                    <span class="auction-card-price-label"> {{ __('Buy Now Price') }}: </span>
                                                                    <div class="auction-card-price">
                                                                        {{ number_format($auction->buy_now_price, 2, '.', '') }}
                                                                        <span class="auction-card-currency">
                                                                        din.
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <p>
                                                    <span class="font-weight-bold">
                                                        @if($auction->getRemainingTime()['auction_remaining_time_in_days'] > 0)
                                                            {{ $auction->getRemainingTime()['auction_remaining_time_in_days'] }} days
                                                        @elseif($auction->getRemainingTime()['auction_remaining_time_in_hours'] > 0)
                                                            {{ $auction->getRemainingTime()['auction_remaining_time_in_hours'] }} hours
                                                        @elseif($auction->getRemainingTime()['auction_remaining_time_in_minutes'])
                                                            {{ $auction->getRemainingTime()['auction_remaining_time_in_minutes'] }} minutes
                                                        @endif
                                                    </span>
                                                    </p>
                                                    <hr />
                                                    <p>
                                                        <span class="font-weight-bold">
                                                            <a href="{{ route('auction_biddings', ['auction_id' => $auction->id]) }}">{{ $auction->countBiddings() }}</a>
                                                            {{ __('offers') }}
                                                        </span>
                                                    </p>
                                                    <hr />
                                                    <p>
                                                       <span class="font-weight-bold">
                                                           {{ $auction->countLastWatchers() }}
                                                           {{ __('watchers') }}
                                                       </span>
                                                    </p>
                                                    <hr />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
