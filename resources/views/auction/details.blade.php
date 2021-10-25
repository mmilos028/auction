@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="row">
                                    @foreach($auction->mainRealsizeImagesToAuction as $image)
                                        <a href="{{ asset($auction->getRealImage($image->image)) }}" target="_blank">
                                            <img border="0" src="{{ asset($auction->getRealImage($image->image)) }}" class="img-thumbnail img-responsive" />
                                        </a>
                                    @endforeach
                                </div>
                                <div class="row">
                                    @foreach($auction->thumbnailImagesToAuction as $image)
                                        <a href="{{ asset($auction->getRealImage($image->image)) }}" target="_blank">
                                            <img border="0" src="{{ asset($auction->getThumbnailImage($image->image)) }}" class="img-thumbnail img-responsive mt-2 mr-2" />
                                        </a>
                                    @endforeach
                                </div>
                                <div class="row">
                                    {{ $auction->countAllWatchers() }}
                                    {{ __('total watchers') }}
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h1> {{ $auction->title }}</h1>
                                        <p class="card-text">
                                            {{ __('translate.Auction number') }}: {{ $auction->id }}
                                        </p>

                                        <p class="card-text">
                                            {{ __('translate.Total biddings') }}:
                                            <a href="{{ route('auction_biddings', ['auction_id' => $auction->id]) }}">{{ $total_auction_biddings }}</a>
                                        </p>

                                        <p class="card-text">
                                            @if(!$auction->isAuctionCompleted())
                                            <span class="auction-card-price-label"> {{ __('translate.Start Price') }}: </span>
                                            <div class="auction-card-price">
                                                {{ number_format($auction->start_price, 2, '.', '') }}
                                                <span class="auction-card-currency">
                                                    din.
                                                </span>
                                            </div>
                                            @endif

                                            <p>
                                                <span>{{ __("translate.Remaining time") }}:</span>
                                                @if($auction->isAuctionCompleted())
                                                    <span class="font-weight-bold">
                                                        {{ __('translate.Completed') }}
                                                    </span>
                                                @else
                                                    <span class="font-weight-bold">
                                                        @if($auction_remaining_time_in_days > 0)
                                                        {{ $auction_remaining_time_in_days }} days,
                                                        @endif
                                                        @if($auction_remaining_time_in_hours > 0)
                                                        {{ $auction_remaining_time_in_hours }} hours,
                                                        @endif
                                                        @if($auction_remaining_time_in_minutes)
                                                        {{ $auction_remaining_time_in_minutes }} minutes
                                                        @endif
                                                    </span>
                                                @endif
                                                    <br />
                                                    ({{ $auction_remaining_time_formatted }})
                                            </p>

                                            @if($auction->buy_now_price !== null && $auction->buy_now_price >= $auction->actualBiddingPrice()->actual_price)
                                            <span class="auction-card-price-label"> {{ __('translate.Buy Now Price') }}: </span>
                                            <div class="auction-card-price">
                                                {{ number_format($auction->buy_now_price, 2, '.', '') }}
                                                <span class="auction-card-currency">
                                                    din.
                                                </span>
                                            </div>
                                            @endif

                                            <div class="bg-light p-4 rounded">
                                                <div class="d-flex flex-column flex-md-row text-center text-md-left">
                                                    <div class="col-md-4 p-0">
                                                        <span class="auction-card-price-label">
                                                        {{ __('translate.Actual Offer') }}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-8 px-0 pd-item-price auction-card-price">
                                                        {{ number_format($auction->actualBiddingPrice()->actual_price, 2, '.', '') }}
                                                        <span class="auction-card-currency">
                                                            din.
                                                        </span>
                                                    </div>
                                                </div>

                                                @if(!$auction->isAuctionCompleted())
                                                <div class="d-flex flex-column flex-md-row text-center text-md-left mt-4">
                                                    <div class="col-md-4 col-12 p-0 mb-md-0 mb-3"> {{ __('translate.My Offer') }} </div>
                                                    <div class="col-md-8 col-8 px-0 mx-auto mx-md-0">
                                                        <form action="{{ action('AuctionController@bid') }}"
                                                              method="post">
                                                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                                            <div class="input-group">
                                                                <input name="textMyOffer" type="number" autocomplete="off" placeholder="(min. {{ number_format($auction->actualBiddingPrice()->actual_price, 2, '.', '') }})"
                                                                       min="{{ $auction->actualBiddingPrice()->actual_price }}"
                                                                       step="any"
                                                                       required="true"
                                                                       class="form-control form-control-lg"
                                                                >
                                                                <input name="textAuctionId" type="hidden" value="{{$auction->id}}" />
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-lg btn-success text-uppercase">
                                                                        {{ __('translate.Bid') }}
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                            <p>
                                                <span>{{ __('translate.Payments') }}:</span>
                                                <ul>
                                                    @foreach($auction->paymentMethods as $paymentMethod)
                                                        <li>
                                                            {{ $paymentMethod->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </p>

                                            <p>
                                                <span>{{ __('translate.Payment shipment') }}:</span>
                                                <ul>
                                                    @foreach($auction->shippments as $shipment)
                                                        <li>
                                                            <a target="_blank" href="{{ $shipment->url }}">
                                                                {{ $shipment->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </p

                                            <span> {{ __('translate.Condition') }}:</span>
                                            @switch($auction->item_status_id)
                                                @case(1)
                                                    {{ __('translate.Unused') }}
                                                    @break
                                                @case(2)
                                                    {{ __('translate.Used') }}
                                                    @break
                                                @case(3)
                                                    {{ __('translate.Out of order') }}
                                                    @break
                                                @case(4)
                                                    {{ __('translate.Collectible specimen') }}
                                                    @break
                                                @default
                                                    {{ __('translate.Undefined item status') }}
                                            @endswitch

                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header">
                                            {{ __('translate.Salesman') }}
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ route('user_details', ['user_id' => $auction->user->id]) }}">{{ $auction->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-4 justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{ __('translate.Item details') }}
                        </div>
                        <div class="card-body">
                            <h3>
                                {{ __('translate.Item description') }}
                            </h3>
                            <p>
                                {{ $auction->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
