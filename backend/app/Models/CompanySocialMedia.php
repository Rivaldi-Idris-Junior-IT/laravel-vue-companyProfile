<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySocialMedia extends Model
{
    use HasFactory;

             /**
     * fillable
     *
     * @var array
     */

     protected $fillable = [
        'name','slug','image','slug','link'
    ];

    /**
     * image
     *
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/socialmedia/' . $value),
        );
    }

    /**
     * company
     *
     * @return void
     */
    public function company()
    {
        return $this->hasMany(Company::class);
    }
}
