<?php

namespace App\Policies;

use App\Group;
use App\User;
use Hash;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Define an override for admin
     *
     * @param \App\User $user
     * @param string $ability
     * @return boolean
     */
    public function before(User $user, string $ability)
    {
        if ($user->admin) return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\Group $group
     * @param string|null $password
     * @return mixed
     */
    public function update(User $user, Group $group, $password)
    {
        return ($group->owner_id === $user->id || Hash::check((string) $password, $group->passwd));
    }
}
