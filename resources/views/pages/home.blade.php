@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-12">
        <form action="/">
            <div class="form-group">
                <label for="exampleInputEmail1">Search book:</label>
                <input type="search" name="search" class="form-control pb-1" placeholder="Enter book name .....">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Sort by:</label>
                <select name="sortBy" id="sortBy" class="form-control form-control-sm" value="{{ $sortBy }}">
                    @foreach(['id', 'title', 'author'] as $col)
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
            <div class="form-group">
                <label for="genre">Filter by genre:</label>
                <select name="genre" id="genre" class="btn btn-primary">
                    <option value="adventure" {{ request()->genre == 'adventure' ? 'selected' : ''}}>Adventure</option>
                    <option value="novel" {{ request()->genre == 'novel' ? 'selected' : ''}}>Novel</option>
                    <option value="classics" {{ request()->genre == 'classics' ? 'selected' : ''}}>Classics</option>
                    <option value="detective" {{ request()->genre == 'detective' ? 'selected' : ''}}>Detective</option>
                    <option value="fantastic" {{ request()->genre == 'fantastic' ? 'selected' : ''}}>Fantastic</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/" class="btn btn-primary">Reset</a>
        </form>
    </div>
    <div class="col-md-9 col-sm-12">
        @foreach ($books as $book)
        <div class="card mb-3" style="max-width: 1000px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ asset($book['image']) }}" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title">Book Name:{{ $book->title }}</h3>
                        <h5>Book Author:{{ $book->author }}</h5>
                        <p class="card-text">Book Genre:{{ $book->genre }}</p>
                        <p class="card-text">{{ $book->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{ $books->links() }}
    </div>
</div>
@endsection