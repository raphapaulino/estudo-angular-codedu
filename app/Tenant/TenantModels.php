<?php

namespace App\Tenant;

use Illuminate\Database\Eloquent\Model;

trait TenantModels
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope);

        static::creating(function (Model $obj) {
            $tenantObj = \Tenant::getTenant();
            if ($tenantObj) {
                $obj->{\Tenant::getTenantField()} = $tenantObj->id;
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(\Tenant::getTenantModel(), \Tenant::getTenantField());
    }
}