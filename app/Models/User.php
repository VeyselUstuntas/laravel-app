<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'surname', 'email', 'password'];

    /**
     * @var array
    */
   protected $hidden = ['password','surname','created_at','updated_at'];

    public function orders():HasMany{
        return $this->hasMany(Order::class,'user_id');
    }
}
