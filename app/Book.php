<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    const TABLE_NAME = 'books';
    const ID = 'id';
    const TITLE = 'title';
    const AUTHOR = 'author';
    const DESCRIPTION = 'description';
    const IMAGE = 'image';
    const GENRE = 'genre';
    
    const CURRENT_PAGE='current_page';
    const DATA = 'data';
    const FIRST_PAGE_URL = "first_page_url";
    const FROM ="from" ;
    const LAST_PAGE ="last_page";
    const LAST_PAGE_URL ="last_page_url";
    const NEXT_PAGE_URL ="next_page_url";
    const PATH ="path";
    const PER_PAGE ="per_page";
    const PREV_PAGE_URL ="prev_page_url";
    const TO ="to";
    const TOTAL ="total";

    protected $fillable = [
        'title', 'author', 'description','image','genre'
       ];
}
