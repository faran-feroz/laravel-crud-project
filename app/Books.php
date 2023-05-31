<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'author', 'isbn', 'price'];

    public static function rules()
    {
        return [
            'book_title' => 'required',
            'book_isbn' => 'nullable|min:13',
            'book_price' => 'required|numeric'
        ];
    }
}
