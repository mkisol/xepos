<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['first_name', 'last_name', 'company', 'email', 'phone'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['first_name' => 'string', 'last_name' => 'string', 'email' => 'string', 'phone' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    
	
	public function company()
	{
		return $this->belongsTo(\App\Models\Company::class);
	}
}
