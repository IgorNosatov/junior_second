<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;

class HomeController extends Controller 
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->middleware(['auth','verified']);
        $this->bookRepository = $bookRepository;
    }

    public function index(Request $request)
    {
        $books = $this->bookRepository->allBooks($request);
        return  $books;
    }
}