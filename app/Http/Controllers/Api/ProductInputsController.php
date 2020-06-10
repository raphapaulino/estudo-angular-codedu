<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductInputRequest;
use App\Http\Resources\ProductInputResource;
use App\Models\ProductInput;
use Illuminate\Http\Request;

class ProductInputsController extends Controller
{
    public function index()
    {
        $inputs = ProductInput::with('product')->paginate();
        // $inputs = ProductInput::with('product', 'product.categories')->paginate(); // exemplo de acesso de relacionamento do relacionamento
        return ProductInputResource::collection($inputs);
    }

    public function store(ProductInputRequest $request)
    {
        $input = ProductInput::create($request->all());
        return new ProductInputResource($input);
    }

    public function show(ProductInput $input)
    {
        return new ProductInputResource($input);
    }
}
