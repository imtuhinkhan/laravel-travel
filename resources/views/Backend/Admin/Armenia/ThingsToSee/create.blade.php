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
            <h2 class="page-title" style="text-align: center">Create places to see</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;">
            <div class="card-header">
                <h4 class="card-title">Add Information</h4>
            </div>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Armenian</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">English</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Russian</button>
            </div>
            <div class="card-body">
                <form id="tourForm" action="/admin/thingsToSee/store" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Name</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Description</label>
                                <div class="col-md-10">
                                    <textarea style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px; width:100%; border:none" name="description_am" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Time</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="time_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="address_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Duration</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="duration_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Period</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="period_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Distance</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="distance_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price_am">
                                </div>
                            </div>
        
                            <!-- category dropdown -->
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Category</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="category_id_am">
                                        
                                        @foreach($categories as $category)
                                        <option  value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Google Map </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" class="form-control" type="text" name="map_am" multiple="">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">File Input </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" class="form-control" type="file" name="images_am[]" multiple="">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Name</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Description</label>
                                <div class="col-md-10">
                                    <textarea style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px; width:100%; border:none" name="description" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Time</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="time">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Duration</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="duration">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Period</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="period">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Distance</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="distance">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price">
                                </div>
                            </div>
        
                            <!-- category dropdown -->
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Category</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="category_id">
                                        
                                        @foreach($categories as $category)
                                        <option  value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Google Map </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" class="form-control" type="text" name="map" multiple="">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">File Input </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" class="form-control" type="file" name="images[]" multiple="">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Name</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Description</label>
                                <div class="col-md-10">
                                    <textarea style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px; width:100%; border:none" name="description_ru" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Time</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="time_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="address_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Duration</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="duration_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Period</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="period_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Distance</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="distance_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="price_ru">
                                </div>
                            </div>
        
                            <!-- category dropdown -->
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Category</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select" name="category_id_ru">
                                        
                                        @foreach($categories as $category)
                                        <option  value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Google Map </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" class="form-control" type="text" name="map_ru" multiple="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">File Input </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" class="form-control" type="file" name="images_ru[]" multiple="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
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