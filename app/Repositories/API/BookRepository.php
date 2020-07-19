<?php

namespace App\Repositories\API;

use App\Book;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BookRepository
{
    public function allBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(33);
        return response()->json($books);
    }

    public function storeBook(Request $request)
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
    
        return response()->json('The book successfully added');
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
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
   
        return response()->json('The book successfully added');
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json('The book successfully deleted');
    }
}
