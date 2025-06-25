<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $primaryKey = 'variant_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'color',
        'size',
        'stock_quantity',
        'price_modifier',
        'image_url_specific'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
