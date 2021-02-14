<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'domain'
    ];

    /**
     * Get all of the users that belong to the store.
     */
    public function users()
    {
        return $this->belongsToMany(
            'App\Models\User', 'store_users', 'store_id', 'user_id'
        );
    }
}
