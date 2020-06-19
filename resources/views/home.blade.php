<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Library - @yield('title')</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">

                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Books</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Users</a>
                            </li>

                        </ul>
                    </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md">
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
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
