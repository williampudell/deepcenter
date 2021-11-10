<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function getStatus($value)
    {
        $status = '';
        switch ($value) {
            case 0:
                $status = 'Inativo';
                break;
            case 1:
                $status = 'Ativo';
                break;
            default:
                $status = 'Desconhecido';
                break;
        }
        return $status;
    }

    protected function getBadgeColor($value)
    {
        $badge = 'text-light ';
        switch ($value) {
            case 0:
                $badge .= 'bg-danger';
                break;
            case 1:
                $badge .= 'bg-success';
                break;
            default:
                $badge .= 'bg-secondary';
                break;
        }
        return $badge;
    }

    public function getStatusAttribute($value)
    {
        $status = $this->getStatus($value);
        $badge = $this->getBadgeColor($value);
        return "<span class='badge {$badge}'>{$status}</span>";
    }

}
