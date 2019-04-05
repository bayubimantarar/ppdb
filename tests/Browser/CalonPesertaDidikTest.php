<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\Models\Pengguna;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CalonPesertaDidikTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function visitCalonPesertaDidik()
    {
        # find super admin
        $pengguna = Pengguna::find(1);

        $this->browse(function (Browser $browser) use($pengguna) {
            $browser
                ->loginAs($pengguna, 'pengguna')
                ->visit('/calon-peserta-didik')
                ->assertPathIs('/calon-peserta-didik');
        });
    }

    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function createCalonPesertaDidik()
    {
        # find super admin
        $pengguna = Pengguna::find(1);

        $this->browse(function (Browser $browser) use($pengguna) {
            $browser
                ->loginAs($pengguna, 'pengguna')
                ->visit('/calon-peserta-didik/form-tambah')
                ->type('nisn', '3217')
                ->type('provinsi', 'Jawa Barat')
                ->type('kabupaten_kota', 'Bandung Barat')
                ->type('kecamatan', 'Ngamprah')
                ->type('kode_pos', '40552')
                ->type('alamat', 'Bukit Permata Blok A1 No 14')
                ->clickLink('Temukan alamat')
                ->pause(5000)
                ->type('nilai_nhun', '80')
                ->press('Simpan')
                ->assertPathIs('/calon-peserta-didik');
        });
    }

    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function createCalonPesertaDidikEmptyNISN()
    {
        # find super admin
        $pengguna = Pengguna::find(1);

        $this->browse(function (Browser $browser) use($pengguna) {
            $browser
                ->loginAs($pengguna, 'pengguna')
                ->visit('/calon-peserta-didik/form-tambah')
                ->type('nisn', NULL)
                ->type('provinsi', 'Jawa Barat')
                ->type('kabupaten_kota', 'Bandung Barat')
                ->type('kecamatan', 'Ngamprah')
                ->type('kode_pos', '40552')
                ->type('alamat', 'Bukit Permata Blok A1 No 14')
                ->clickLink('Temukan alamat')
                ->pause(5000)
                ->type('nilai_nhun', '80')
                ->press('Simpan')
                ->assertPathIs('/calon-peserta-didik/form-tambah');
        });
    }

    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function createCalonPesertaDidikEmptyAlamat()
    {
        # find super admin
        $pengguna = Pengguna::find(1);

        $this->browse(function (Browser $browser) use($pengguna) {
            $browser
                ->loginAs($pengguna, 'pengguna')
                ->visit('/calon-peserta-didik/form-tambah')
                ->type('nisn', '3217')
                ->type('provinsi', 'Jawa Barat')
                ->type('kabupaten_kota', 'Bandung Barat')
                ->type('kecamatan', 'Ngamprah')
                ->type('kode_pos', '40552')
                ->type('alamat', NULL)
                ->clickLink('Temukan alamat')
                ->pause(5000)
                ->type('nilai_nhun', '80')
                ->press('Simpan')
                ->assertPathIs('/calon-peserta-didik/form-tambah');
        });
    }

    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function createCalonPesertaDidikEmptyNHUN()
    {
        # find super admin
        $pengguna = Pengguna::find(1);

        $this->browse(function (Browser $browser) use($pengguna) {
            $browser
                ->loginAs($pengguna, 'pengguna')
                ->visit('/calon-peserta-didik/form-tambah')
                ->type('nisn', '3217')
                ->type('provinsi', 'Jawa Barat')
                ->type('kabupaten_kota', 'Bandung Barat')
                ->type('kecamatan', 'Ngamprah')
                ->type('kode_pos', '40552')
                ->type('alamat', 'Bukit Permata Blok A1 No 14')
                ->clickLink('Temukan alamat')
                ->pause(5000)
                ->type('nilai_nhun', NULL)
                ->press('Simpan')
                ->assertPathIs('/calon-peserta-didik/form-tambah');
        });
    }

    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function createCalonPesertaDidikAlamatNotFound()
    {
        # find super admin
        $pengguna = Pengguna::find(1);

        $this->browse(function (Browser $browser) use($pengguna) {
            $browser
                ->loginAs($pengguna, 'pengguna')
                ->visit('/calon-peserta-didik/form-tambah')
                ->type('nisn', '3217')
                ->type('provinsi', NULL)
                ->type('kabupaten_kota', NULL)
                ->type('kecamatan', NULL)
                ->type('kode_pos', NULL)
                ->type('alamat', 'Bukit Permata Blok A1 No 14')
                ->clickLink('Temukan alamat')
                ->pause(5000)
                ->acceptDialog()
                ->assertPathIs('/calon-peserta-didik/form-tambah');
        });
    }

    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function deleteCalonPesertaDidik()
    {
        # find super admin
        $pengguna = Pengguna::find(1);

        $this->browse(function (Browser $browser) use($pengguna) {
            $browser
                ->loginAs($pengguna, 'pengguna')
                ->visit('/calon-peserta-didik')
                ->pause(3000)
                ->clickLink('Hapus')
                ->acceptDialog()
                ->assertPathIs('/calon-peserta-didik');
        });
    }
}
