<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin
 *
 * @property User $user
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Admin extends Model
{
    public static function createUserAndTenant(array $attributes)
    {
        $admin = self::createUser($attributes);
        $userTenant = UserTenant::create([]);
        $user = $admin->user; // como é coleção encapsulada por mutator em Admin, pegamos a 1ª posição apenas
        $userTenant->users()->sync($user->id);
        return ['admin' => $admin, 'user_tenant' => $userTenant];
    }

    public static function createUser(array $attributes) 
    {
        $admin = self::create([]);
        $admin->users()->create($attributes['user']);
        return $admin;
    }

    // public function user() 
    // {
    //     return $this->morphOne(User::class, 'userable');
    // }

    // permite a possibilidade de se usar $admin->user
    public function getUserAttribute() 
    {
        return $this->users->first();
    }

    public function users() 
    {
        return $this->morphToMany(User::class, 'userable');
    }
}
