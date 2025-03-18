<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CS_Colors extends Model
{
    use HasFactory;

    protected $table = 'colors';
    public $primaryKey = 'id';
    protected $fillable = ['color_name', 'color_code'];

}
