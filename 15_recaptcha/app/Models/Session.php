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

    public function getLastActivityAttribute($value){
        return Carbon::createFromTimestamp($value)->diffForHumans();
    }

    public function getIsCurrentDeviceAttribute(){
        return $this->id == request()->session()->getId();
    }

    public function getAgentAttribute(){
        $agent = new Agent();
        $agent->setUserAgent($this->user_agent);
        return [
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'is_desktop' => $agent->isDesktop(),
        ];
    }

    protected $hidden = ['payload', 'user_agent'];

    protected $appends = ['is_current_device', 'agent'];
}