<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDetails extends Model
{
    use HasFactory;

    public $table = "form-details";
    
    public $fillable = ['form_id','form_field_id','fieldname','fieldtype','fieldlabel'];
}
