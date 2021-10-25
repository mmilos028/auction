@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">

                <div class="card mb-2">
                    <div class="card-header">
                        {{ $current_category->name }}
                    </div>
                    @if(count($sub_categories) > 0)
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($sub_categories as $category)
                                <li>
                                    <a href="{{ route('category_seo_url_path', ['seo_url_path' => $category->seo_url_path]) }}" class="btn-link" title="{{$category->description}}">
                                        {{ $category->name }}
                                        (
                                        {{ $category->total_auction_items }}
                                        )
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('category_seo_url_path', ['seo_url_path' => $category->seo_url_path]) }}" class="btn-link" title="{{$category->description}}">
                                        {{ $category->name }}
                                        (
                                            {{ $category->total_auction_items }}
                                        )
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(isset($path))
                                    @foreach($path as $p)

                                        <a href="{{ route('category_seo_url_path', ['seo_url_path' => $p->seo_url_path]) }}">{{ $p->name }}</a>
                                        @if(!$loop->last)
                                            /
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
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
                                                                <span class="auction-card-price-label"> {{ __('translate.Price') }}: </span>
                                                                <div class="auction-card-price">
                                                                    {{ number_format($auction->start_price, 2, '.', '') }}
                                                                    <span class="auction-card-currency">
                                                                        din.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @if($auction->buy_now_price != null)
                                                            <div class="col-6">
                                                                <span class="auction-card-price-label"> {{ __('translate.Buy Now Price') }}: </span>
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
                                                            {{ $auction->getRemainingTime()['auction_remaining_time_in_days'] }} {{ __('translate.days') }}
                                                        @elseif($auction->getRemainingTime()['auction_remaining_time_in_hours'] > 0)
                                                            {{ $auction->getRemainingTime()['auction_remaining_time_in_hours'] }} {{ __('translate.hours') }}
                                                        @elseif($auction->getRemainingTime()['auction_remaining_time_in_minutes'])
                                                            {{ $auction->getRemainingTime()['auction_remaining_time_in_minutes'] }} {{ __('translate.minutes') }}
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
