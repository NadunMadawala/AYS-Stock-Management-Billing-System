<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CS_Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    public $primaryKey = 'id';
    protected $fillable = ['bill_id', 'item_id', 'price', 'quantity','discount','total','created_at','updated_at'];

}
