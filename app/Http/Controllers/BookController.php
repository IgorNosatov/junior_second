<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->middleware(['auth','verified']);
        $this->bookRepository = $bookRepository;
    }

    public function create()
    {
        return view('pages.create_book');
    }

    public function store(BookRequest $request)
    {
        $book = $this->bookRepository->storeBook($request);
        return  $book;
    }

    public function edit($id)
    {
        $book = $this->bookRepository->editBook($id);
        return  $book;
    }

    public function update(BookRequest $request, $id)
    {
        $book = $this->bookRepository->updateBook($request, $id);
        return  $book;
    }

    public function destroy($id)
    {
        $book = $this->bookRepository->deleteBook($id);
        return  $book;
    }
}
