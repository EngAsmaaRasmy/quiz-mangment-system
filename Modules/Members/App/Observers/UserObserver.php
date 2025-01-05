<?php

namespace Modules\Members\App\Observers;

use Modules\Members\App\Models\User;

class UserObserver
{
    /**
     * Handle the UserObserver "created" event.
     */
    public function creating(User $user): void
    {
        if ($user->type === 'admin') {
            $user->assignRole('admin');
        } elseif ($user->type === 'member') {
            $user->assignRole('member');
        }
    }

    /**
     * @param User $user
     * 
     * @return void
     */
    public function updating(User $user): void
    {
        if ($user->isDirty('type')) {
            $user->syncRoles([]);

            if ($user->type === 'admin') {
                $user->assignRole('admin');
            } elseif ($user->type === 'member') {
                $user->assignRole('member');
            }
        }
    }
}
