<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user) //$user會自動去抓路由的{user}去資料庫跟id匹配然後取出
    {
        
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)//UserRequest $request會驗證傳入的request若不符合會跳轉回原本的頁面
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id,416);
            if ($result) {   //以下代碼處理了圖片上傳的邏輯，注意if ($result)的判斷是因為ImageUploadHandler對文件後綴名做了限定，不允許的情況下將返回false
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '個人資料更新成功！');

    }
}
