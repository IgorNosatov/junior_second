@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">
                <p>{{ $user->name }}</p>
                    <form  method="POST" action="{{ route('user.update', $user->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Password:</label>
                            <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
