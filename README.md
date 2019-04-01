[![Build Status](https://img.shields.io/travis/bayubimantarar/ppdb.svg?style=flat-square)](https://travis-ci.org/bayubimantarar/ppdb)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](https://github.com/bayubimantarar/ppdb/pulls)
![GitHub](https://img.shields.io/github/license/bayubimantarar/ppdb.svg?style=flat-square)

# Penerimaan Peserta Didik Baru - PPDB
Penerimaan peserta didik baru adalah sebuah aplikasi yang bertujuan untuk :
1. Memudahkan penyeleksian siswa baru, dengan cara :
    1. Zonasi atau melihat jarak kilometer alamat dengan sekolah
    2. Perhitungan penyeleksian dengan hasil skor nhun
2. Ter-_komputerisasi_ supaya lebih mudah

## Installation
1. Clone repository
2. Install dependencies composer

        composer install --no-dev #for production

        composer install #for development

3. Copy file environment

        cp .env.example .env

4. Generate application key

        php artisan key:generate

## Test
Test with phpunit

    ./vendor/bin/phpunit

Test with laravel dusk
    
    php artisan dusk
