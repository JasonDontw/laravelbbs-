<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function before($user, $ability)
	{
	   // 如果用户拥有管理内容的权限的话，即授权通过，如果沒有則使用該POLICY裡面的授權
       if ($user->can('manage_contents')) {
        return true;
    }
	}
}
