<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'sku',
        'price',
        'quantity',
    ];

    public static $rules = [
        'name'          => 'required|min:3',
        'category'      => 'required|numeric|check_category_exist',
        'sku'           => 'required|regex:/^A\d{4}$/|unique:products,sku',
        'price'         => 'required|regex:/^\d+\.\d{2}$/',
        'quantity'      => 'required|numeric',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $primaryKey = 'id';

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
