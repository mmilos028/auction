@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        @if ($auctions!==null)
                            @foreach($auctions as $auction)
                                <div class="row">
                                    <div class="col-3">
                                        <img border="0" width="180" src="{{ asset($auction->image) }}" class="img-thumbnail mt-4" />
                                    </div>
                                    <div class="col-9">
                                        <div class="card mb-2">
                                            <div class="card-body">
                                                <h4>
                                                    <a href="{{ route('auction_details', ['auction_id' => $auction->auction_id]) }}">
                                                        {{ $auction->title  }}
                                                    </a>
                                                </h4>
                                                <p class="card-text">
                                                    {{Str::limit(strip_tags($auction->description), 150,'...')}}
                                                </p>

                                                <a href="{{ route('user_details', ['user_id' => $auction->user->id]) }}">{{ $auction->user->name }}</a>

                                                <div class="card-text">
                                                    <span class="auction-card-price-label"> {{ __('Price') }}: </span>
                                                    <div class="auction-card-price">
                                                        {{ number_format($auction->start_price, 2, '.', '') }}
                                                        <span class="auction-card-currency">
                                                            din.
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="row">
                            <div class="col-12">
                                {{-- $auctions --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
