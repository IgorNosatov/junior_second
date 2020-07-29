<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function create()
    {
        return view('pages.create_book');
    }

    public function store(BookRequest $request)
    {
        $this->bookRepository->storeBook($request);
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $book = $this->bookRepository->editBook($id);
        return view('pages.edit_book', compact('book'));
    }

    public function update(BookRequest $request, $id)
    {
        $this->bookRepository->updateBook($request, $id);
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        $this->bookRepository->deleteBook($id);
        return redirect()->route('home');
    }
}
