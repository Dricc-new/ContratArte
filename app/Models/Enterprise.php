<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;

    protected $table = 'enterprises';
    protected $fillable = [
        'id',
        'reeup',
        'name',
        'email',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
