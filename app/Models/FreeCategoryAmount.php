<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeCategoryAmount extends Model
{
    use HasFactory;

    public function fee_category(){
        return $this->belongsTo(FreeCategory::class,'fee_category_id', 'id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id', 'id');
    }

}
