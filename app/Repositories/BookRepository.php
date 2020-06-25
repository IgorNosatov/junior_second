<?php

namespace App\Repositories;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Hash;

class BookRepository
{
    public function allBooks(Request $request)
    {
        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 3;

        $books = Book::query();

        if ($request->has('genre')) {
            $books->where('genre', $request->genre);
        }
        if (request()->get('search')) {
            $search = $request->get('search');
            $books->where('title', 'like', '%' . $search . '%')->orWhere('author', 'like', '%' . $search . '%');
        }
        if ($request->has('orderBy')) {
            $orderBy = $request->query('orderBy');
        }
        if ($request->has('sortBy')) {
            $sortBy = $request->query('sortBy');
        }
        if ($request->has('perPage')) {
            $perPage = $request->query('perPage');
        }

        $books = $books
         ->paginate($perPage)
         ->appends('genre', request('genre'))
         ->appends('sortBy', request('sortBy'))
         ->appends('orderBy', request('orderBy'));
         
        return view('pages.home', compact('books', 'sortBy', 'perPage', 'orderBy'));
    }

    public function storeBook(BookRequest $request){
        $data = new Book([
            'name' => $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> Hash::make($request->get('password'))
        ]);
 
        $data->save();
        return redirect('/')->with('success', 'book has been added');
    }

    public function editBook($id)
    {
        $book = Book::find($id);
        return view('pages.edit_book', compact('book'));        
    }

    public function updateBook(BookRequest $request, $id)
    {
        $book = Book::find($id);
        $book->name =  $request->get('name');
        $book->email = $request->get('email');
        $book->password = Hash::make($request->get('password'));
        $book->save();
        return redirect('/')->with('success', 'book updated!');
    }
}
