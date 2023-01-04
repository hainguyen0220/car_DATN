<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Cart;
use App\Models\UserActive;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => strtolower(Str::random(8)),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make(Account::DEFAULT_PASSWORD),
            'password2' => null, // password2
            'status' => Account::ACCOUNT_ACTIVATED,
            'role_id' => Account::ROLE_USER,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Account $account) {
            UserInfo::factory(1)->create(['account_id' => $account->id]);
            UserActive::factory(1)->create(['account_id' => $account->id]);
            Cart::factory(1)->create(['account_id' => $account->id]);
        });
    }
}
