<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Todo extends Model
{
    use SoftDeletes , HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->BelongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
