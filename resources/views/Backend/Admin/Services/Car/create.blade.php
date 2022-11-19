

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
            <h2 class="page-title" style="text-align: center">Create Car</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;">
            <div class="card-header">
                <h4 class="card-title">Add Information</h4>
            </div>
            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Armenian</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">English</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Russian</button>
                </div>
            </nav>
            <div class="card-body">
                <form id="tourForm" action="/car/store" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Name
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name_am">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Overview
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="overview_am">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Type
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="car_type_am">
                                </div>
                               
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Model
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="car_model_am">
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Seats</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="seats_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Daily Price</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="daily_price_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Weekly Price
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="weekly_price_am">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Monthly Price
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="monthly_price_am">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                   Free Cancellation
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="free_cancelation_am">
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
                                <label class="col-form-label col-md-2">
                                    Car Name
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Overview
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="overview">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Type
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="car_type">
                                </div>
                               
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Model
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="car_model">
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Seats</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="seats">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Daily Price</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="daily_price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Weekly Price
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="weekly_price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Monthly Price
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="monthly_price">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                   Free Cancellation
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="free_cancelation">
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
                                <label class="col-form-label col-md-2">
                                    Car Name
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="name_ru">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Overview
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="overview_ru">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Type
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="car_type_ru">
                                </div>
                               
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Car Model
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="car_model_ru">
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Seats</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="seats_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Daily Price</label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="daily_price_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Weekly Price
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="weekly_price_ru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                    Monthly Price
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="monthly_price_ru">
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">
                                   Free Cancellation
                                </label>
                                <div class="col-md-10">
                                    <input style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text" class="form-control" name="free_cancelation_ru">
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
                        <button class="btn btn-info"  style="box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px; color:white; width:120px" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>
<!-- <script src="url('js/tour.js')"></script> -->
@endsection