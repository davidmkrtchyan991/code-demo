<?php

namespace App;

use App\Classes\enums\RoleEnum;
use App\Traits\auth\UserSearchHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use UserSearchHelper;

    protected $visible = ['id', 'name', 'surname', 'father_name', 'email'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'father_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn("name", $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where("name", $role)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasNotRole($role)
    {
        return null == $this->hasRole($role);
    }

    public function isAdministrator()
    {
        return $this->hasRole(RoleEnum::ROLE_ADMINISTRATOR) != null;
    }

    public function isTechManager()
    {
        return $this->hasRole(RoleEnum::ROLE_TECHNICAL_MANAGER) != null;
    }

    public function isOptimizer()
    {
        return $this->hasRole(RoleEnum::ROLE_OPTIMIZER) != null;
    }

    public function isClient()
    {
        return $this->hasRole(RoleEnum::ROLE_CLIENT) != null;
    }

    public function getCurrentRole()
    {
        return $this->roles()->first();
    }

    /*Scopes*/

    public function scopeExisting($query)
    {
        return $query->whereNotNull('id');
    }

    public function scopeClients($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', RoleEnum::ROLE_CLIENT);
        });
    }

    public function scopeOptimizers($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', RoleEnum::ROLE_OPTIMIZER);
        });
    }

    public function scopeTechManagers($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', RoleEnum::ROLE_TECHNICAL_MANAGER);
        });
    }

    public function scopeOptimizer($query, $id)
    {
        $this->optimizers($query);
        return $query->where('id', $id);
    }

    public function scopeWithName($query, $name)
    {
        return $query->where('name', $name);
    }

    public function scopeWithSurname($query, $surname)
    {
        return $query->where('surname', $surname);
    }

    public function scopeWithEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeWithRole($query, $roleId)
    {
        return $query->whereHas('roles', function ($q) use ($roleId) {
            $q->where('roles.id', $roleId);
        });
    }
}
