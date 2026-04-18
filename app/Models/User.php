<?php

namespace App\Models;

// Menggunakan fitur authentication bawaan Laravel
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /**
     * Trait untuk factory (seeding data user)
     */
    use HasFactory, Notifiable;

    /**
     * Atribut yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'name',     // Nama user
        'email',    // Email user
        'password', // Password user (akan di-hash otomatis)
    ];

    /**
     * Atribut yang disembunyikan saat data di-serialize (JSON / array)
     */
    protected $hidden = [
        'password',       // Password tidak ditampilkan
        'remember_token', // Token login tetap disembunyikan
    ];

    /**
     * Melakukan casting tipe data otomatis
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Format tanggal verifikasi email
            'password' => 'hashed',            // Password otomatis di-hash saat disimpan
        ];
    }
}