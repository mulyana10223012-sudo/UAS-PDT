<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_book';

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'publication_year',
        'isbn',
        'cover_image',
        'file_path',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
