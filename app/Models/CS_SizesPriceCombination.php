<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CS_SizesPriceCombination extends Model
{
    use HasFactory;

    protected $table = 'clothes_sizes_price_combination';
    public $primaryKey = 'id';
    protected $fillable = ['combination_id', 'purchase_price', 'selling_price', 'created_at','updated_at'];

}
