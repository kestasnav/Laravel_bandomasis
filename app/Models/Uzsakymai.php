<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzsakymai extends Model
{
    use HasFactory;

    protected $table='uzsakymai';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function hotel() {
        return $this->belongsTo(Hotel::class);
    }
}
