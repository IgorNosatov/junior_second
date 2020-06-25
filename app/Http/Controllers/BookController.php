<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;

class BookController extends Controller
{

    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->middleware(['auth','verified']);
        $this->bookRepository = $bookRepository;
    }

    public function createBook()
    {
        return view('pages.create_book');
    }


    public function storeBook(Request $request)
    {
        $book = $this->bookRepository->storeBook($request);
        return  $book;
    }


    public function editBook($id)
    {
        //
    }

    public function updateBook(Request $request, $id)
    {

    }


    public function destroyBook($id)
    {
        //
    }
}
