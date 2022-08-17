<section class="requestTour">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="requestTour__title">
                    <h2 style="text-align: center">
                        {{ __('Choose one of our tours or create your own trip!') }}
                    </h2>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-12 padding-0 ">
                            <ul class="list-group ProgressBarItem" style="display: flex;">
                                <li class="list-group-item resMargin" style="background-color:#F7F6F4; border:none;">
                                    <i>{{ __('Information about the group') }}</i>
                                </li>
                            </ul>
                            <div class="progress Progress-border ProgressBarSize">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: 100%; background-color: #284525;" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 padding-0 ">
                            <ul class="list-group ProgressBarItem" style="display: flex;">
                                <li class="list-group-item resMargin" style="background-color:#F7F6F4; border:none; ">
                                    <i>{{ __('Select the destination') }}</i>
                                </li>
                            </ul>
                            <div class="progress Progress-border ProgressBarSize">
                                <div class="progress-bar bg-success " role="progressbar"
                                    style="width: 0%; background-color: #284525;" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 padding-0 ">
                            <ul class="list-group ProgressBarItem" style="display: flex;">
                                <li class="list-group-item resMargin" style="background-color:#F7F6F4; border:none;">
                                    <i>{{ __('Submit for a quote') }}</i>
                                </li>
                            </ul>
                            <div class="progress Progress-border ProgressBarSize">
                                <div class="progress-bar bg-success " role="progressbar"
                                    style="width: 0%; background-color: #284525;" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="col-md-5 col-xs-12">
                        <br>
                        <br>
                        <br>
                        <img src="{{ asset('images/ReqTour1.png') }}" alt="">
                    </div>
                    <div class="col-md-7 col-xs-12">
                        <form>
                            <fieldset>
                                <div class="col-md-12 col-xs-12">
                                    <input class="reqTourInput" type="text" placeholder="{{ __('Name') }}"
                                        style="width:100%" name="name">
                                </div>
                                <div class="col-md-12 col-xs-12">
                                    <input class="reqTourInput" type="text" id="datepicker"
                                        placeholder="{{ __('Start Date') }}" name="start_date" style="width:100%"
                                        onfocus="(this.type='date')">
                                </div>
                                <div class="col-md-12 col-xs-12">

                                    <Select id="Starting Destination" style="width:100%" class="reqTourInput">
                                        <option value="">{{ __('Starting Destination') }}</option>
                                        @foreach ($destination as $d )                                        
                                        <option>
                                            {{ $d->name }}
                                        </option>
                                        @endforeach
                                    </Select>
                                </div>
                                <div class="col-md-12 col-xs-12">

                                    <div class="col-md-6 col-xs-12">
                                        <span><label for=""
                                                style="float: left; background-color: white; width: 100%;"
                                                class="reqTourInput">
                                                <input type="number" style="border:none; outline:none; width: 100%"
                                                    placeholder="{{ __('Number Of Adults') }}">
                                            </label></span>

                                    </div>
                                    <div class="col-md-6 col-xs-12" style="">
                                        <div class="ReqBox" style="width: 130px; float:left;">
                                                <input type="number" style="border:none; outline:none; width: 100%"
                                                    placeholder="{{ __('Number Of Childs') }}">
                                        </div>
                                      
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12" style="margin: 16px">

                                    <div class="col">
                                        <div class="ReqBox" style="width: 130px; float:left;"><i
                                                class="fa-solid fa-car"></i>
                                            <div>
                                                {{-- {{ __('Car') }} --}}
                                                <input type="checkbox" checked>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="ReqBox" style="width: 130px; float:left;"><i
                                                class="fa-solid fa-motorcycle"></i> 
                                                {{-- {{ __('Motorcycle') }} --}}
                                           <div>
                                            <input type="checkbox">
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="ReqBox" style="width: 130px; float:left;"><i
                                                class="fa-solid fa-person-biking"></i>
                                            <div>
                                                {{-- {{ __('Bike') }} --}}
                                                <input type="checkbox">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="ReqBox" style="width: 130px; float:left;"> <i
                                                class="fa-solid fa-person-hiking"></i>
                                            <div>
                                                {{-- {{ __('Hiking') }} --}}
                                                <input type="checkbox">
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <div class="col-md-12 col-xs-12">

                                    <Select id="Starting Destination" style="width:100%" class="reqTourInput" pla>
                                        <option>--Select Additional--</option>
                                        <option>
                                            Meals (15$ per pax)
                                        </option>

                                    </Select>
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <button class="package-view" style="margin: 20px">
                                        <a style="text-decoration: none; color:black; font-weight:600; padding:5px "
                                            href="{{ url('/secondStep') }}">
                                            {{ __('Create trip') }}
                                        </a>

                                    </button>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
    $(function() {
        $("#datepicker").datepicker();
    });
</script>
