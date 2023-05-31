<?php

namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::orderBy('id', 'desc')->get();

        return view('list-books', [
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Books::rules());

        if ($validator->fails()) {
            return redirect('create/books')
                ->withErrors($validator)
                ->withInput();
        }

        $book_created = Books::create([
            'title' => $request->get('book_title'),
            'author' => $request->get('book_author'),
            'isbn' => $request->get('book_isbn'),
            'price' => $request->get('book_price'),
        ]);

        if ($book_created) {
            return redirect('/list/books')
                ->with('message', 'Book has been added successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function edit(Books $books, $id)
    {
        $book = $books::findOrFail($id);
        return view('edit-books', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Books  $books
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Books $books)
    {
        $book = $books::findOrFail($request->id);

        $validator = Validator::make($request->all(), Books::rules());

        if ($validator->fails()) {
            return redirect('edit/books/' . $book->id)
                ->withErrors($validator)
                ->withInput();
        }

        $updated = Books::where('id', '=', $book->id)
            ->update([
                'title' => $request->get('book_title'),
                'author' => $request->get('book_author'),
                'isbn' => $request->get('book_isbn'),
                'price' => $request->get('book_price'),
            ]);

        if ($updated) {
            return redirect('list/books')
                ->with('message', 'A book "' . $request->get("book_title") . '" has been edited successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Books $books
     * @param $id
     * @return Response
     */
    public function destroy(Books $books, $id)
    {
        $books = $books::findOrFail($id);
        $deleted = $books->delete($books->id);

        if ($deleted) {
            return redirect()->back()->with('message', 'A book "' . $books->title . '" has been successfully removed');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }
}
