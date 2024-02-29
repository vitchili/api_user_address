<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'age',
        'email',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * @param array $params
     * 
     * @return array
     */
    public function read(array $params): array
    {
        return DB::table('users', 'u')
            ->join('addresses AS a', 'u.id', '=', 'a.user_id')
            ->join('cities AS c', 'a.city_id', '=', 'c.id')
            ->join('states AS s', 'c.state_id', '=', 's.id')
            ->select([
                'u.id',
                'u.name',
                'u.age',
                'u.email',
                'a.street',
                'a.number',
                'c.name AS city',
                's.name AS state',
                'a.zip_code'
            ])
            ->when(isset($params['id']) && $params['id'] > 0, function (Builder $query) use ($params) {
                return $query->where('id', '=', $params['id']);
            })
            ->when(! empty($params['name']), function (Builder $query) use ($params) {
                return $query->where('name', '=', $params['name']);
            })
            ->when(isset($params['age']) && $params['age'] > 0, function (Builder $query) use ($params) {
                return $query->where('age', '=', $params['age']);
            })
            ->when(! empty($params['email']), function (Builder $query) use ($params) {
                return $query->where('email', '=', $params['email']);
            })
            ->get()
            ->toArray();
    }

    protected static function booted () {
        static::deleting(function(User $user) {
             $user->address()->delete();
        });
    }

}
