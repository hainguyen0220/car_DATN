<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Throwable;

class Account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    const ROLE_ADMIN = 2;
    const ROLE_USER = 1;
    const ACCOUNT_ACTIVATED = "active";
    const ACCOUNT_DEACTIVATED = "deactive";
    const ACCOUNT_LOCK = 'lock';
    
    protected $dates = ['deleted_at'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function user_info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function user_active()
    {
        return $this->hasOne(UserActive::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'password2',
        'status',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const ROLE_DEFAULT = '1';
    const DEFAULT_PASSWORD = '12345678';
    const STATUS_DEACTIVATED = 'deactive';

    public static function createAccount($value, $activeToken)
    {
        $now = Carbon::now();

        $hashedPassword = Hash::make($value['password'] ?? self::DEFAULT_PASSWORD);

        $account = new Account();
        $account->username = $value['username'] ?? "";
        $account->email = $value['email'];
        $account->password = $hashedPassword;
        $account->status = self::STATUS_DEACTIVATED;
        $account->role_id = self::ROLE_DEFAULT;
        $account->save();

        $account->createUserInfo()
        ->createUserActive($activeToken,$now)
        ->createSideCard($now);
    }

    function createUserInfo(){
        $userInfo = new UserInfo();
        $userInfo->account_id = $this->id;
        $userInfo->save();
        return $this;
    }
   

    public function createUserActive($activeToken,$now){
        $userActive = new UserActive();
        $userActive->account_id = $this->id;
        $userActive->active_token = $activeToken;
        $userActive->created_at = $now;
        $userActive->updated_at = null;
        $userActive->save();
        return $this;
    }
    
    public function createSideCard($now){
            $cart = new Cart();
            $cart->account_id = $this->id;
            $cart->created_at = $now;
            $cart->updated_at = null;
            $cart->save();
            return $this;
    }

    public static function updateMultipleAccount($idStatusMap)
    {
        $statusIdMap = [];

        foreach ($idStatusMap as $id => $status) {
            if (array_key_exists("$status", $statusIdMap)) {
                $statusIdMap[$status][] = $id;
            } else {
                $statusIdMap[$status] = [$id];
            }
        }


        try {
            foreach ($statusIdMap as $status => $idList) {
                
                Account::whereIn("id", $idList)
                    ->update(["status" => $status]);
            }
        } catch (Throwable $th) {
            return false;
        }

        return true;
    }

    public static function getAccountById($id)
    {
        $account = Account::with('user_info')->find($id);
        return $account;
    }

    public static function hashPassword($password)
    {
        $hashPassword = Hash::make($password);
        return $hashPassword;
    }
    public function scopePaginate($query, $paginate)
    {
        $query = $query->paginate($paginate);
    }


    public function scopeWithFilter($query, $filters)
    {
        [
            'username' => $username,
            'email' => $email,
            'status' => $status,
            'type' => $type,
        ] = $filters;

        $query = $query->whereIn('status', $status);

        if ($username) {
            $query = $query->where('username', $username);
        }
        if ($email) {
            $query = $query->where('email', $email);
        }
        if ($type) {
            $query = $query->whereIn('role_id', $type);
        }

        return $query;
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
