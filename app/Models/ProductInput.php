<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductInput
 *
 * @property int $id
 * @property int $amount
 * @property int $product_id
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductInput whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductInput extends Model
{
    protected $fillable = ['amount', 'product_id', 'company_id'];

    // many-to-one
    public function product() 
    {
        // return $this->belongsTo(Product::class);
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
