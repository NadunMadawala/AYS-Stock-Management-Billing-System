<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CS_Combination extends Model
{

    use HasFactory;

    protected $table = 'clothes_sizes_combination';
    public $primaryKey = 'id';
    protected $fillable = ['cloth_id', 'size_id', 'quantity', 'created_at','updated_at'];

    /**
     * Relationship with Mattress.
     * Assuming a many-to-many relationship between chemicals and mattresses
     * via a pivot table (e.g., `chemical_mattress`).
     */
    public function cloth()
    {
        return $this->belongsToMany(CS_Cloths::class, 'clothes_sizes_combination', 'size_id', 'cloth_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
