@extends('layouts.app')

@section('title', 'Users Page')

@section('content')
<div class="row pb-5">
    <div class="col-md-3 col-sm-12">
        <a class="btn btn-success text-uppercase" href="{{ route('user.create') }}">User create</a>
    </div>
    <div class="col-md-9 col-sm-12">
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <form action="/user/">
            <div class="form-group">
                <label for="exampleInputEmail1">Search User:</label>
                <input type="search" name="search" class="form-control pb-1" placeholder="Enter book name .....">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Sort by:</label>
                <select name="sortBy" id="sortBy" class="form-control form-control-sm" value="{{ $sortBy }}">
                    @foreach(['id', 'name', 'email'] as $col)
                    <option @if($col==$sortBy) selected @endif value="{{ $col }}">{{ ucfirst($col) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="orderBy">Order by:</label>
                <select name="orderBy" id="orderBy" class="form-control form-control-sm" value="{{ $orderBy }}">
                    @foreach(['asc', 'desc'] as $order)
                    <option @if($order==$orderBy) selected @endif value="{{ $order }}">{{ ucfirst($order) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="perPage">Show book per page:</label>
                <select name="perPage" id="perPage" class="form-control form-control-sm " value="{{ $perPage }}">
                    @foreach(['10','20','30','40'] as $page)
                    <option @if($page==$perPage) selected @endif value="{{ $page }}">{{ $page }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/user/" class="btn btn-primary">Reset</a>
        </form>
    </div>
    <div class="col-md-9 col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection
