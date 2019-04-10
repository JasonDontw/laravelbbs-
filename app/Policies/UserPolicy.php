<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $currentUser, User $user) //update方法接收兩個參數，第一個參數默認為當前登錄用戶實例，第二個參數則為要進行授權的用戶實例。
    {
        return $currentUser->id === $user->id;
    }
}
