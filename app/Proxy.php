<?php

namespace App;

use Arr;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Proxy
 * @package App
 *
 * @property integer $id
 * @property integer $request_id
 * @property string $ip
 * @property integer $port
 * @property string $status
 * @property string $type
 * @property string $country
 * @property string $city
 * @property string $real_ip
 * @property integer $ping
 * @property-read Request $request
 *
 */
class Proxy extends Model
{
    public const CHECK_URL = 'https://google.com/';

    public const STATUS_NEW = 'new';
    public const STATUS_IN_WORK = 'in_work';
    public const STATUS_BAD = 'bad';
    public const STATUS_GOOD = 'good';

    public const STATUS_LABELS = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_IN_WORK => 'Проверяем',
        self::STATUS_BAD => 'Не работает',
        self::STATUS_GOOD => 'Работает',
    ];

    public const TYPE_HTTP = 'http';
    public const TYPE_SOCKS4 = 'socks4';
    public const TYPE_SOCKS5 = 'socks5';

    public const TYPES_CURL_OPT = [
        self::TYPE_HTTP => CURLPROXY_HTTP,
        self::TYPE_SOCKS4 => CURLPROXY_SOCKS4,
        self::TYPE_SOCKS5 => CURLPROXY_SOCKS5,
    ];

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'request_id',
        'ip',
        'port',
        'status',
        'type',
        'country',
        'city',
        'real_ip',
        'ping',
    ];

    /**
     * @return HasOne
     */
    public function request(): HasOne
    {
        return $this->hasOne(Request::class);
    }

    /**
     * @return void
     */
    public function checkProxy(): void
    {
        $this->status = self::STATUS_IN_WORK;
        $client = new Client([
            'verify' => false
        ]);

        foreach (self::TYPES_CURL_OPT as $type => $curl_opt) {
            dump($type);
            $start = microtime(true);
            try {
                $response = $client->request('GET', self::CHECK_URL, [
                    'curl' => [
                        CURLOPT_HEADER => true,
                        CURLOPT_TIMEOUT => 100,
                        CURLOPT_CONNECTTIMEOUT => 100,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_PROXY => $this->ip,
                        CURLOPT_PROXYPORT => $this->port,
                        CURLOPT_PROXYTYPE => $curl_opt
                    ]
                ]);
                dump($type . ' => ' . $response->getStatusCode());
                if (200 === $response->getStatusCode()) {
                    $this->type = $type;
                    $this->status = self::STATUS_GOOD;
                    $this->ping = round((microtime(true) - $start) * 1000);
                    break;
                }
            } catch (GuzzleException $e) {
                dump($type . ' => ' . $e->getMessage());
                // потом куда нибудь в лог сложить если надо
            }
        }

        if (self::STATUS_GOOD !== $this->status) {
            $this->status = self::STATUS_BAD;
        }

        $this->save();
    }
}
