<?php

/**
 * UserGamificationProfile SpecialPage for NASA_EVA_Gamification extension
 *
 * @file
 * @ingroup Extensions
 */

class SpecialUserGamificationProfile extends SpecialPage {
         
	public function __construct() {
		parent::__construct( 'UserGamificationProfile' );
                
	}
       
	/**
	 * Show the page to the user
	 *
	 * @param string $sub The subpage string argument (if any).
	 *  [[Special:UserGamificationProfile/subpage]].
	 */
	public function execute( $sub ) {
		$this->getOutput()->addModules( 'ext.gamification.foo' );
		$this->userGamificationProfileUser();
	}

	// Add this SpecialPage under the MediaWiki 'Others' category
	protected function getGroupName() {
		return 'other';
	}

	/**
	 * Back-end query and page build of a single user's gamification badges
	 */
	public function userGamificationProfileUser() {
		global $wgOut, $wgUser;
		
		// Don't display anonymous or IP versions of the page
		if($wgUser->getId() == 0) { 
			$wgOut->addWikiMsg( 'gamification-notloggedin' );
			return true;
		}
            
                $leaderBoard=new LeaderBoard();
                
		$wgOut->setPageTitle(wfMessage( 'gamification-userprofile' )->text());
                
                // show default profile 
                // Display user's Name and RealName
                $html = '<b>' . wfMessage( 'gamification-username' )->text() . ': ' . '</b>' . $wgUser->getName() . '<br />';
                $html .= '<b>' . wfMessage( 'gamification-name' )->text() . ': ' . '</b>' . ( $wgUser->getRealName() == '' ? wfMessage( 'gamification-name-notpopulated' )->text() : $wgUser->getRealName() ) . '<br />';		
                
                // Display leader board
                $userId=$this->getUser()->getId();
                $ret= Point::getTotalPointsFromUserId($userId);
                $userPoints=$ret[$userId];
                $board=$leaderBoard->displayLeaderBoard($userId,$userPoints);
                $html.=$board;
                $wgOut->addHTML( $html );
		                
                if (isset($_GET['user']) && isset($_GET['add'])){ 
                    // show added pages
                    $clickedUser=intval($_GET['user']);
                    $addedPages=$leaderBoard->displayAddedPages($clickedUser);
                    $wgOut->addHTML($addedPages);
                }		
                 elseif (isset($_GET['user']) && isset($_GET['edit'])){
                    // show edited pages
                    $clickedUser=intval($_GET['user']);
                    $editedPages=$leaderBoard->displayEditedPages($clickedUser);
                    $wgOut->addHTML($editedPages);
                }
                
                    
                  
	  
        }
}
