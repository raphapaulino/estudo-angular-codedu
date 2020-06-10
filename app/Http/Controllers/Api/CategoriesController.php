<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Angular\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $category;
    protected $tenant;

    public function __construct(

    ) {
        \Tenant::setTenant(Company::find(1));
        $this->tenant = \Tenant::getTenant();
    }

    public function index(Request $request)
    {
        /** @var CategoryFilter $filter */
        // $filter = app(\App\Http\Filters\CategoryFilter::class);
        /** @var Builder $filterQuery */
        // $filterQuery = Category::filtered($filter);
        // // $categories = $filterQuery->get(); 
        // // $categories = $request->has('all') ? $filterQuery->get() : $filterQuery->paginate(5);

        // $request->all();
        // return $request->all();
        // dd($request->all());
        $where = [];
        $orderByField = 'id';
        // if (isset($request->id)) {
        //     // $where[] = ['id', 'like', "%$request->id%"];
        //     $orderByField = 'id';
        // }
        
        // if (isset($request->name)) {
        //     // $where[] = ['name', 'like', "%$request->name%"];
        //     $orderByField = 'name';
        // }

        $mystring = $request->sort;
        $findme   = '-';
        $pos      = strpos($mystring, $findme);
        $sortBy   = ($pos === false) ? 'asc' : 'desc';
        
        if (isset($request->sort)) {
            $sortArr = explode("-", $request->sort);
            $result = end($sortArr);
        }

        if (isset($request->search)) {
            $where[] = ['name', 'like', "%$request->search%"];
            $orderByField = 'name';
        }

        if (isset($request->sort)) {
            // $where[] = ['name', 'like', "%$request->sort%"];
            $orderByField = $result;
        }

        if (isset($request->created_at)) {
            // $where[] = ['created_at', 'like', "%$request->created_at%"];
            $orderByField = 'created_at';
        }

        $categories = $request->has('all') 
            ? Category::where($where)->orderBy($orderByField, $sortBy)->get() 
            : Category::where($where)->orderBy($orderByField, $sortBy)
                // ->toSql();
                ->paginate(5); 
        \Log::info($categories);
        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all() + ['company_id' => $this->tenant->id]);
        $category->refresh(); // se não atualizar, o campo is_active não é retornado
        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category = $category->fill($request->all() + ['company_id' => $this->tenant->id]);
        $category->save();
        return new CategoryResource($category);
        // return response([], 204);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([], 204);
    }
}
