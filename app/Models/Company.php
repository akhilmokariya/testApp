<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    public $timestamps = true;

    protected $fillable = ['name','email','website','contact_number','address','pincode','logo'];

    /**
     * Get the employee associated with the company.
     */
    public function employee()
    {
        return $this->hasOne(Employee::class,'company_id');
    }


}
