<?php
/**
 * Hooks for NASA_EVA_Gamification extension
 *
 * @file
 * @ingroup Extensions
 */

class NASA_EVA_GamificationHooks {

	/**
	 *  Add hook for creating database objects
	 *
	 *  @param DatabaseUpdater $updater MediaWiki Updater object
	 */
	public static function onLoadExtensionSchemaUpdates( $updater ) {
		$updater->addExtensionField( 'revision','rev_points_generated', 
			__DIR__ . '/sql/alter_revision_entity.sql' );
		return true;
	}
}
