<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReadingActivity extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_activity';

    protected $table = 'reading_activities';

    protected $fillable = [

        'user_id',

        'book_id',

        'last_page',

        'started_at',

        'finished_at'

    ];
}
