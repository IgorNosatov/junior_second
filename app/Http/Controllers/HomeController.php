<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;

class HomeController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index(Request $request)
    {
        $sortBy = 'asc';
        $orderBy = 'id';
        $perPage = 3;
        $books = $this->bookRepository->allBooks($request);
        return view('pages.home', compact('books', 'sortBy', 'perPage', 'orderBy'));
    }
}
