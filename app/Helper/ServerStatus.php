<?php

namespace App\Helper;

use App\Model\Account\Account;
use App\Model\Character\Character;
use App\Model\Character\CombatInfo;
use App\Model\Character\Lord;
use App\Model\Character\LordEvent;
use App\Model\Character\MultiServerInfo;
use App\Model\Logging\UserCount;
use App\Model\Web\Setting;

class ServerStatus
{
    /** @var string */
    public $status = '-';

    /** @var int */
    public $accounts_number = 0;

    /** @var int */
    public $players_number = 0;

    /** @var int */
    public $connected_number = 0;

    /** @var int */
    public $max_connected_number = 0;

    /** @var string */
    public $exp_rate = '-';

    /** @var string */
    public $drop_rate = '-';

    /** @var string */
    public $penyas_rate = '-';

    /** @var string */
    public $mvp_info = '-';

    /** @var string */
    public $gs_info = '-';

    /** @var string */
    public $lord_info = '-';

    /** @var string */
    public $event_info = '-';

    /**
     * ServerStatus constructor.
     */
    public function __construct()
    {
        $settings = Setting::getSettings();

        if ($this->isOnline()) {
            $this->status = trans('aside.server_status.status_on');
        } else {
            $this->status = trans('aside.server_status.status_off');
        }

        $this->accounts_number = Account::query()->count();
        $this->players_number = Character::query()->count();
        $this->connected_number = MultiServerInfo::getConnectedCount();
        $this->max_connected_number = UserCount::find()->number;

        if ($settings->exp_rate) {
            $this->exp_rate = $settings->exp_rate;
        }

        if ($settings->drop_rate) {
            $this->drop_rate = $settings->drop_rate;
        }

        if ($settings->penyas_rate) {
            $this->penyas_rate = $settings->penyas_rate;
        }

        $this->mvp_info = CombatInfo::getLastOnePlayed()->joinPlayer->player->m_szName ?? '-';
        $this->gs_info = CombatInfo::getLastOnePlayed()->joinGuild->guild->m_szGuild ?? '-';
        $this->lord_info = Lord::getCurrent()->player->m_szName ?? '-';
        $this->event_info = LordEvent::getCurrent();
    }

    /**
     * Determine if server is online.
     *
     * @return bool
     */
    public function isOnline(): bool
    {
        return @fsockopen(env('SERVER_IP'), env('SERVER_PORT'), $errno, $errstr, 0) ? true : false;
    }
}
