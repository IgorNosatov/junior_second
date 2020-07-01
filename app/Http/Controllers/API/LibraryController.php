<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\LibraryRepository;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected $libraryRepository;

    public function __construct(LibraryRepository $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
    }

    /**
     * @OA\Get(
     *     path="/library",
     *     operationId="booksAll",
     *     tags={"Book API"},
     *     summary="Display list of the books",
     *     @OA\Parameter(
     *         description="Search by book title or author name",
     *         in="query",
     *         name="search",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Order by column",
     *         in="query",
     *         name="order_by",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Sort by asc/desc",
     *         in="query",
     *         name="sort by",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Show books by genre",
     *         in="query",
     *         name="genre",
     *         required=false,
     *         @OA\Schema(
     *           type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Paginate the data",
     *         in="query",
     *         name="is_paginate",
     *         @OA\Schema(
     *           type="string",
     *           enum={"true", "false"},
     *           default="true"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine"
     *     ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = $this->libraryRepository->allBooks($request);
        return  $books;
    }

    /**
     * @OA\Post(
     *     path="/library/store",
     *     operationId="createBook",
     *     tags={"Book API"},
     *     summary="Book create",
     *     description="API for creating Book",
     *     operationId="store",
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="image",
     *                   description="image",
     *                   type="string",
     *                   format="binary",
     *               ),
     *               @OA\Property(
     *                   property="title",
     *                   description="book title",
     *                   type="string",
     *               ),
     *                   @OA\Property(
     *                   property="author",
     *                   description="book author",
     *                   type="string",
     *               ),
     *                   @OA\Property(
     *                   property="description",
     *                   description="book description",
     *                   type="string",
     *               ),
     *                   @OA\Property(
     *                   property="genre",
     *                   description="genre",
     *                   type="string",
     *               ),
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success creating data",
     *     ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function store(BookRequest $request)
    {
        $book = $this->libraryRepository->storeBook($request);
        return  $book;
    }


    /**
     * @OA\Get(
     *     path="/library/edit/{id}",
     *     operationId="editBook",
     *     tags={"Book API"},
     *     summary="Edit book",
     *     @OA\Parameter(
     *         description="Book ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success update data",
     *     ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     */

    public function edit($id)
    {
        $book = $this->libraryRepository->editBook($id);
        return  $book;
    }

        /**
     * @OA\Patch(
     *     path="/library/{id}/update",
     *     operationId="updateBook",
     *     tags={"Book API"},
     *     summary="Update book",
     *     description="Update Book",
     *     @OA\Parameter(
     *          name="id",
     *          description="Project id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="image",
     *                   description="image",
     *                   type="string",
     *                   format="binary",
     *                   example="1.jpeg",
     *               ),
     *               @OA\Property(
     *                   property="title",
     *                   description="book title",
     *                   type="string",
     *                   example="book title",
     *               ),
     *                   @OA\Property(
     *                   property="author",
     *                   description="book author",
     *                   type="string",
     *                   example="book author",
     *               ),
     *                   @OA\Property(
     *                   property="description",
     *                   description="book description",
     *                   type="string",
     *                   example="book description",
     *               ),
     *                   @OA\Property(
     *                   property="genre",
     *                   description="genre",
     *                   type="string",
     *                   example="novel",
     *               ),
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success creating data",
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid request data",
     *     )
     * )
     */
    public function update($id, BookRequest $request)
    {
        $book = $this->libraryRepository->updateBook($request, $id);
        return  $book;
    }

    /**
     * @OA\Delete(
     *     path="/library/delete/{id}",
     *     operationId="deleteBook",
     *     tags={"Book API"},
     *     summary="Delete book",
     *     @OA\Parameter(
     *         description="Book ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success deleting data",
     *     ),
     * 
    *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     *
     */
    public function destroy($id)
    {
        $book = $this->libraryRepository->deleteBook($id);
        return  $book;
    }
}
