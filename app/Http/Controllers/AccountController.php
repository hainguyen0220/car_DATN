<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Throwable;


use App\Models\Account;
use App\Models\UserInfo;

use App\Mail\VerifyEmail;
use App\Http\Controllers\UpdateMessageTrait;
use App\Http\Controllers\UploadImageControllerTrait;
use App\Http\Requests\AccountRequest;
use App\Models\Car;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Role;
use App\Models\Slider;

class AccountController extends Controller
{
    use UploadImageControllerTrait;
    use UpdateMessageTrait;

    const ROLE_ADMIN = 2;
    const ROLE_USER = 1;
    const ACCOUNT_ACTIVATED = "active";
    const ACCOUNT_DEACTIVATED = "deactive";
    const ACCOUNT_LOCK = 'lock';
    const DEFAULT_STATUS_SELECT = [
        self::ACCOUNT_ACTIVATED,
        self::ACCOUNT_DEACTIVATED,
        self::ACCOUNT_LOCK,
    ];
    const DEFAULT_PAGINATE = 15;
    const LIMIT_SLIDER = 10;
    const INDEX_PAGINATE = 20;


    public function downloadAvatar(Request $request)
    {

        $filename = $request->file_name;
        $folder = 'account';
        return $this->downLoadImage($request, $filename, $folder);
    }


    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|min:6|max:255',
                'password' => 'required|string|min:8|max:255',
            ],
        );

        $data = $request->only('email', 'password');
        if (!$data) {
            $data = [
                'email' => $request->session()->get('username'),
                'password' => $request->session()->get('password')
            ];
        }

        $token = Auth::guard('account')
            ->attempt(['email' => $data['email'], 'password' => $data['password']]);
        if ($token) {
            $account = Auth::guard('account')->user();
            return $this->check($account, $request);
        }

        return $this->check($token, $request);
    }

    public function check($account, $request)
    {

        if (!$account) {
            return response()->view('login', [
                "message" => __('message.login-failed'),
                "messageType" => "danger",
            ]);
        }

        if ($this->isLock($account->status)) {
            return response()->view('login', [
                "message" => __('message.account-lock'),
                "messageType" => "danger",
            ]);
        }

        if ($this->isDeactivate($account->status)) {
            return response()->view('login', [
                "message" => __('message.account-not-verified'),
                "messageType" => "danger",
            ]);
        }

        $request->session()->regenerate();
        if ($this->isAdmin($account->role_id)) {

            $request->session()->put('admin', $account);
            $info = UserInfo::where('account_id', $account->id)->first();
            $request->session()->put('info',  $info);

            return redirect()->intended('dashboard');
        }

        return $this->getIndex($request, $account);
    }

    public function getIndex($request, $account)
    {

        $request->session()->put('user',  $account);
        $info = UserInfo::where('account_id', $account->id)->first();
        $request->session()->put('info',  $info);

        $sliders = Slider::limit(self::LIMIT_SLIDER)->get();
        $request->session()->forget('sliders');
        $request->session()->put('sliders', $sliders);

        $newCars = Car::orderByDesc('created_at')->getTenCar()->get();
        $request->session()->forget('newCars');
        $request->session()->put('newCars', $newCars);

        $listCars = Car::orderByDesc('created_at')->getIndexCar()->get();
        $request->session()->forget('listCars');
        $request->session()->put('listCars', $listCars);

        $cart = Cart::with('cart_detail')->where('account_id', $account->id)->first();
        $countCartDetail = $cart->cart_detail->count();
        $request->session()->forget('countCartDetail');
        $request->session()->put('countCartDetail', $countCartDetail);

        $category = Category::limit(self::DEFAULT_PAGINATE)->get();
        $request->session()->forget('category');
        $request->session()->put('category', $category);

        return redirect()->route('index');
    }


    public function getRegister()
    {
        return view('register');
    }

    public function register(AccountRequest $request)
    {
        $request->validate(
            [
                'username' => 'required|min:8|max:255|unique:accounts',
                'email' => 'required|email|min:6|max:255|unique:accounts',
                'password' => 'required|string|min:8|max:255',
            ],
        );

        $data = $request->only('username', 'email', 'password');

        $active_token = strtoupper(Str::random(10));

        try {

            Account::createAccount($data, $active_token);

            Mail::to($data['email'])->send(new VerifyEmail($data, $active_token));

            return response()->view('login', [
                "message" => __('message.create-single-account-successful'),
                "messageType" => "success",
            ]);
        } catch (Throwable $e) {
            log::channel('admin_log')->error($e->getMessage());
            return response()->view('login', [
                "message" => __('message.create-single-account-fail'),
                "messageType" => "danger",
            ]);
        }
    }


    public function active($email, $token)
    {
        $active = Account::with('user_active')->where('email', $email)->first();

        if (!$active) {
            return response()->view('login', [
                "message" => __('message.account-not-found'),
                "messageType" => "danger",
            ]);
        }

        if ($active->user_active->active_token === $token) {
            Account::where('email', $email)->update([
                'status' => self::ACCOUNT_ACTIVATED,
            ]);

            return  response()->view('login', [
                "message" => __('message.account-activated-successful'),
                "messageType" => "success",
            ]);
        }

        return response()->view('login', [
            "message" => __('message.account-activated-fail'),
            "messageType" => "danger",
        ]);
    }

    public function showUpdateAccount($id)
    {
        $account = Account::find($id);
        $roles = Role::all();
        $statusOptions = self::DEFAULT_STATUS_SELECT;
        session()->put('id_account_update', $id);
        return view('admin.update_account')->with(compact('account', 'statusOptions', 'roles'));
    }

    public function updateAccount(Request $request)
    {
        $id = session()->get('id_account_update');

        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }

        $password = $request->password;
        $status = $request->user_status[$id];
        $role_id = $request->role_id;


        if ($password) {
            $request->validate(
                [
                    'password' => 'min:8|max:255',
                ],
            );

            $password_new = Account::hashPassword($password);
        }

        $password_new = $password_new ?? Account::find($id)->password;


        try {
            Account::where('id', $id)->update([
                'password' => $password_new,
                'status' => $status,
                'role_id' => $role_id,
            ]);

            $this->updateSuccessMessage($request, __('message.update-successful'));
            return back();
        } catch (Throwable $e) {

            log::channel('admin_log')->info($e->getMessage());

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }
    }

    public function updateMultipleAccount(Request $request)
    {

        $accountStatus = $request->input('user-status');

        try {
            Account::updateMultipleAccount($accountStatus);
            $this->updateMessage($request, __('message.update-successful'), 'success');
        } catch (Throwable $th) {
            log::channel('admin_log')->error($th->getMessage());
            $this->updateMessage($request, __('message.update-fail'), 'danger');
        }
        return redirect(route('list.user'));
    }


    public function logout(Request $request)
    {
        Auth::guard('account')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }




    public function isLock($status)
    {
        if ($status === self::ACCOUNT_LOCK) {
            return true;
        }
        return false;
    }

    public function isDeactivate($status)
    {
        if ($status === self::ACCOUNT_DEACTIVATED) {
            return true;
        }
        return false;
    }

    public function isAdmin($role)
    {
        if ($role === self::ROLE_ADMIN) {
            return true;
        }
        return false;
    }

    public function info($id)
    {
        $account = Account::getAccountById($id);
        $info = $account->user_info;
        return view('layout.info_account')->with(compact('account', 'info'));
    }

    public function updateInfo(AccountRequest $request)
    {
        $id = session()->get('admin')->id ?? '';
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
            $this->deleteImage($account->user_info->avatar ?? null, 'account');
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
            log::channel('user_log')->error($e->getMessage());
            $this->updateFailMessage($request, __('message.update-fail'));

            return back()->with([
                'account' => $account,
                'info' => $account->user_info,
            ]);
        }
    }

    public function listAccount(Request $request)
    {
        $statusOptions = self::DEFAULT_STATUS_SELECT;

        $searchParams = $this->extraSearchParams($request);

        $users = Account::with('user_info')
            ->withFilter($searchParams)
            ->orderByDesc('created_at')
            ->paginate(self::DEFAULT_PAGINATE);

        return view('admin.account')->with(
            [
                'users' => $users,
                'statusOptions' => $statusOptions,
            ]
        );
    }

    public function extraSearchParams(Request $request)
    {

        return [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'status' => $request->input('status', self::DEFAULT_STATUS_SELECT),
            'type' => $request->input('type') ? [$request->input('type')] : [self::ROLE_USER, self::ROLE_ADMIN]
        ];
    }

    public function showResetPassword($id)
    {
        return view('account.reset_pass', [
            'id' => $id,
        ]);
    }

    public function resetPassword(Request $request)

    {
        $id = session()->get('admin')->id ?? session('user')->id;

        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }

        $request->validate(
            [
                'password' => 'required|min:8|max:255',
                'new_password' => 'required|min:8|max:255',
                'confirm_new_password' => 'required|min:8|max:255|same:new_password',
            ],
            [
                'confirm_new_password.same' => 'Mật khẩu không khớp',
            ]
        );

        $data = $request->only('password', 'new_password', 'confirm_new_password');

        $new_password = Account::hashPassword($data['new_password']);

        $account = Auth::guard('account')
            ->attempt(['id' => $id, 'password' => $data['password']]);
        if ($account) {
            Account::where('id', '=', $id)->update([
                'password' => $new_password
            ]);

            $this->updateSuccessMessage($request, __('message.update-password-successful'));
            return back();
        }

        $this->updateFailMessage($request, __('message.password-not-match'));
        return back();
    }

    public function showPassword2($id)
    {

        $password2 = Account::find($id)->password2;
        if ($password2) {
            $password2 = 'exits';
        }

        return view('account.create_pass2', ['id' => $id])->with(compact('password2'));
    }

    public function createPassword2(Request $request)
    {
        $id = session()->get('admin')->id ?? session('user')->id;

        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }

        $request->validate(
            [
                'password2' => 'required|min:4|max:4',
                'confirm_new_password2' => 'required|min:4|max:4|same:password2',
            ],
            [
                'confirm_new_password2.same' => 'Mật khẩu không khớp',
            ]
        );
        $password2 = $request->password2;

        $hashPassword = Account::hashPassword($password2);

        try {
            Account::where('id', $id)->update([
                'password2' => $hashPassword
            ]);

            $this->updateSuccessMessage($request, __('message.update-password-successful'));
            return back();
        } catch (Throwable $e) {
            $this->updateFailMessage($request, __('message.create-fail'));
            return back();
        }
    }

    public function resetPassword2(Request $request)
    {

        $id = session()->get('admin')->id ?? session('user')->id;

        if (!$id) {

            $this->updateFailMessage($request, __('message.update-fail'));

            return back();
        }


        $request->validate(
            [
                'password2' => 'required|min:4|max:4',
                'new_password2' => 'required|min:4|max:4',
                'confirm_new_password2' => 'required|min:4|max:4|same:new_password2',
            ],
            [
                'confirm_new_password2.same' => 'Mật khẩu không khớp',
            ]
        );


        $data = $request->only('password2', 'new_password2', 'confirm_new_password2');

        $password2 = Account::find($id)->password2;
        if (!$password2) {
            $this->updateFailMessage($request, __('message.password2-null'));
            return back();
        }


        $flag = Hash::check($data['password2'], $password2);
        $new_password = Account::hashPassword($data['new_password2']);

        if ($flag) {
            Account::where('id', '=', $id)->update([
                'password2' => $new_password
            ]);

            $this->updateSuccessMessage($request, __('message.update-password-successful'));
            return back();
        }

        $this->updateFailMessage($request, __('message.password-not-match'));
        return back();
    }

    public function showCheckForgotPassword()
    {
        return view('account.check_forgot_password');
    }

    public function checkForgotPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|min:10|max:255',
            ]
        );

        $email = $request->email;
        $account = Account::where('email', $email)->first();

        if (!$account) {
            $this->updateFailMessage($request, __('message.account-not-found'));
            return back();
        }
        session()->put('email_forgot_password', $email);

        return redirect()->route('forgot.password');
    }

    public function showForgotPassword()
    {
        return view('account.forgot_password');
    }

    public function forgotPassword(Request $request)
    {
        $email =  session()->get('email_forgot_password');
        $request->validate(
            [
                'password2' => 'required|min:4|max:4',
                'password' => 'required|min:8|max:255',
                'confirm_password' => 'required|min:8|max:255|same:password',
            ],
            [
                'same' => 'Mật khẩu không khớp',
                'password2.min' => 'Mật khẩu cấp 2 phải có 4 ký tự',
                'password2.max' => 'Mật khẩu cấp 2 phải có 4 ký tự'

            ],
        );

        $data = $request->only('password2', 'password', 'confirm_password');

        $password2 = Account::where('email', $email)->first()->password2;

        if (!$password2) {

            $this->updateFailMessage($request, __('message.password2-null'));

            return back();
        }


        $flag = Hash::check($data['password2'], $password2);



        $new_password = Account::hashPassword($data['password']);

        if ($flag) {
            Account::where('email', $email)->update([
                'password' => $new_password
            ]);

            $this->updateSuccessMessage($request, __('message.update-password-successful') . 'Mời bạn đăng nhập!');
            return back();
        }

        $this->updateFailMessage($request, __('message.password-not-match'));
        return back();
    }
}
