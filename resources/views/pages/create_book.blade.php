@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create new Book') }}</div>
                <div class="card-body">
                    <form method="post" action="{{ route('book.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Book Title:</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter book author ....."  required>
                        </div>
                        <div class="form-group">
                            <label for="author">Book Author:</label>
                            <input type="text" class="form-control" name="author" placeholder="Enter book author ....."  required>
                        </div>
                        <div class="form-group">
                            <label for="description">Book description</label>
                            <textarea class="form-control" id="description" name="description" rows="8" placeholder="Enter book description ....."  required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Book image</label>
                            <input type="file" id="image" name="image" class="form-control" placeholder="Put book image ....."  required>
                        </div>
                        <div class="form-group">
                            <label for="genre">Book genre</label>
                            <input type="text" class="form-control" name="genre" placeholder="Enter book genre ....."  required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
