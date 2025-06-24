<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $johnDoeId = DB::table('users')->where('email', 'john.doe@example.com')->first()->user_id;
        $janeSmithId = DB::table('users')->where('email', 'jane.smith@example.com')->first()->user_id;

        DB::table('user_addresses')->insert([
            [
                'user_id' => $johnDoeId,
                'address_line_1' => '123 Đường Nguyễn Huệ',
                'address_line_2' => 'Phường Bến Nghé',
                'city' => 'TP. Hồ Chí Minh',
                'district' => 'Quận 1',
                'province' => 'TP. Hồ Chí Minh',
                'postal_code' => '700000',
                'country' => 'Việt Nam',
                'is_default' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $johnDoeId,
                'address_line_1' => '456 Lê Lợi',
                'address_line_2' => 'Phường 1',
                'city' => 'TP. Đà Nẵng',
                'district' => 'Hải Châu',
                'province' => 'Đà Nẵng',
                'postal_code' => '550000',
                'country' => 'Việt Nam',
                'is_default' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $janeSmithId,
                'address_line_1' => '789 Phố Cổ',
                'address_line_2' => 'Phường Hoàn Kiếm',
                'city' => 'Hà Nội',
                'district' => 'Hoàn Kiếm',
                'province' => 'Hà Nội',
                'postal_code' => '100000',
                'country' => 'Việt Nam',
                'is_default' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}