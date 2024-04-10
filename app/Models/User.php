<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'group_id'
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
