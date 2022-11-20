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
            <h2 class="page-title" style="text-align: center">Update event</h2>
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
                <form id="tourForm" action="/admin/events/update/{{$tour_event->id}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PUT')
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Event name</label>
                                <div class="col-md-10">
                                    <input value="{{ $tour_event_am->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Event Type</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_am->type}}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="type_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Location
                                </label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_am->location }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="location_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Time</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_am->time }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="time_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Period</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_am->period }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="period_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">settlement</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_am->settlement }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="settlement_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Distance</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_am->distance }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="distance_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Duration</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_am->duration }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="duration_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_am->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price_am">
                                </div>
                            </div>
                        </div>
                
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Event name</label>
                                <div class="col-md-10">
                                    <input value="{{ $tour_event->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Event Type</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event->type}}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="type">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Location
                                </label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event->location }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="location">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Time</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event->time }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="time">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Period</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event->period }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="period">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">settlement</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event->settlement }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="settlement">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Distance</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event->distance }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="distance">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Duration</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event->duration }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="duration">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Event name</label>
                                <div class="col-md-10">
                                    <input value="{{ $tour_event_ru->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Event Type</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_ru->type}}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="type_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Location
                                </label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_ru->location }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="location_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Time</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_ru->time }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="time_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Period</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_ru->period }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="period_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">settlement</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_ru->settlement }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="settlement_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Distance</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_ru->distance }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="distance_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Duration</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_ru->duration }}"  style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="duration_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input  value="{{ $tour_event_ru->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price_ru">
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
<!-- <script src="url('js/tour.js')"></script> -->
@endsection