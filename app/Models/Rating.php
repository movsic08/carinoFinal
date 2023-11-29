<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'rating', 'comment'];

    public function staff()
    {
        return $this->belongsTo(User::class);
    }
}
