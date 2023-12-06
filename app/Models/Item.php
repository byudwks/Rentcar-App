<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'photos' => 'array'
    ];

    // Get first photo from photos
    public function getThumbnailAttribute()
    {
        // If photos exist
        if ($this->photos) {
            return Storage::url(json_decode($this->photos)[0]);
        }

        return asset('images/default.png');
    }

    public function brand () {
        return $this->belongsTo(Brand::class);
    }
    public function type () {
        return $this->belongsTo(Type::class);
    }
    public function booking () {
        return $this->hasMany(Booking::class);
    }
}
