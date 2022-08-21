<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected  $fillable = ['name', 'description', 'size', 'maximum_occupancy', 'price'];
    protected  $guarded = ['photo']; 

    public function amenities(){
        return $this->belongsToMany('\App\Models\Amenity','room_amenity','room_id','amenity_id');
    }

    public function reservation(){
        return $this->hasOne(Reservation::class);
    }
}
