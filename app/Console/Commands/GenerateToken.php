<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateToken extends Command
{
    protected $signature = 'larabbs:generate-token';

    protected $description = '快速為用戶生成 token';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $userId = $this->ask('輸入用戶 id');

        $user = User::find($userId);

        if (!$user) {
            return $this->error('用户不存在');
        }

        // 一年以后过期
        $ttl = 365*24*60;
        $this->info(\Auth::guard('api')->setTTL($ttl)->fromUser($user));
    }
}