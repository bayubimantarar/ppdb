<?php

namespace Tests\Browser\Authentication;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PenggunaAuthenticationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function visitFormLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/autentikasi/form-login')
                ->assertPathIs('/autentikasi/form-login');
        });
    }

    /**
     * test login
     * @test
     * @return void
     */
    public function login()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/autentikasi/form-login')
                ->type('email', 'admin@ppdb.example.com')
                ->type('password', 'secret')
                ->press('Masuk')
                ->assertPathIs('/')
                ->assertAuthenticated('pengguna');
        });
    }

    /**
     * test login with empty email
     * @test
     * @return void
     */
    public function loginWithEmptyEmail()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/autentikasi/form-login')
                ->type('password', 'secret')
                ->press('Masuk')
                ->assertPathIs('/autentikasi/form-login')
                ->assertSee('Email perlu diisi!');
        });
    }

    /**
     * test login with empty password
     * @test
     * @return void
     */
    public function loginWithEmptyPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/autentikasi/form-login')
                ->type('email', 'admin@ppdb.example.com')
                ->press('Masuk')
                ->assertPathIs('/autentikasi/form-login')
                ->assertSee('Kata sandi perlu diisi!');
        });
    }

    /**
     * test login with empty password
     * @test
     * @return void
     */
    public function loginPenggunaNotExist()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/autentikasi/form-login')
                ->type('email', 'info@ppdb.example.com')
                ->type('password', 'notsecret')
                ->press('Masuk')
                ->assertPathIs('/autentikasi/form-login')
                ->assertSee('Akun tidak ditemukan! Periksa kembali email atau kata sandi.');
        });
    }

    /**
     * test login
     * @test
     * @return void
     */
    public function logout()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/autentikasi/form-login')
                ->type('email', 'admin@ppdb.example.com')
                ->type('password', 'secret')
                ->press('Masuk')
                ->assertPathIs('/')
                ->clickLink('admin@ppdb.example.com')
                ->pause(1000)
                ->clickLink('Keluar')
                ->pause(1000)
                ->clickLink('Keluar')
                ->assertPathIs('/autentikasi/form-login');
        });
    }
}
