<?php

namespace App\Models;

use App\Tenant\TenantModels;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserTenant
 *
 * @property User $user
 * @property int $id
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $tenant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTenant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTenant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTenant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTenant whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTenant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTenant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserTenant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserTenant extends Model
{
    use TenantModels;
    
    public static function createUser(array $attributes): UserTenant
    {
        $userTenant = self::create([]);
        $userTenant->users()->create($attributes['user']);
        return $userTenant;
    }

    // public function user() 
    // {
    //     return $this->morphOne(User::class, 'userable');
    // }

    // permite a possibilidade de se usar $userTenant->user
    public function getUserAttribute() 
    {
        return $this->users->first();
    }

    public function users() 
    {
        return $this->morphToMany(User::class, 'userable');
    }
}
