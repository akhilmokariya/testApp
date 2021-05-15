@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.employee.create') }}" title="Create a company"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
           <div class="alert alert-success">
            <p>{{ $error }}</p>
        </div>
        @endforeach
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>Company</th>
            <th>Pincode</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        @foreach ($employee as $com)
            <tr>
                <th>{{ $com->id }}</th>
                <td>{{ $com->first_name }}</td>
                <td>{{ $com->last_name }}</td>
                <td>{{ $com->gender }}</td>
                <td>{{ $com->dob }}</td>
                <td>{{ $com->companies->name }}</td>
                <td>{{ $com->pincode }}</td>
                <td>{{ $com->email }}</td>
                <td>{{ $com->phone }}</td>
                <td>
                    <form action="{{ route('admin.employee.destroy',$com->id) }}" method="POST">

                        <a href="{{ route('admin.employee.edit',$com->id) }}">
                            <i class="fas fa-edit  fa-lg">Edit</i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Are you sure you want to delete this employee?')" type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger">Delete</i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $employee->links() !!}

@endsection