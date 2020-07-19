<?php

namespace App\Repositories;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename().'.'.$extension, File::get($cover));
    
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->image = $cover->getFilename().'.'.$extension;
        $book->genre = $request->genre;
        $book->save();
    
        return redirect()->route('home')
            ->with('success', 'Book added successfully...');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        return view('pages.edit_book', compact('book'));
    }

    public function updateBook(BookRequest $request, $id)
    {
        $book = [
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'genre' => $request->genre
         ];
 
        if ($files = $request->file('image')) {
            $destinationPath = 'uploads/';
            $extension = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $extension);
            $book['image'] = "$extension";
        }
         
        $book['title'] = $request->get('title');
        $book['author'] = $request->get('author');
        $book['description'] = $request->get('description');
        $book['genre'] = $request->get('genre');
 
        Book::where('id', $id)->update($book);
   
        return redirect()->route('home')->with('success', 'Book updated successfully...');
    }

    public function deleteBook($id)
    {
        $data = Book::where('id', $id);
        $data->delete();
        return redirect()->route('home');
    }
}
