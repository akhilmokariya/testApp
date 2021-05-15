@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Companies List </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.companies.create') }}" title="Create a company"> <i class="fas fa-plus-circle"></i>
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
            <th>Name</th>
            <th>Email</th>
            <th>Website</th>
            <th>Contact Number</th>
            <th>Address</th>
            <th>Pincode</th>
            <th>Logo</th>
            <th>Action</th>
        </tr>
        @foreach ($company as $com)
            <tr>
                <td>{{ $com->id }}</td>
                <td>{{ $com->name }}</td>
                <td>{{ $com->email }}</td>
                <td>{{ $com->website }}</td>
                <td>{{ $com->contact_number }}</td>
                <td>{{ $com->address }}</td>
                <td>{{ $com->pincode }}</td>
                <td><img src="{{ $com->logo }}" height="70" width="70"></td>
                <td>
                    <form action="{{ route('admin.companies.destroy',$com->id) }}" method="POST">

                        <a href="{{ route('admin.companies.edit',$com->id) }}">
                            <i class="fas fa-edit  fa-lg">Edit</i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Are you sure you want to delete this company?')" type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger">Delete</i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $company->links() !!}

@endsection