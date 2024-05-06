<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Request
 * @package App
 * @property integer $id
 * @property string $status
 * @property string $raw_proxy
 * @property integer $count_all
 * @property integer $count_good
 * @property-read Proxy[] $proxies
 */
class Request extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_IN_WORK = 'in_work';
    public const STATUS_DONE = 'done';

    public const STATUS_LABELS = [
        self::STATUS_NEW => 'Новая',
        self::STATUS_IN_WORK => 'В работе',
        self::STATUS_DONE => 'Готово',
    ];

    /**
     * @return HasMany
     */
    public function proxies(): HasMany
    {
        return $this->hasMany(Proxy::class);
    }

    /**
     * @return bool
     */
    public function parseProxyRaw(): bool
    {
        foreach (explode("\n", $this->raw_proxy) as $raw_proxy) {
            $raw = explode(':', $raw_proxy);
            $proxy = Proxy::create([
                'request_id' => $this->id,
                'ip' => $raw[0],
                'port' => $raw[1],
            ]);
            if (!$proxy->save()) {
                return false;
            }
        }
        return true;
    }
}
