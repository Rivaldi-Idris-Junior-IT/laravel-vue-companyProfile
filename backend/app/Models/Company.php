<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

     /**
     * fillable
     *
     * @var array
     */

     protected $fillable = [
        'name','email_company','slug','about','address','phone','owner_id','company_service_id','company_social_media_id'
    ];

    /**
     * owner
     *
     * @return void
     */

     public function owner()
     {
         return $this->belongsTo(Owner::class);
     }

     /**
     * companyservice
     *
     * @return void
     */

     public function companyservice()
     {
         return $this->belongsTo(CompanyService::class);
     }

     /**
     * companysocial
     *
     * @return void
     */

     public function companysocialmedia()
     {
         return $this->belongsTo(CompanySocialMedia::class);
     }


}
