<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public function scopefilter($query, $countryId)
    {
        if ($countryId) {
            return $query->where('country_id', $countryId);
        }

        return $query;
    }
    public function scopefindPosts($query, $find) {

        if($find) {
            return $query->where('hotel_name','like',"%$find%");
        } else {
            return $query;
        }
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
