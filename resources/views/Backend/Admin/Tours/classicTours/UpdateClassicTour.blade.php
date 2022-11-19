@extends('Backend.Admin.AdminHome')
@section('admin-content')
    <!-- added successfully or not -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @elseif(session('fail'))
        <div class="alert alert-danger">
            {{ session('msg') }}
        </div>
    @endif

    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="page-title" style="text-align: center">Update Tours</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;">
                <div class="card-header">
                    <h4 class="card-title">Add Information</h4>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Armenian</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">English</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Russian</button>
                        </div>
                    </nav>
                    <form id="tourForm" action="{{ url('/admin/tour/update/' . $tour->id) }}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour name</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="name_am">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour Type</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->type }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="type">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Description</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->description }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="description_am">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Duration</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->duration }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="duration_am">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Price (AMD)</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="price_am">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Start Date</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->start_date }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="start_date_am">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">For Home?</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="home_tour_id_am">
                                            
                                            @foreach($homeTour as $d)
                                            <option value="{{ $d->id }}">{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">2-3 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->one_day_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_day_price_am">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">4-6 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->one_week_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_week_price_am">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">17-30 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->one_month_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_month_price_am">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">30 Pax More</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->one_year_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_year_price_am">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">End Date</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourAm->end_date }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="end_date_am">
                                    </div>
                                </div>
                                
                                <!-- category dropdown -->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour Category</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="category_id_am">
                                
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- destination dropdown -->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Country</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="destination_id_am">
                                
                                            @foreach ($destinations as $destination)
                                                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour name</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour Type</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->type }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="type">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Description</label>
                                    <div class="col-md-10">
                                        <input value={{ $tour->description }}
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Duration</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->duration }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="duration">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Price (AMD)</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Start Date</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->start_date }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="start_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">For Home?</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="home_tour_id">
                                            
                                            @foreach($homeTour as $d)
                                            <option value="{{ $d->id }}">{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">2-3 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->one_day_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_day_price">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">4-6 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->one_week_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_week_price">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">17-30 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->one_month_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_month_price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">30 Pax More</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->one_year_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_year_price">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">End Date</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tour->end_date }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="end_date">
                                    </div>
                                </div>
                                
                                <!-- category dropdown -->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour Category</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="category_id">
                                
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- destination dropdown -->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Country</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="destination_id">
                                
                                            @foreach ($destinations as $destination)
                                                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour name</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->name }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="name_ru">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour Type</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->type }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="type">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Description</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->description }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="description_ru">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Duration</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->duration }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="duration_ru">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Price (AMD)</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->price }}" style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;"
                                            type="text" class="form-control" name="price_ru">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Start Date</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->start_date }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="start_date_ru">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">For Home?</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="home_tour_id_ru">
                                            
                                            @foreach($homeTour as $d)
                                            <option value="{{ $d->id }}">{{$d->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">2-3 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->one_day_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_day_price_ru">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">4-6 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->one_week_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_week_price_ru">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">17-30 Pax</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->one_month_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_month_price_ru">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">30 Pax More</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->one_year_price }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="one_year_price_am">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">End Date</label>
                                    <div class="col-md-10">
                                        <input value="{{ $tourRu->end_date }}"
                                            style="box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;" type="text"
                                            class="form-control" name="end_date_ru">
                                    </div>
                                </div>
                                
                                <!-- category dropdown -->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Tour Category</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="category_id_ru">
                                
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- destination dropdown -->
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Country</label>
                                    <div class="col-md-10">
                                        <select class="form-control form-select" name="destination_id_ru">
                                
                                            @foreach ($destinations as $destination)
                                                <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="float: right">
                            <button class="btn btn-info"
                                style="box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px; color:white; width:120px"
                                type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- <script src="url('js/tour.js')"></script> -->
@endsection
