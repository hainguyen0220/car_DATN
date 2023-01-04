<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UpdateMessageTrait;
use App\Http\Controllers\UploadImageControllerTrait;
use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\UserInfo;
use Throwable;

class AccountController extends Controller
{
    use UpdateMessageTrait;
    use UploadImageControllerTrait;
    public function info($id)
    {
        $account = Account::getAccountById($id);
        $info = $account->user_info;
        return view('user.account.info_save')->with(compact('account', 'info'));
    }

    public function showResetPassword($id)
    {

        $password2 = Account::find($id)->password2;

        return view('user.account.reset_password', ['id' => $id])->with(compact('password2'));
    }

    public function showCreatePassword2($id)
    {

        $password2 = Account::find($id)->password2;

        return view('user.account.create_password_2', ['id' => $id])->with(compact('password2'));
    }

    public function updateInfo(AccountRequest $request)
    {
        $id =  session('user')->id ?? '';
        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }

        $request->validate(
            [
                'username' => 'required|min:8|max:255|unique:accounts,username,' . $id,
                'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'dob' => 'before:today'
            ],
            [
                'dob.before' => 'Ngày không hợp lệ',
            ]
        );




        $account = Account::find($id);

        if ($request->hasFile('avatar')) {
            $image = $request->avatar;
            $image = $this->upload($image, 'account', 'account');
            $this->deleteImage($account->user_info->avatar, 'account');
        }

        $image  = $image ?? $account->user_info->avatar;

        try {

            Account::where('id', $id)->update([
                'username' => $request->username,
            ]);

            UserInfo::where('account_id', $id)->update([
                'full_name' => $request->fullname,
                'avatar' => $image,
                'dob' => $request->dob,
                'address' => $request->address
            ]);

            $account_new = Account::find($id);

            $this->updateSuccessMessage($request, __('message.update-successful'));

            $request->session()->put('admin',  $account_new);
            $request->session()->put('info',  $account_new->user_info);

            return back();
        } catch (Throwable $e) {
            $this->updateFailMessage($request, __('message.update-fail'));

            return back()->with([
                'account' => $account,
                'info' => $account->user_info,
            ]);
        }
    }
}
