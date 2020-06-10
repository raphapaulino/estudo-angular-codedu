<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductOutputRequest;
use App\Http\Resources\ProductInputResource;
use App\Http\Resources\ProductOutputResource;
use App\Models\ProductOutput;
use Illuminate\Http\Request;

class ProductOutputsController extends Controller
{
    public function index()
    {
        $outputs = ProductOutput::with('product')->paginate();
        return ProductOutputResource::collection($outputs);
    }

    public function store(ProductOutputRequest $request)
    {
        $output = ProductOutput::create($request->all());
        return new ProductInputResource($output);
    }

    public function show(ProductOutput $output)
    {
        return new ProductInputResource($output);
    }
}
