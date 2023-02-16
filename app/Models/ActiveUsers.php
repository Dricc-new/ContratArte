<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveUsers extends Model
{
    use HasFactory;
    protected $table = 'active_users';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'active',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
