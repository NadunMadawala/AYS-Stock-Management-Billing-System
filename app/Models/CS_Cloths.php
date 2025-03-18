<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CS_Cloths extends Model
{
    use HasFactory;

    protected $table = 'cloths';
    public $primaryKey = 'id';
    protected $fillable = ['item_name', 'color_id','description', 'category_id','created_at','updated_at'];

    // Define the correct relationship with CS_ClothesSizes
    public function size()
    {
        return $this->belongsToMany(CS_ClothesSizes::class, 'clothes_sizes_combination', 'cloth_id', 'size_id')
            ->withPivot('quantity'); // Include the pivot column (quantity)
    }
}
