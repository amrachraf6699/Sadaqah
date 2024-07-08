<?php

namespace App\Policies;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DonationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Donation $donation): bool
    {
        return $user->id === $donation->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Donation $donation): bool
    {
        return $user->id === $donation->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Donation $donation): bool
    {
        return $user->id === $donation->user_id;
    }
    
}