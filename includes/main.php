<?php
/**
 * @file
 */

namespace MediaWiki\Extension\PatrolSelectors;

use MediaWiki\Hook\RecentChange_saveHook;
use MediaWiki\MediaWikiServices;
use Wikimedia\Parsoid\Ext\JSON\JSON;

class main implements RecentChange_saveHook {

    public function onRecentChange_save( $recentChange ) {
        $config = MediaWikiServices::getInstance()->getMainConfig();
        $nameSpaces = $config->get('PatrolSelectorsNameSpaces');
        
        if (in_array($recentChange->getAttribute('rc_namespace'), $nameSpaces) && $recentChange->getAttribute('rc_patrolled') == 0) {
            $recentChange->reallyMarkPatrolled();
        }
    }
}
