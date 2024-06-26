<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}
