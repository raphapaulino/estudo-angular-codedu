<?php

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Database\Schema\Blueprint;

class TenantManager
{
    private $tenant;
    private static $tenantTable = 'companies';
    private static $tenantField = 'company_id';
    private static $tenantModel = Company::class;

    /**
     * Get the value of tenant
     * @return Company
     */ 
    public function getTenant(): ?Company // null or Company
    {
        return $this->tenant;
    }

    /**
     * Set the value of tenant
     *
     * @return Company $tenant
     */ 
    public function setTenant(?Company $tenant): void
    {
        $this->tenant = $tenant;
    }

    /**
     * Get the value of tenantTable
     */ 
    public function getTenantTable(): string
    {
        return self::$tenantTable;
    }

    /**
     * Get the value of tenantField
     */ 
    public function getTenantField(): string
    {
        return self::$tenantField;
    }

    /**
     * Get the value of tenantModel
     */ 
    public function getTenantModel(): string
    {
        return self::$tenantModel;
    }

    public function bluePrintMacros()
    {
        Blueprint::macro('tenant', function () {
            $this->unsignedBigInteger(\Tenant::getTenantField());
            $this->foreign(\Tenant::getTenantField())
                ->references('id')->on(\Tenant::getTenantTable());
        });
    }

    public function ruleExists()
    {
        return "{$this->getTenantField()},{$this->getTenant()->id}";
    }
}