<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'address',
        'instagram',
        'whatsapp',
        'website',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'place_id')->with('user')->orderBy('created_at', 'desc');
    }

}
