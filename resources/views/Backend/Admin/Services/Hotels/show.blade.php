@extends('Backend.Admin.AdminHome')
@section('admin-content')
    {{-- {{$tour}} --}}

    @if(session('success'))
<div class="alert alert-success">
    {{session('msg')}}
</div>
@elseif(session('fail'))
<div class="alert alert-danger">
    {{session('msg')}}
</div>
@endif



    <div class="container-fluid">
        <h2 class="text-center font-weight-bold">
            Hotel Description
        </h2>
        <div class="row">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="padding: 100px">
                <div class="carousel-inner" style="width: 69%;margin: auto;">
                    <div class="carousel-item active" data-bs-interval="1000">
                        <img src="{{ asset($hotel->images->first()->path) }}" class="d-block w-100 " alt="...">
                    </div>
                    @foreach ($hotel->images as $image)
                        @if ($image->id != $hotel->images->first()->id)
                            <div class="carousel-item" data-bs-interval="1000">
                                <img src="{{ asset($image->path) }}" class="d-block w-100" alt="...">
                            </div>
                        @endif
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

<center>
    <h5>
        {{ $hotel->description }}
    </h5>
    {{ $hotel->overview }}
    
</center>
    <div class="col-md-12">

        <div>
            <div
                style=" padding: 30px; margin: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; align-items:center">
            

                <div class="d-flex justify-content-between">
                    <div class="col-md-3">
                        <div class="mb-3">
                            Name
                        </div>
                        <div class="mb-3">
                            Address
                        </div>

                        <div class="mb-3">
                            Stars
                        </div>
                        <div class="mb-3">
                            Price
                        </div>
                        <div class="mb-3">
                            Free Cancelation
                        </div>
                        <div class="mb-3">
                           Hotel Type

                        </div>
                        <div class="mb-3">
                            Destination
                        </div>

                        <div>
                            Region
                        </div>


                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            {{ $hotel->name }}
                        </div>
                        <div class="mb-3">
                            {{ $hotel->address }}
                        </div>
                        <div class="mb-3">
                            {{ $hotel->stars }}
                        </div>
                        <div class="mb-3">
                            {{ $hotel->price }}
                        </div>
                        <div class="mb-3">
                            {{ $hotel->free_cancelation }}
                        </div>
                        <div class="mb-3">
                          {{ $hotel->hotelType->name }}
                        </div>
                        <div class="mb-3">
                            {{ $hotel->destination->name }}
                        </div>
                        <div class="mb-3">
                            {{ $hotel->region->name}}
                        </div>


                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div
                style=" padding: 30px; margin: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; align-items:center">
                <h3 class="">
                    Highlights
                </h3>
                <hr>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab-1" data-bs-toggle="tab" data-bs-target="#nav-home-1" type="button" role="tab" aria-controls="nav-home-1" aria-selected="true">Armenian</button>
                    <button class="nav-link" id="nav-profile-tab-1" data-bs-toggle="tab" data-bs-target="#nav-profile-1" type="button" role="tab" aria-controls="nav-profile-1" aria-selected="false">English</button>
                    <button class="nav-link" id="nav-contact-tab-1" data-bs-toggle="tab" data-bs-target="#nav-contact-1" type="button" role="tab" aria-controls="nav-contact-1" aria-selected="false">Russian</button>
                </div>
                <form action="{{ url('/admin/hotel/highlight/' . $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home-1" role="tabpanel" aria-labelledby="nav-home-tab-1">
                                <input type="text" class="form-control" placeholder="Add Highlights" name="name_am">
                            </div>
                            <div class="tab-pane fade" id="nav-profile-1" role="tabpanel" aria-labelledby="nav-profile-tab-1">
                                <input type="text" class="form-control" placeholder="Add Highlights" name="name">
                            </div>
                            <div class="tab-pane fade" id="nav-contact-1" role="tabpanel" aria-labelledby="nav-contact-tab-1">
                                <input type="text" class="form-control" placeholder="Add Highlights" name="name_ru">
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-info text-white">
                            Submit
                        </button>
                    </div>

                </form>
                <br>
                <div class="list-group list-group-light">

                    @foreach ($hotel->highlights as $highlight)
                        <div class="list-group-item list-group-item-action px-3 border-0 justify-content-between"
                            style="display: flex">

                            {{ $highlight->name }}


                            <form action="{{ url('/hotelHighlight/delete/' . $highlight->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger btn-sm ">
                                    Detete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <div
                style=" padding: 30px; margin: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; align-items:center">
                <h3 class="">
                    Add key points
                </h3>
                <hr>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab-2" data-bs-toggle="tab" data-bs-target="#nav-home-2" type="button" role="tab" aria-controls="nav-home-2" aria-selected="true">Armenian</button>
                    <button class="nav-link" id="nav-profile-tab-2" data-bs-toggle="tab" data-bs-target="#nav-profile-2" type="button" role="tab" aria-controls="nav-profile-2" aria-selected="false">English</button>
                    <button class="nav-link" id="nav-contact-tab-2" data-bs-toggle="tab" data-bs-target="#nav-contact-2" type="button" role="tab" aria-controls="nav-contact-2" aria-selected="false">Russian</button>
                </div>
                <form action="{{ url('/admin/addHotelKey/' . $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home-2" role="tabpanel" aria-labelledby="nav-home-tab-2">
                                <input type="text" class="form-control" placeholder="Add Key Points" name="key_am">
                            </div>
                            <div class="tab-pane fade" id="nav-profile-2" role="tabpanel" aria-labelledby="nav-profile-tab-2">
                                <input type="text" class="form-control" placeholder="Add Key Points" name="key">
                            </div>
                            <div class="tab-pane fade" id="nav-contact-2" role="tabpanel" aria-labelledby="nav-contact-tab-2">
                                <input type="text" class="form-control" placeholder="Add Key Points" name="key_ru">
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-info text-white">
                            Submit
                        </button>
                    </div>

                </form>
                <div class="list-group list-group-light">

                    @foreach ($hotel->hotelKeys as $room)
                        <div class="list-group-item list-group-item-action px-3 border-0 justify-content-between"
                            style="display: flex">

                            <hr>
                            <div>
                                {{ $room->key }}
                            </div>



                            {{-- <form action="{{ url('/hotelFacility/delete/' . $room->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger btn-sm ">
                                    Detete
                                </button>
                            </form> --}}

                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
            <div
            style=" padding: 30px; margin: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; align-items:center">
            <h3 class="">
                Hotel Included
            </h3>
            <hr>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab-3" data-bs-toggle="tab" data-bs-target="#nav-home-3" type="button" role="tab" aria-controls="nav-home-3" aria-selected="true">Armenian</button>
                <button class="nav-link" id="nav-profile-tab-3" data-bs-toggle="tab" data-bs-target="#nav-profile-3" type="button" role="tab" aria-controls="nav-profile-3" aria-selected="false">English</button>
                <button class="nav-link" id="nav-contact-tab-3" data-bs-toggle="tab" data-bs-target="#nav-contact-3" type="button" role="tab" aria-controls="nav-contact-3" aria-selected="false">Russian</button>
            </div>
            <form action="{{ url('/admin/hotel/facility/' . $hotel->id) }}" method="POST"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="">
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home-3" role="tabpanel" aria-labelledby="nav-home-tab-3">
                            <input type="text" class="form-control" placeholder="What is included?" name="name_am">
                        </div>
                        <div class="tab-pane fade" id="nav-profile-3" role="tabpanel" aria-labelledby="nav-profile-tab-3">
                            <input type="text" class="form-control" placeholder="What is included?" name="name">
                        </div>
                        <div class="tab-pane fade" id="nav-contact-3" role="tabpanel" aria-labelledby="nav-contact-tab-3">
                            <input type="text" class="form-control" placeholder="What is included?" name="name_ru">
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-info text-white" type="submit">
                        Submit
                    </button>
                </div>

            </form>
            <br>
            <div class="list-group list-group-light">

                @foreach ($hotel->hotelFacilities as $room)
                    <div class="list-group-item list-group-item-action px-3 border-0 justify-content-between"
                        style="display: flex">

                        <div>
                            {{ $room->name }}
                        </div>



                        <form action="{{ url('/hotelFacility/delete/' . $room->id) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger btn-sm ">
                                Detete
                            </button>
                        </form>

                        <hr>
                    </div>
                @endforeach
            </div>
            
        </div>
        </div>

        <div class="col-md-6">
            <div
                style=" padding: 30px; margin: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; align-items:center">
                <h3 class="">
                    Rooms
                </h3>
                <hr>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab-4" data-bs-toggle="tab" data-bs-target="#nav-home-4" type="button" role="tab" aria-controls="nav-home-4" aria-selected="true">Armenian</button>
                    <button class="nav-link" id="nav-profile-tab-4" data-bs-toggle="tab" data-bs-target="#nav-profile-4" type="button" role="tab" aria-controls="nav-profile-4" aria-selected="false">English</button>
                    <button class="nav-link" id="nav-contact-tab-4" data-bs-toggle="tab" data-bs-target="#nav-contact-4" type="button" role="tab" aria-controls="nav-contact-4" aria-selected="false">Russian</button>
                </div>
                <form action="{{ url('/admin/hotel/room/' . $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="">
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home-4" role="tabpanel" aria-labelledby="nav-home-tab-4">
                                <input type="text" class="form-control" placeholder="Add Room" name="name_am">
                                <input type="text" class="form-control mt-2" placeholder="Add Price" name="price_am">
                                <input type="text" class="form-control mt-2" placeholder="Add Price" name="price2_am">
                            </div>
                            <div class="tab-pane fade" id="nav-profile-4" role="tabpanel" aria-labelledby="nav-profile-tab-4">
                                <input type="text" class="form-control" placeholder="Add Room" name="name">
                                <input type="text" class="form-control mt-2" placeholder="Add Price" name="price">
                                <input type="text" class="form-control mt-2" placeholder="Add Price" name="price2">
                            </div>
                            <div class="tab-pane fade" id="nav-contact-4" role="tabpanel" aria-labelledby="nav-contact-tab-4">
                                <input type="text" class="form-control" placeholder="Add Room" name="name_ru">
                                <input type="text" class="form-control mt-2" placeholder="Add Price" name="price_ru">
                                <input type="text" class="form-control mt-2" placeholder="Add Price" name="price2_ru">
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-info text-white" type="submit">
                            Submit
                        </button>
                    </div>

                </form>
                <br>
                <div class="list-group list-group-light">

                    @foreach ($hotel->rooms as $room)
                        <div class="list-group-item list-group-item-action px-3 border-0 justify-content-between"
                            style="display: flex">

                            <div>
                                <b>Room Type:</b> {{ $room->name }}
                            </div>

                            <div>
                                <b>Price:</b> {{ $room->price }} - {{ $room->price2 }}

                            </div>

                            <form action="{{ url('/hotelRoom/delete/' . $room->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger btn-sm ">
                                    Detete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <div
            style=" padding: 30px; margin: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; align-items:center">
            <h3 class="">
                Useful to Know
            </h3>
            <hr>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab-5" data-bs-toggle="tab" data-bs-target="#nav-home-5" type="button" role="tab" aria-controls="nav-home-5" aria-selected="true">Armenian</button>
                <button class="nav-link" id="nav-profile-tab-5" data-bs-toggle="tab" data-bs-target="#nav-profile-5" type="button" role="tab" aria-controls="nav-profile-5" aria-selected="false">English</button>
                <button class="nav-link" id="nav-contact-tab-5" data-bs-toggle="tab" data-bs-target="#nav-contact-5" type="button" role="tab" aria-controls="nav-contact-5" aria-selected="false">Russian</button>
            </div>
            <form action="{{ url('/admin/addHotelInfo/' . $hotel->id) }}" method="POST"
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="">
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home-5" role="tabpanel" aria-labelledby="nav-home-tab-5">
                            <input type="text" class="form-control" placeholder="What is useful to know?" name="name_am">
                        </div>
                        <div class="tab-pane fade" id="nav-profile-5" role="tabpanel" aria-labelledby="nav-profile-tab-5">
                            <input type="text" class="form-control" placeholder="What is useful to know?" name="name">
                        </div>
                        <div class="tab-pane fade" id="nav-contact-5" role="tabpanel" aria-labelledby="nav-contact-tab-5">
                            <input type="text" class="form-control" placeholder="What is useful to know?" name="name_ru">
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-info text-white" type="submit">
                        Submit
                    </button>
                </div>

            </form>
            <br>
            <div class="list-group list-group-light">

                @foreach ($hotel->hotelInfo as $room)
                    <div class="list-group-item list-group-item-action px-3 border-0 justify-content-between"
                        style="display: flex">

                        <div>
                            {{ $room->name }}
                        </div>



                        <form action="{{ url('/hotelInfo/delete/' . $room->id) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger btn-sm ">
                                Detete
                            </button>
                        </form>

                        <hr>
                    </div>
                @endforeach
            </div>
        </div>
        </div>


    </div>

    {{-- <div class="row">
        <div class="col-md-6">
            <div
                style=" padding: 30px; margin: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; align-items:center">
                <h3 class="">
                    Hotel Included
                </h3>
                <hr>
                <form action="{{ url('/admin/hotel/facility/' . $hotel->id) }}" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="">
                        <input type="text" class="form-control" placeholder="What is included?" name="name">

                        <hr>
                        <button class="btn btn-info text-white" type="submit">
                            Submit
                        </button>
                    </div>

                </form>
                <br>
                <div class="list-group list-group-light">

                    @foreach ($hotel->hotelFacilities as $room)
                        <div class="list-group-item list-group-item-action px-3 border-0 justify-content-between"
                            style="display: flex">

                            <div>
                                {{ $room->name }}
                            </div>



                            <form action="{{ url('/hotelFacility/delete/' . $room->id) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger btn-sm ">
                                    Detete
                                </button>
                            </form>

                            <hr>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>

       


    </div> --}}
@endsection
