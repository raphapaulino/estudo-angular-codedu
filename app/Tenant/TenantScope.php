<?php

namespace App\Tenant;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;


class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $tenantObj = \Tenant::getTenant();
        if ($tenantObj) {
            $builder->where(\Tenant::getTenantField(), $tenantObj->id);
        }
    }
}