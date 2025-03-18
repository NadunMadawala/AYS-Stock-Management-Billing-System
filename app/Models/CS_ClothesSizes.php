<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CS_ClothesSizes extends Model
{
    use HasFactory;

    protected $table = 'sizes';
    public $primaryKey = 'id';
    protected $fillable = ['gender', 'region', 'numeric_sizes','alpha_sizes','common_formats'];

    // Define the correct relationship with CS_Cloths
    public function cloth()
    {
        return $this->belongsToMany(CS_Cloths::class, 'clothes_sizes_combination', 'cloth_id', 'size_id')
            ->withPivot('quantity'); // Include the pivot column (quantity)
    }

}
