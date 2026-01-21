<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobPolicy
{
    public function before(User $user, $ability)
    {
        if ($user->role === 'superadmin') {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return in_array($user->role, ['superadmin', 'employer']);
    }

    public function update(User $user, Job $job)
    {
        if ($user->role === 'superadmin') {
            return true;
        }

        return $user->id === $job->created_by_id;
    }

    public function delete(User $user, Job $job)
    {
        if ($user->role === 'superadmin') {
            return true;
        }
        
        return $user->id === $job->created_by_id;
    }
}
