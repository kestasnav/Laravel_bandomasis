<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzsakymai extends Model
{
    use HasFactory;

    protected $table='uzsakymai';

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function hotels() {
        return $this->belongsTo(Hotel::class);
    }
}
