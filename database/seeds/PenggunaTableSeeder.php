<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PenggunaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        $truncate = DB::table('pengguna')
            ->truncate();

        $create = DB::table('pengguna')
            ->insert([
                'email' => 'admin@ppdb.example.com',
                'password' => bcrypt('secret'),
                'created_at' => $date
            ]);
    }
}
