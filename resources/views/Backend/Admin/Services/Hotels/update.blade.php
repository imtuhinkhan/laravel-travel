@extends('Backend.Admin.AdminHome')
@section('admin-content')

<!-- added successfully or not -->
@if(session('success'))
<div class="alert alert-success">
    {{session('msg')}}
</div>
@elseif(session('fail'))
<div class="alert alert-danger">
    {{session('msg')}}
</div>
@endif

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="page-title" style="text-align: center">Update Hotel</h2>
        </div>
    </div>
</div>
<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Armenian</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">English</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Russian</button>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;">
            <div class="card-header">
                <h4 class="card-title">Add Information</h4>
            </div>
            <div class="card-body">
                <form id="tourForm" action="{{ url('/admin/Hotel/update/'.$hotel->id) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Hotel Name</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelAm->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Overview</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="overview_am" value="{{ $hotelAm->overview }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Description</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelAm->description }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px; width:100%; border:none" class="form-control" name="description_am" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelAm->address }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="address_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Stars</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelAm->stars }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="stars_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Google Map</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelAm->map }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="map_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelAm->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Free Cancel</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelAm->free_cancelation }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="free_cancelation_am">
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Country</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="destination_id_am">
                                       
                                        @foreach($destination as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Region</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="region_id_am">
                                        @foreach($region as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Hotel Type</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="hotel_type_id_am">
                                       
                                        @foreach($hotelType as $h)
                                        <option value="{{$h->id}}">{{$h->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Hotel Name</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotel->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Overview</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" value="{{ $hotel->overview }}" type="text" class="form-control" name="overview">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Description</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotel->description }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px; width:100%; border:none" class="form-control" name="description" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotel->address }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Stars</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotel->stars }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="stars">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Google Map</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotel->map }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="map">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotel->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Free Cancel</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotel->free_cancelation }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="free_cancelation">
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Country</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="destination_id">
                                       
                                        @foreach($destination as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Region</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="region_id">
                                        @foreach($region as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Hotel Type</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="hotel_type_id">
                                       
                                        @foreach($hotelType as $h)
                                        <option value="{{$h->id}}">{{$h->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Hotel Name</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelRu->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Overview</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="overview_ru" value="{{ $hotelRu->overview }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Description</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelRu->description }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px; width:100%; border:none" class="form-control" name="description_ru" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelRu->address }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="address_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Stars</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelRu->stars }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="stars_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Google Map</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelRu->map }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="map_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelRu->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Free Cancel</label>
                                <div class="col-md-10">
                                    <input value="{{ $hotelRu->free_cancelation }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="free_cancelation_ru">
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Country</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="destination_id_ru">
                                       
                                        @foreach($destination as $d)
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Region</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="region_id_ru">
                                        @foreach($region as $r)
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Hotel Type</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="hotel_type_id_ru">
                                       
                                        @foreach($hotelType as $h)
                                        <option value="{{$h->id}}">{{$h->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    {{-- <div class="form-group row">
                        <label class="col-form-label col-md-2">File Input </label>
                        <div class="col-md-10">
                            <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" class="form-control" type="file" name="images[]" multiple="">
                        </div>
                    </div> --}}
                    <div style="float: right">
                        <button class="btn btn-info" style="box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px; color:white; width:120px" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>

@endsection