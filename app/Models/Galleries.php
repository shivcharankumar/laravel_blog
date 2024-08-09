<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Casts\Attribute;

class Galleries extends Model
{
    use HasFactory;

    // public $uploadDirectry = 'storage/auth/posts/';
    public const POST_IMAGE = 1;
    protected $fillable = ['image','type'];

    // public function getImageAttribute() : Attribute
    // {
    //     return Attribute::make(
    //          get: fn ($image) => $this->uploadDirectry.$image
    //   );
    // }
}
