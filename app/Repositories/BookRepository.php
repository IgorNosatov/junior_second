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
            $books->orderBy('title', $request->query('orderBy'));
        }
        if ($request->has('sortBy')) {
            $books->orderBy( $request->query('sortBy'));
        }
        if ($request->has('perPage')) {
            $perPage = $request->query('perPage');
        }

        return $books->paginate($perPage);
    }

    public function showBooks()
    {
        return Book::orderBy('created_at', 'desc')->paginate(25);
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
        return $book->save();
    }

    public function editBook($id)
    {
        return Book::findOrFail($id);
    }

    public function updateBook(BookRequest $request, $id)
    {
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
 
        return Book::where('id', $id)->update($book);
    }

    public function deleteBook($id)
    {
        return Book::where('id', $id)->delete();
    }
}
