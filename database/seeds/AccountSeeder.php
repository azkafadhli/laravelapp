<?php

use App\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Account::create(
            [
                'uid' => 'some-random-uid',
                'name' => 'some-random-name',
                'key' => 'some-random-key',
                'secret' => 'some-random-secret',
                'is_enabled' => false
            ]
        )->save();
    }
}
