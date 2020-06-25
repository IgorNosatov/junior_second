@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p>{{ $book->name }}</p>
                    <form method="POST" action="{{ route('book.update', $book->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="title">Book Title:</label>
                            <input type="text" class="form-control" name="title" value="{{ $book->title }}">
                        </div>
                        <div class="form-group">
                            <label for="author">Book Author:</label>
                            <input type="text" class="form-control" name="author" value="{{ $book->author }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Book description</label>
                            <textarea class="form-control" id="description" name="description" rows="8" placeholder="{{ $book->description }}"></textarea>
                        </div>
                        <div class="form-group">
                            <strong>Book image</strong>
                            @if($book->image)
                             <img  src="{{ URL::asset($book->image) }}" alt="products"  class="p-2" width="200px" height="200px">
                            @endif
                            <input type="text" name="image" class="form-control" placeholder="" value="{{ $book->image }}">
                        </div>
                        <div class="form-group">
                            <label for="genre">Book genre</label>
                            <input type="text" class="form-control" name="genre" value="{{ $book->genre }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
