<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'category_name',
    ];


    // one to one relation  [getting the user name from user-table fro category table]
    public function user()
    {
        // learn by Youtube
        return $this->belongsTo(User::class);

        // learn by Udemy
        // return $this->hasOne(User::class, "id", "user_id");
    }
}
