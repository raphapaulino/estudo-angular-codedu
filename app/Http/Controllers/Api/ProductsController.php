<?php

namespace App\Http\Controllers\Api;

use App\Common\OnlyTrashed;
use App\Http\Controllers\Controller;
use App\Http\Requests\Angular\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use OnlyTrashed;

    protected $product;
    protected $tenant;

    public function __construct(

    ) {
        \Tenant::setTenant(Company::find(1));
        $this->tenant = \Tenant::getTenant();
    }

    public function index(Request $request)
    {
        $query = Product::query();
        $query = $this->onlyTrashedIfRequested($request, $query);
        // return $query->toSql();
        // dd($query->toSql());
        $products = $query->paginate(5);
        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all() + ['company_id' => $this->tenant->id]);
        $product->refresh(); // se não atualizar, o campo is_active não é retornado
        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product = $product->fill($request->all() + ['company_id' => $this->tenant->id]);
        $product->save();
        return new ProductResource($product);
        // return response([], 204);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([], 204);
    }

    public function restore(Product $product)
    {
        $product->restore();
        return response()->json([], 204);
    }
}
