<?php

namespace App\Policies;

use App\Models\User;
use App\Models\course;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.course_list'));

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.course_add'));

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->checkPermissionAccess(config('permissions.access.course_delete'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, course $course): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, course $course): bool
    {
        //
    }
}
