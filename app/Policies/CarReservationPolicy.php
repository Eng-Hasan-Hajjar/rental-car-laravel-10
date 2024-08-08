<?php

namespace App\Policies;

use App\Models\CarReservation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarReservationPolicy
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
    public function view(User $user, CarReservation $carReservation): bool
    {
        return $user->id === $carReservation->user_id || $user->can('isEmployee') || $user->can('isAdmin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CarReservation $carReservation): bool
    {
        return $user->id === $carReservation->user_id || $user->can('isEmployee') || $user->can('isAdmin');

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CarReservation $carReservation): bool
    {
        return $user->id === $carReservation->user_id || $user->can('isEmployee') || $user->can('isAdmin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CarReservation $carReservation): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CarReservation $carReservation): bool
    {
        //
    }
    public function approve(User $user, CarReservation $carReservation)
    {
        return $user->id === $carReservation->user_id || $user->can('isEmployee') || $user->can('isAdmin');
    }

}
