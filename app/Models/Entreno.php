<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Entreno extends Model
{
    //
    use HasFactory;

    protected $table ='entrenos';

    protected $fillable =[
        'fecha',
        'titulo',
        'seccion1',
        'seccion2',
        'seccion3',
        'seccion4',
        'usuario_id',
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
