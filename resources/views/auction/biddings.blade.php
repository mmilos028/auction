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
                                        <a href="{{ route('auction_details', ['auction_id' => $auction->id]) }}">
                                            <img border="0" src="{{ asset($auction->getRealImage($image->image)) }}" class="img-thumbnail img-responsive" />
                                        </a>
                                    @endforeach

                                    <p class="card-text">
                                        {{ __('Salesman') }}
                                        :
                                        <a href="{{ route('user_details', ['user_id' => $auction->user->id]) }}">{{ $auction->user->name }}</a>
                                    </p>

                                    <p class="card-text">
                                        {{ __('Auction number') }}: {{ $auction->id }}
                                    </p>

                                    <p>
                                        <span>{{ __("Remaining time") }}:</span>
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
                                            ({{ $auction_remaining_time_formatted }})
                                    </p>

                                    <p>
                                        <a href="{{ route('auction_details', ['auction_id' => $auction->id]) }}">
                                            {{ __('Back') }}
                                        </a>
                                    </p>

                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <h3>
                                            <a href="{{ route('auction_details', ['auction_id' => $auction->id]) }}">
                                            {{ $auction->title }}
                                            </a>
                                        </h3>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Member
                                                    </th>
                                                    <th>
                                                        Date
                                                    </th>
                                                    <th>
                                                        Offer
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($biddings as $bid)
                                                    <tr>
                                                        <td>
                                                            {{ $bid->user->name }}
                                                        </td>
                                                        <td>
                                                            {{ $bid->created_at->format('d-M-Y H:i:s') }}
                                                        </td>
                                                        <td>
                                                            {{ number_format($bid->actual_price, 2, '.', '') }}
                                                            din.
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
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
