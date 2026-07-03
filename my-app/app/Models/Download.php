<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Download extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_activity';

    protected $table = 'downloads';

    protected $fillable = [
        'user_id',
        'book_id',
        'downloaded_at',
    ];
}
