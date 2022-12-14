<!--packages start-->
@extends('layouts.master')
@section('content')
    <div class="fullBanner">
        @include('partials.DefaultBanner')
    </div>
    <section class="tour-descriptions" style="margin-top: -52px;">
        <h1 style="text-align: center">
            {{ __($a->name) }}
        </h1>
        <div class="row" style="padding-left: 70px; padding-right: 70px">
            <div class="col-md-7">
                <div class="tour-descriptions-content">
                    <div class="tour-descriptions-content-inner">
                        <div class="tour-descriptions-content-inner-left">
                            <div class="tour-descriptions-content-inner-left-content">
                            </div>
                        </div>
                        <div class="tour-descriptions-content-inner-right">
                            <section class="" style="">
                                <div class="imgCcontainer">
                                    <div class="carousel imgC">
                                        @foreach ($a->images as $item)
                                            <input type="radio" name="slides" checked="checked"
                                                id="slide-{{ $item->id }}">
                                        @endforeach
                                        <ul class="carousel__slides">
                                            @foreach ($a->images as $item)
                                                <li class="carousel__slide" data-interval="1000">
                                                    <figure>
                                                        <div>
                                                            <img src="{{ asset($item->path) }}" alt="{{ __($a->name) }} ">
                                                        </div>
                                                    </figure>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <ul class="carousel__thumbnails">
                                            @foreach ($a->images as $item)
                                                @if ($item->id != $a->images->first()->id)
                                                    <li data-interval="1000">
                                                        <label for="slide-{{ $item->id }}"><img
                                                                src="{{ asset($item->path) }}" alt="{{ __($a->name) }} ">
                                                        </label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="tour-descriptions-content-inner-left-content-title bb">
                    <h2>
                        {{ __('Key Points') }}
                    </h2>
                    <div class="detailespackage">
                        <div style="float: left"><i class="fa-solid fa-person-hiking"></i>{{ __('Type') }}</div>
                        <div>
                            {{ __($a->type) }}
                        </div>
                    </div>
                    <div class="detailespackage">
                        <div><i class="fa-solid fa-person"></i>{{ __('Per Pax') }}</div>
                        <div>
                            {{ __($a->total_pax) }}
                        </div>
                    </div>

                    <div class="detailespackage">
                        <div> <i class="fa-solid fa-calendar-check"></i>
                            {{ __('Available') }}
                        </div>
                        <div>
                            {{ __($a->availability) }}
                        </div>
                    </div>
                    <div class="detailespackage">
                        <div><i class="fa-solid fa-calendar"></i>Free Cancellation</div>
                        <div>
                            {{ __($a->free_cancellation) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="carDes">
        <h2>
            {{ __('Overview') }}
        </h2>
        <p>
            {{ __($a->description) }}
        </p>
    </section>


    <section class="tableOfPrice grayAc">
        <div class="container">
            <h3 style="font-weight: 600">
                {{ __('The price') }}
            </h3>
            <br>
            <table class="table table-bordered tble" style="margin: auto">
                <thead>
                    <tr>
                        <th style="text-align: center; margin-bottom:10px; background-color: #FFF1EA">{{ __('1 Day') }}
                        </th>
                        <th style="text-align: center; margin-bottom:10px; background-color: #FFF1EA">{{ __('1 Week') }}
                        </th>
                        <th style="text-align: center; margin-bottom:10px; background-color: #FFF1EA">{{ __('1 Month') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ __($a->one_day_price) }}
                        </td>
                        <td>
                            {{ __($a->one_week_price) }}
                        </td>
                        <td>
                            {{ __($a->one_month_price) }}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <button class="package-view" style="text-align: center; align-items:center; margin:20px">
            <a href="{{ url('/BookATent/' . $a->id) }}" style="color: black">
                {{ __('Book Now') }}
            </a>
        </button>
    </section>


    <!--packages start-->
    <section id="pack" class="packages">
        <div class="container">
            <div class="gallary-header text-center">
                <h2>
                    {{ __('Related Accessories') }}
                </h2>
                {{-- <p>
                    Duis aute irure dolor in velit esse cillum dolore eu fugiat nulla.
                </p> --}}
            </div>
            
            <div class="packages-content">
                <div class="row">
                    @foreach ($related as $item)
                        <div class="col-md-4 col-sm-6">
                            <div class="single-package-item">
                                <img src="{{ url(asset($item->images->first()->path)) }}" alt="package-place">
                                <div class="HotelName">
                                    <h4>
                                        {{ __($item->name) }}
                                    </h4>
                                </div>
                                <div class="hotelDesccription">
                                    <p>
                                        {{ __($item->description) }}
                                    </p>
                                </div>
                                <div class="pacdet" style="margin-left: -7%;">
                                    <div class="packageOffer">
                                        <span><i class="fa-solid fa-calendar-check"></i></span> {{ __($item->availability) }}
                                    </div>

                                    <div class="packageOffer">
                                        <span><i class="fa-solid fa-person-hiking"></i></span> {{ __($item->type) }}
                                    </div>

                                    <div class="packageOffer">
                                        <span><i class="fa-solid fa-dollar-sign"></i></span>{{ __('From') }} {{ $item->one_day_price }}
                                        {{ __('AMD') }}
                                    </div>
                                </div>
                                <div class="rating">
                                    <span class=""><i class="fa-solid fa-star"></i></span>
                                    <span class=""><i class="fa-solid fa-star"></i></span>
                                    <span class=""><i class="fa-solid fa-star"></i></span>
                                    <span class=""><i class="fa-solid fa-star"></i></span>
                                    <span class=""><i class="fa-solid fa-star"></i></span>
                                </div>
                                <div class="package-btn">
                                    <a href="{{ url('/ac/' . $item->id) }}"><button class="package-view">
                                            {{ __('Details') }}
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                    @endforeach
                </div>
                <center>
                    {{ $related->links() }}
                </center>
                <!--/.row-->
            </div>
            <!--/.packages-content-->
        </div>
        <!--/.container-->
    </section>
@endsection
