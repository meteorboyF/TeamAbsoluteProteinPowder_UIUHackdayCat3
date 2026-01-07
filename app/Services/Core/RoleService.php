<?php

namespace App\Services\Core;

use App\Models\User;

class RoleService extends BaseService
{
    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';
    public const ROLE_MANAGER = 'manager';

    /**
     * Assign a role to a user.
     */
    public function assignRole(User $user, string $role): User
    {
        $roles = $user->roles ?? [];
        if (!in_array($role, $roles)) {
            $roles[] = $role;
            $user->roles = $roles;
            $user->save();
        }
        return $user;
    }

    /**
     * Remove a role from a user.
     */
    public function removeRole(User $user, string $role): User
    {
        $roles = $user->roles ?? [];
        $roles = array_filter($roles, fn($r) => $r !== $role);
        $user->roles = array_values($roles);
        $user->save();

        return $user;
    }

    /**
     * Check if user has a role (helper wrapper).
     */
    public function hasRole(User $user, string $role): bool
    {
        return $user->hasRole($role);
    }
}
