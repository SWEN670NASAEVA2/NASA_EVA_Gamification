<?php
/**
 * Representation of point earning.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */
use MediaWiki\Linker\LinkTarget;

/**
 * @todo document
 */
class Point implements IDBAccessObject {
	/**
	 * @var int|null
	 */
	
	protected $mId;
	protected $mPage;
	protected $mPointsGenerated;
	protected $mUser;
	

	/**
	 * Constructor
	 *
	 * @param int
	 * @throws MWException
	 * @access private
	 */
	
	function __construct($page_is_new) {
		global $wgPoints;
	
		if (!is_null($page_is_new)){
			$this->setPointsGenerated($wgPoints[$page_is_new]);
		}
	}
	
	
	/**
	 * Get the points generated
	 *
	 * @return int|null
	 */
	public function getPointsGenerated() {
		return $this->mPointsGenerated;
	}
	
	/**
	 * Set the point_generated of the point
	 *
	 * @param PointGenerated $point_generated
	 */
	public function setPointsGenerated( $points_generated ) {
		$this->mPointsGenerated = intval($points_generated);
	}
	
	/**
	 * Get total points generated from all users.
	 * Returns null if no such user can be found.
	 *
	 * @param IDatabase $db
	 * @param int $id
	 * @return Revision|null
	 */
	public static function getTotalPointsForAllUsers() {
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
				'revision',
				array( 'rev_user', 'sum(rev_points_generated) AS rev_total_points_generated' ),
				null,
				__METHOD__,
				array( 'GROUP BY' => 'rev_user' ),
				null
		);
		
		$ret = null;
		while ($row = $dbr->fetchRow($res)) {
			$ret[$row['rev_user']] = intval($row['rev_total_points_generated']);
		}
		
		return $ret;
	}
	
	/**
	 * Get total points generated from a given user ID number.
	 * Returns null if no such user can be found.
	 *
	 * @param IDatabase $db
	 * @param int $id
	 * @return Revision|null
	 */
	public static function getTotalPointsFromUserId( $id ) {
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
				'revision',
				array( 'rev_user', 'sum(rev_points_generated) AS rev_total_points_generated' ),
				array( 'rev_user' => $id),
				__METHOD__,
				array( 'GROUP BY' => 'rev_user' ),
				null
		);
	
		$ret = null;
		while ($row = $dbr->fetchRow($res)) {
			$ret[$row['rev_user']] = intval($row['rev_total_points_generated']);
		}
	
		return $ret;
	}
	
	/**
	 * Get added post from a given user ID number.
	 * Returns null if no such user can be found.
	 *
	 * @param IDatabase $db
	 * @param int $id
	 * @return Revision|null
	 */
	public static function getAddedPostFromUserId( $id ) {
		global $wgPoints;
		// Query against a read-only database, if configured
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
				'revision',
				array( 'rev_user', 'count(rev_id) AS rev_added_post' ),
				array( 'rev_user' => $id, 'rev_points_generated' => $wgPoints[1] ),
				__METHOD__
		);
	
		$ret = null;
		while ($row = $dbr->fetchRow($res)) {
			$ret[$row['rev_user']] = intval($row['rev_added_post']);
		}
	
		return $ret;
	}
	
	/**
	 * Get edited post from a given user ID number.
	 * Returns null if no such user can be found.
	 *
	 * @param IDatabase $db
	 * @param int $id
	 * @return Revision|null
	 */
	public static function getEditedPostFromUserId( $id ) {
		global $wgPoints;
		$dbr = wfGetDB( DB_SLAVE );
		$res = $dbr->select(
				'revision',
				array( 'rev_user', 'count(rev_id) AS rev_edited_post' ),
				array( 'rev_user' => $id, 'rev_points_generated' => $wgPoints[0] ),
				__METHOD__
		);
	
		$ret = null;
		while ($row = $dbr->fetchRow($res)) {
			$ret[$row['rev_user']] = intval($row['rev_edited_post']);
		}
	
		return $ret;
	}
}
