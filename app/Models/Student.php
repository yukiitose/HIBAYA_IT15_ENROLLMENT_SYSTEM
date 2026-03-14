<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
    use HasFactory;
    protected $fillable = [
        'student_id','first_name','last_name','email','gender',
        'birth_date','address','department','course','year_level',
        'enrollment_status','enrollment_date',
    ];
    protected $casts = [
        'birth_date' => 'date',
        'enrollment_date' => 'date',
    ];
}