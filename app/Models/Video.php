<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title', 'file', 'metadata', 'converted_file', 'is_converted'
  	];

  	/**
     * Scope a query to only include converted videos.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConverted($query)
    {
        return $query->where('is_converted', true);
    }
}
