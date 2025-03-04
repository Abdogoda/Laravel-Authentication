<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class Session extends Model{

    protected $table = 'sessions';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    public function getLastActivityAttribute($value): string{
        return Carbon::createFromTimestamp($value)->diffForHumans();
    }

    public function getUserAgentAttribute($value): array{
        $agent = new Agent();
        $agent->setUserAgent($value);
        return [
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'is_desktop' => $agent->isDesktop()
        ];
    }

    public function getIsThisDeviceAttribute(): bool{
        return $this->id == request()->session()->getId();
    }

    protected $hidden = ['payload'];
    protected $appends = ['is_this_device'];
}
