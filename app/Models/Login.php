<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $fillable = ['cnpj', 'email', 'senha'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'cnpj', 'cnpj');
    }
}
