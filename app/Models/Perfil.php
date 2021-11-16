<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Firebase\JWT\JWT;

class Perfil extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'sexo',
        'edad'
    ];

    public function getTokenAttribute(){
        $payload = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'sexo' => $this->sexo,
            'edad' => $this->edad

        ];
        $jwt = JWT::encode($payload, env('JWT_SECRET', 'SECRET'), env('JWT_ALGORITHM', 'HS256'));
        return $jwt;
    }
    
}
