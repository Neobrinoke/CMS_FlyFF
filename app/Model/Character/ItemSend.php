<?php

namespace App\Model\Character;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemSend
 * @package App\Model\Character
 *
 * @property int m_nNo
 * @property string m_idPlayer
 * @property string serverindex
 * @property string Item_Name
 * @property int Item_count
 * @property int m_nAbilityOption
 * @property string End_Time
 * @property int m_bItemResist
 * @property int m_nResistAbilityOption
 * @property int m_bCharged
 * @property string idSender
 * @property int nPiercedSize
 * @property int adwItemId0
 * @property int adwItemId1
 * @property int adwItemId2
 * @property int adwItemId3
 * @property int m_dwKeepTime
 * @property int ItemFlag
 * @property Carbon ReceiveDt
 * @property Carbon ProvideDt
 * @property int nRandomOptItemId
 * @property string ItemBillingNo
 * @property int adwItemId4
 * @property int adwItemId5
 * @property int adwItemId6
 * @property int adwItemId7
 * @property int adwItemId8
 * @property int adwItemId9
 * @property int nUMPiercedSize
 * @property int adwUMItemId0
 * @property int adwUMItemId1
 * @property int adwUMItemId2
 * @property int adwUMItemId3
 * @property int adwUMItemId4
 */
class ItemSend extends Model
{
    /** @var string */
    protected $primaryKey = 'm_nNo';

    /** @var string */
    protected $connection = 'character';

    /** @var string */
    protected $table = 'ITEM_SEND_TBL';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $fillable = [
        'm_idPlayer',
        'serverindex',
        'Item_Name',
        'Item_count',
        'm_nAbilityOption',
        'm_nNo',
        'End_Time',
        'm_bItemResist',
        'm_nResistAbilityOption',
        'm_bCharged',
        'idSender',
        'nPiercedSize',
        'adwItemId0',
        'adwItemId1',
        'adwItemId2',
        'adwItemId3',
        'm_dwKeepTime',
        'ItemFlag',
        'ReceiveDt',
        'ProvideDt',
        'nRandomOptItemId',
        'ItemBillingNo',
        'adwItemId4',
        'adwItemId5',
        'adwItemId6',
        'adwItemId7',
        'adwItemId8',
        'adwItemId9',
        'nUMPiercedSize',
        'adwUMItemId0',
        'adwUMItemId1',
        'adwUMItemId2',
        'adwUMItemId3',
        'adwUMItemId4'
    ];

    /** @var array */
    protected $dates = [
        'ReceiveDt',
        'ProvideDt'
    ];
}
