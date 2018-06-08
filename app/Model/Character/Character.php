<?php

namespace App\Model\Character;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Character
 * @package App\Model\Character
 *
 * @property string m_idPlayer
 * @property string serverindex
 * @property string account
 * @property string m_szName
 * @property int playerslot
 * @property int dwWorldID
 * @property int m_dwIndex
 * @property double m_vScale_x
 * @property int m_dwMotion
 * @property double m_vPos_x
 * @property double m_vPos_y
 * @property double m_vPos_z
 * @property double m_fAngle
 * @property string m_szCharacterKey
 * @property int m_nHitPoint
 * @property int m_nManaPoint
 * @property int m_nFatiguePoint
 * @property int m_nFuel
 * @property int m_dwSkinSet
 * @property int m_dwHairMesh
 * @property int m_dwHairColor
 * @property int m_dwHeadMesh
 * @property int m_dwSex
 * @property int m_dwRideItemIdx
 * @property int m_dwGold
 * @property int m_nJob
 * @property string m_pActMover
 * @property int m_nStr
 * @property int m_nSta
 * @property int m_nDex
 * @property int m_nInt
 * @property int m_nLevel
 * @property int m_nMaximumLevel
 * @property int m_nExp1
 * @property int m_nExp2
 * @property string m_aJobSkill
 * @property string m_aLicenseSkill
 * @property string m_aJobLv
 * @property int m_dwExpertLv
 * @property int m_idMarkingWorld
 * @property double m_vMarkingPos_x
 * @property double m_vMarkingPos_y
 * @property double m_vMarkingPos_z
 * @property int m_nRemainGP
 * @property int m_nRemainLP
 * @property int m_nFlightLv
 * @property int m_nFxp
 * @property int m_nTxp
 * @property string m_lpQuestCntArray
 * @property string m_chAuthority
 * @property int m_dwMode
 * @property int m_idparty
 * @property string m_idCompany
 * @property int m_idMuerderer
 * @property int m_nFame
 * @property int m_nDeathExp
 * @property int m_nDeathLevel
 * @property int m_dwFlyTime
 * @property int m_nMessengerState
 * @property string blockby
 * @property int TotalPlayTime
 * @property string isblock
 * @property string End_Time
 * @property string BlockTime
 * @property Carbon CreateTime
 * @property int m_tmAccFuel
 * @property string m_tGuildMember
 * @property int m_dwSkillPoint
 * @property string m_aCompleteQuest
 * @property int m_dwReturnWorldID
 * @property double m_vReturnPos_x
 * @property double m_vReturnPos_y
 * @property double m_vReturnPos_z
 * @property int MultiServer
 * @property int m_SkillPoint
 * @property int m_SkillLv
 * @property int m_SkillExp
 * @property int dwEventFlag
 * @property int dwEventTime
 * @property int dwEventElapsed
 * @property int PKValue
 * @property int PKPropensity
 * @property int PKExp
 * @property int AngelExp
 * @property int AngelLevel
 * @property Carbon FinalLevelDt
 * @property int m_dwPetId
 * @property int m_nExpLog
 * @property int m_nAngelExpLog
 * @property int m_nCoupon
 * @property int m_nHonor
 * @property int m_nLayer
 * @property int m_nCampusPoint
 * @property int idCampus
 * @property string m_aCheckedQuest
 * @property int tKeepTime
 * @property int m_dwMadrigalGiftExp
 * @property int m_tmLogout
 * @property int m_nMetier
 * @property int m_nMetierLevel
 * @property int m_nMetierExp
 * @property int m_BurnPts
 * @property int m_nHideCoat
 */
class Character extends Model
{
	/** @var string */
	protected $connection = 'character';

	/** @var string */
	protected $table = 'CHARACTER_TBL';

	/** @var array */
	protected $fillable = [
		'm_idPlayer',
		'serverindex',
		'account',
		'm_szName',
		'playerslot',
		'dwWorldID',
		'm_dwIndex',
		'm_vScale_x',
		'm_dwMotion',
		'm_vPos_x',
		'm_vPos_y',
		'm_vPos_z',
		'm_fAngle',
		'm_szCharacterKey',
		'm_nHitPoint',
		'm_nManaPoint',
		'm_nFatiguePoint',
		'm_nFuel',
		'm_dwSkinSet',
		'm_dwHairMesh',
		'm_dwHairColor',
		'm_dwHeadMesh',
		'm_dwSex',
		'm_dwRideItemIdx',
		'm_dwGold',
		'm_nJob',
		'm_pActMover',
		'm_nStr',
		'm_nSta',
		'm_nDex',
		'm_nInt',
		'm_nLevel',
		'm_nMaximumLevel',
		'm_nExp1',
		'm_nExp2',
		'm_aJobSkill',
		'm_aLicenseSkill',
		'm_aJobLv',
		'm_dwExpertLv',
		'm_idMarkingWorld',
		'm_vMarkingPos_x',
		'm_vMarkingPos_y',
		'm_vMarkingPos_z',
		'm_nRemainGP',
		'm_nRemainLP',
		'm_nFlightLv',
		'm_nFxp',
		'm_nTxp',
		'm_lpQuestCntArray',
		'm_chAuthority',
		'm_dwMode',
		'm_idparty',
		'm_idCompany',
		'm_idMuerderer',
		'm_nFame',
		'm_nDeathExp',
		'm_nDeathLevel',
		'm_dwFlyTime',
		'm_nMessengerState',
		'blockby',
		'TotalPlayTime',
		'isblock',
		'End_Time',
		'BlockTime',
		'CreateTime',
		'm_tmAccFuel',
		'm_tGuildMember',
		'm_dwSkillPoint',
		'm_aCompleteQuest',
		'm_dwReturnWorldID',
		'm_vReturnPos_x',
		'm_vReturnPos_y',
		'm_vReturnPos_z',
		'MultiServer',
		'm_SkillPoint',
		'm_SkillLv',
		'm_SkillExp',
		'dwEventFlag',
		'dwEventTime',
		'dwEventElapsed',
		'PKValue',
		'PKPropensity',
		'PKExp',
		'AngelExp',
		'AngelLevel',
		'FinalLevelDt',
		'm_dwPetId',
		'm_nExpLog',
		'm_nAngelExpLog',
		'm_nCoupon',
		'm_nHonor',
		'm_nLayer',
		'm_nCampusPoint',
		'idCampus',
		'm_aCheckedQuest',
		'tKeepTime',
		'm_dwMadrigalGiftExp',
		'm_tmLogout',
		'm_nMetier',
		'm_nMetierLevel',
		'm_nMetierExp',
		'm_BurnPts',
		'm_nHideCoat'
	];
}
