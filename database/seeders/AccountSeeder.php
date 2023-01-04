<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountAdmin  = Account::where('email', 'vanquoc26520@gmail.com')->first();
        if (!$accountAdmin) {
            $account = new Account([
                'username' => 'quoc2605',
                'email' => 'vanquoc26520@gmail.com',
                'password' => Hash::make(Account::DEFAULT_PASSWORD),
                'password2' => Hash::make(1234), // password2
                'status' => Account::ACCOUNT_ACTIVATED,
                'role_id' => Account::ROLE_ADMIN,
            ]);
            $account->save();
        }

        Account::factory(50)->create();
    }
}
