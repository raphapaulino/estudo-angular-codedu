<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductOutput
 *
 * @property int $id
 * @property int $amount
 * @property int $product_id
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductOutput whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductOutput extends Model
{
    protected $fillable = ['amount', 'product_id', 'company_id'];

    // many-to-one
    public function product() 
    {
        // return $this->belongsTo(Product::class);
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
