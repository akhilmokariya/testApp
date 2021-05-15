@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.employee.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.employee.update',$employee->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="first_name" value="{{$employee->first_name}}" class="form-control" placeholder="First Name">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="last_name" value="{{$employee->last_name}}" class="form-control" placeholder="Last Name:">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Gender:</strong>

                    <input type="radio" value="Male" {{ $employee->gender == 'Male' ? 'checked' : ''}} id="male" name="gender">
                    <label for="male">Male</label>
                    <input type="radio" value="Female" {{ $employee->gender == 'Female' ? 'checked' : ''}} id="female" name="gender">
                    <label for="female">Female</label> 
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Date of Birth:</strong>
                    <input class="form-control" type="date" value="{{ date("dd-mm-YYYY", strtotime($employee->dob)) }}
                    " id="date-input" name="dob" placeholder="dd-MM-yyyy" locate="pt-br" format="dd-MM-yyyy" ></input>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Company:</strong>
                    <select class="form-control" name="company_id" id="company">
                        <?php if($companies){ 
                            foreach($companies as $id => $name) { ?>
                                <option {{ ($id == $employee->company_id) ? "selected" : "" }} value="{{$id}}">{{$name}}</option><?php
                            }
                        }?>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Pincode:</strong>
                    <input type="text" name="pincode" value="{{ $employee->pincode }}" class="form-control" placeholder="Pincode">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" value="{{ $employee->email }}" class="form-control" placeholder="Email">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Phone:</strong>
                    <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control" placeholder="Phone">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection