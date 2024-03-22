<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
// Biodata::create([
//     'nim' => 'A11.2018.11554',
//     'nama' => 'Rizki Dwi Martanto',
//     'email' => 'rizkidwimartanto@gmail.com',
//     'jurusan' => 'Teknik Informatika',
// ])