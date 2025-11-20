<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'interest'];

    /**
     * Relación: pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lista de intereses disponibles
     */
    public static function getAvailableInterests(): array
    {
        return [
            'naturaleza' => 'Naturaleza',
            'comida_tipica' => 'Comida Típica',
            'historia' => 'Historia',
            'cultura' => 'Cultura',
            'aventura' => 'Aventura',
            'senderismo' => 'Senderismo',
            'miradores' => 'Miradores',
            'lagos_rios' => 'Lagos / Ríos',
            'fotografia' => 'Fotografía',
            'religion' => 'Religión',
            'arte' => 'Arte',
            'arquitectura' => 'Arquitectura',
        ];
    }
}
