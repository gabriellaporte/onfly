<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

/*
|--------------------------------------------------------------------------
| UserPolicy - ACL para o model User (usuários)
|--------------------------------------------------------------------------
|
| Esta Policy controla o acesso aos recursos do model User, sendo
| limitados aos próprios usuários.
|
*/

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $userToSee): bool
    {
        return $user->id == $userToSee->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $userToSee): bool
    {
        return $user->id == $expense->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $userToSee): bool
    {
        return $user->id == $expense->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $userToSee): bool
    {
        return $user->id == $expense->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->id == $expense->user_id;
    }
}
