<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Address extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'street',
        'number',
        'zip_code',
        'city_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param array $params
     * 
     * @return array
     */
    public function read(array $params): array
    {
        return DB::table('addresses', 'a')
            ->join('users AS u', 'a.user_id', '=', 'u.id')
            ->select([
                'a.id',
                'a.city_id',
                'a.street',
                'a.number',
                'a.zip_code',
                'u.name AS address_owner',
            ])
            ->when(isset($params['id']) && $params['id'] > 0, function (Builder $query) use ($params) {
                return $query->where('a.id', '=', $params['id']);
            })
            ->when(isset($params['user_id']) && $params['user_id'] > 0, function (Builder $query) use ($params) {
                return $query->where('user_id', '=', $params['user_id']);
            })
            ->when(isset($params['city_id']) && $params['city_id'] > 0, function (Builder $query) use ($params) {
                return $query->where('city_id', '=', $params['city_id']);
            })
            ->when(isset($params['street']), function (Builder $query) use ($params) {
                return $query->where('street', '=', $params['street']);
            })
            ->when(isset($params['number']), function (Builder $query) use ($params) {
                return $query->where('number', '=', $params['number']);
            })
            ->when(isset($params['zip_code']), function (Builder $query) use ($params) {
                return $query->where('zip_code', '=', $params['zip_code']);
            })
            ->get()
            ->toArray();
    }

}
