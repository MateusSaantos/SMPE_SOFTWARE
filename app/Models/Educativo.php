<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Educativo extends Model
{
    protected $fillable = [
        'slug','titulo','descricao','conteudo','links','categorias',
        'condicao_exibicao','visivel','visitado','status','ordem'
    ];

    protected $casts = [
        'links' => 'array',
        'visivel' => 'boolean',
        'visitado' => 'boolean',
    ];

    protected static function booted() {
        static::creating(function ($m) {
            if (empty($m->slug)) {
                $base = Str::slug($m->titulo ?: Str::random(8));
                $slug = $base; $i = 1;
                while (static::where('slug',$slug)->exists()) $slug = $base.'-'.$i++;
                $m->slug = $slug;
            }
        });
    }

    // Helpers
    public function categoriasArray(): array {
        return array_values(array_filter(array_map('trim', explode(',', (string)$this->categorias))));
    }
}
