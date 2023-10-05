<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public $table ="cursos";
    protected $fillabe = array("*");

    public function estudiastes(){


        return $this->belongsToMany(Estudiante::class,"_curso__estudiante");
    }


}
