<?php

namespace App\Repositories;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;

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


    public function storeBook(BookRequest $request)
    {
        if ($files = $request->file('image')) {
           $destinationPath = 'image/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $insert['image'] = "$profileImage";
        }
         
        $insert['title'] = $request->get('title');
        $insert['author'] = $request->get('author');
        $insert['description'] = $request->get('description');
        $insert['genre'] = $request->get('genre');
 
        Book::insert($request->except(['_token']));
    
        return redirect('/')->with('success', 'book has been added');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        return view('pages.edit_book', compact('book'));
    }

    public function updateBook(BookRequest $request, $id)
    {

        if ($files = $request->file('image')) {
           $destinationPath = 'image/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $book['image'] = "$profileImage";
        }
         
        $book = Book::findOrFail($id);
        $book->title =  $request->get('title');
        $book->author = $request->get('author');
        $book->description = $request->get('description');
        $book->image = $request->get('image');
        $book->genre = $request->get('genre');
        $book->save();
   
        return redirect('/')->with('success', 'book updated!');
    }

    public function deleteBook($id)
    {
        $data = Book::where('id', $id);
        $data->delete();

        return redirect('/')->with('success', 'Book is deleted');
    }

    
}
