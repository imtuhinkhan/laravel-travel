@extends('Backend.Admin.AdminHome')
@section('admin-content')
@if(session('success'))
<div class="alert alert-success">
    {{session('msg')}}
</div>
@elseif(session('fail'))
<div class="alert alert-danger">
    {{session('msg')}}
</div>
@endif
    <div class="row">
        <div class="col-md-12 d-flex overflow-scroll">

            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h4 class="card-title float-start"> City</h4>
                    <button class="btn btn-info" style="color: white; margin-left:15px">
                        <a href="{{ url('/admin/city/new') }}" style="color: white">
                            <i class="fa fa-plus" style="color: white"></i>
                            Add City
                        </a>
                    </button>


                    <div class="table-search float-end">
                        <input type="text" class="form-control" placeholder="Search">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>


                </div>
                <div class="card-body"
                    style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;">
                    <div class="table-responsive no-radius">
                        <table class="table table-hover table-center">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($city as $row=>$val)
                                <tr>
                                    <td>{{$row+1}}</td>
                                    <td>{{$val->name}}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{url('/')}}/admin/city/edit/{{$val->id}}">Edit</a>
                                        <a class="btn btn-danger" href="{{url('/')}}/admin/city/delete/{{$val->id}}">Delete</a>
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
@endsection
