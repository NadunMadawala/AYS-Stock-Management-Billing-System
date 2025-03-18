<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CS_BillDetails extends Model
{

    use HasFactory;

    protected $table = 'bill_details';
    public $primaryKey = 'id';
    protected $fillable = ['payment_method', 'amount_received','grand_total','created_at','updated_at'];

}
