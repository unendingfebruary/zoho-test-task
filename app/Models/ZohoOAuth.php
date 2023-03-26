<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $refresh_token
 * @property string $access_token
 * @property Carbon $expires_at
 * @property string|null $api_domain
 */
class ZohoOAuth extends Model
{
    use HasFactory;

    protected $table = 'zoho_oauth';

    protected $fillable = [
        'refresh_token',
        'access_token',
        'expires_at',
        'api_domain',
    ];

    public static function createOrUpdate($data)
    {
        $zoauth = self::firstWhere('refresh_token', $data['refresh_token']);

        if (!$zoauth) {
            $zoauth = new self();
        }

        $zoauth->fill($data);
        $zoauth->save();
    }

    public static function getRefreshToken(): ?string
    {
        /** @var ZohoOAuth $zoauth */
        $zoauth = self::getLastRecord();

        return $zoauth?->refresh_token;
    }

    public static function getApiDomain(): ?string
    {
        /** @var ZohoOAuth $zoauth */
        $zoauth = self::getLastRecord();

        return $zoauth?->api_domain;
    }

    public static function getAccessToken(): ?string
    {
        /** @var ZohoOAuth $zoauth */
        $zoauth = self::getLastRecord();

        return $zoauth?->access_token;
    }

    public static function getLastRecord()
    {
        return self::latest()->first();
    }
}
