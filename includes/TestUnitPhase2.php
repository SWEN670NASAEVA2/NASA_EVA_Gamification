<?php
class TestLeaderBoard {
    
                /**
                 * Tests the displayAddedPages function by supplying a valid user id as input
                 * for the cicked user
                 */
                public function testDisplayAddedPagesValid(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $clickedUser=1; // test input
                    $pageNames=$LeaderBoard->displayAddedPages($clickedUser);
                    // displays the added pages by the user
                    $wgOut->addHTML($pageNames);
                }
                
                /**
                 * Tests the displayAddedPages function by supplying an invalid user id as input
                 * for the cicked user
                 */
                public function testDisplayAddedPagesInvalid(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $clickedUser=-2; // test input
                    $pageNames=$LeaderBoard->displayAddedPages($clickedUser);
                    // display should say: User ID must be valid
                    $wgOut->addHTML($pageNames);
                }
                
                /*
                Zero is valid userID in the wiki database, so will not be tested separately 
                 as it falls under valid input for a clicked user
                */
                
                 /**
                 * Tests the displayAddedPages function by supplying a null user id as input
                 * for the cicked user
                 */
                public function testDisplayAddedPagesNull(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $clickedUser=null; // test input
                    $pageNames=$LeaderBoard->displayAddedPages($clickedUser);
                    // display should say: User ID must be valid
                    $wgOut->addHTML($pageNames);
                }
                
                /**
                 * Tests the displayEditedPages function by supplying a valid user id as input
                 * for the clicked user
                 */
                public function testDisplayEditedPagesValid(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $clickedUser=1; // test input
                    $pageNames=$LeaderBoard->displayEditedPages($clickedUser);
                    // displays the edited pages by the user
                    $wgOut->addHTML($pageNames);
                }
                
                 /**
                 * Tests the displayEditedPages function by supplying an invalid user id as input
                 * for the clicked user
                 */
                public function testDisplayEditedPagesInvalid(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $clickedUser=-2; // test input
                    $pageNames=$LeaderBoard->displayEditedPages($clickedUser);
                    // display should say: User ID must be valid
                    $wgOut->addHTML($pageNames);
                }
                
                /*
                Zero is valid userID in the wiki database, so will not be tested separately 
                 as it falls under valid input for a clicked user
                */
                
                 /**
                 * Tests the displayEditedPages function by supplying a null user id as input
                 * for the clicked user
                 */
                public function testDisplayEditedPagesNull(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $clickedUser=null; // test input of null
                    $pageNames=$LeaderBoard->displayEditedPages($clickedUser);
                    // display should say: User ID must be valid
                    $wgOut->addHTML($pageNames);
                }
                
                
                /**
                 * Tests the getBadges function by supplying valid points as input and display appropriate badges
                 */
                public function testGetBadgesValid(){ 
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $badges=$LeaderBoard->getBadges(150); // test input of 150
                    foreach ($badges as $badgeName) {
                        //displays the badge names in the returned array
                        $wgOut->addWikiText($badgeName);
                    }                
                }
                
                 /**
                 * Tests the getBadges function by supplying 0 points as input
                 */
                public function testGetBadgesZero(){ 
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $badges=$LeaderBoard->getBadges(0); // test input of 0
                    foreach ($badges as $badgeName) {
                        // returned array should be empty with nothing to display
                        $wgOut->addWikiText($badgeName);
                    }                
                }
                
                 /**
                 * Tests the getBadges function by supplying invalid points as input 
                 */
                public function testGetBadgesInvalid(){ 
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $badges=$LeaderBoard->getBadges(-150); // test input of -150
                    foreach ($badges as $badgeName) {
                        // retured array should be empty with nothing to display
                        $wgOut->addWikiText($badgeName);
                    }                
                }
                
                  /**
                 * Tests the getBadges function by supplying null points as input 
                 */
                public function testGetBadgesNull(){ 
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();
                    $badges=$LeaderBoard->getBadges(null); // test input of null
                    foreach ($badges as $badgeName) {
                        //returned array should be empty with nothing to display
                        $wgOut->addWikiText($badgeName);
                    }                
                }
                
                /**
                 * Tests the displayLeaderBoard function by supplying valid user id and points as input
                 * to display leaderboard
                 */
                public function testDisplayLeaderBoardValid(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();                   
                    $board=$LeaderBoard->displayLeaderBoard(1, 150); // test input: user id=1, points=150
                    // displays the leaderboard 
                    $wgOut->addHTML($board);               
                }
               
                /**
                 * Tests the displayLeaderBoard function by supplying zero user id and points as input
                 * to display leaderboard
                 */
                public function testDisplayLeaderBoardZero(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();                   
                    $board=$LeaderBoard->displayLeaderBoard(0, 0); // test input: user id=0, points=0
                    // display should say: No data found!
                    $wgOut->addHTML($board);               
                }
                
                /**
                 * Tests the displayLeaderBoard function by supplying invalid user id and points as input
                 * to display leaderboard
                 */
                public function testDisplayLeaderBoardInvalid(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();                   
                    $board=$LeaderBoard->displayLeaderBoard(-2, -100); // test input: user id=-2, points=-100
                    // display should say: No data found!
                    $wgOut->addHTML($board);               
                }
                 
                 /**
                 * Tests the displayLeaderBoard function by supplying null user id and points as input
                 * to display leaderboard
                 */
                public function testDisplayLeaderBoardNull(){
                    global $wgOut;
                    $LeaderBoard = new LeaderBoard();                   
                    $board=$LeaderBoard->displayLeaderBoard(null,null ); // test input: user id=null, points=null
                    // display should say: No data found!
                    $wgOut->addHTML($board);               
                }
}

class TestPoint {

	/**
	 * Tests the GetPointsGenerated function

	 */
	public function TestFunctionGetPointsGeneratedReturnsPoinstGenerated(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getPointsGenerated();
		// displays the result
		$wgOut->addHTML($result);
	}
	
	/**
	 * Tests the setPointsGenerated function by supplying 50 input parameter
	
	 */
	public function TestFunctionSet50PointsGeneratedReturnsGivenPoints(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->setPointsGenerated(50);
		// displays the result
		$wgOut->addHTML($result);
	}
	
	/**
	 * Tests the setPointsGenerated function by supplying 100 input parameter
	
	 */
	public function TestFunctionSet100PointsGeneratedReturnsGivenPoints(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->setPointsGenerated(100);
		// displays the result
		$wgOut->addHTML($result);
	}
	
	/**
	 * Tests the setPointsGenerated function by supplying 0 input parameter
	
	 */
	public function TestFunctionSetZeroPointsGeneratedReturnsGivenPoints(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->setPointsGenerated(0);
		// displays the result
		$wgOut->addHTML($result);
	}
	
	/**
	 * Tests the setPointsGenerated function by supplying -1 input parameter
	
	 */
	public function TestFunctionSetNegativePointsGeneratedReturnsGivenPoints(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->setPointsGenerated(-1);
		// displays the result
		$wgOut->addHTML($result);
	}
	
	/**
	 * Tests the setPointsGenerated function by supplying 500 input parameter
	
	 */
	public function TestFunctionSetInvalidPointsGeneratedReturnsGivenPoints(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->setPointsGenerated(500);
		// displays the result
		$wgOut->addHTML($result);
	}
	
	/**
	 * Tests the getTotalPointsForAllUsers function
	
	 */
	public function TestFunctionGetTotalPointsForAllUsersReturnTotalPointsFromAllusers(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getTotalPointsForAllUsers();
		// displays the result
		foreach ($result as $key=>$value) {
			$wgOut->addHTML($key. ": ".$value);
		}
	}
	
	/**
	 * Tests the getTotalPointsForAllUsers function
	
	 */
	public function TestFunctionGetTotalPointsForAllUsersReturnsNullWhenUserNotFound(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getTotalPointsForAllUsers();
		// displays the result
		foreach ($result as $key=>$value) {
			$wgOut->addHTML($key. ": ".$value);
		}
	}
	
	/**
	 * Tests the getTotalPointsFromUserId function by supplying 1 input parameter
	
	 */
	public function TestFunctionGetTotalPointsFromUserIdReturnsPointsForUserId(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getTotalPointsFromUserId(1);
		// displays the result
		foreach ($result as $key=>$value) {
			$wgOut->addHTML($key. ": ".$value);
		}
	}
	
	/**
	 * Tests the getTotalPointsFromUserId function by supplying 0 input parameter
	
	 */
	public function TestFunctionGetTotalPointsFromZeroUserIdReturnsPointsForUserId(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getTotalPointsFromUserId(0);
		// displays the result
		if (is_array($result)) {
			foreach ($result as $key=>$value) {
				$wgOut->addHTML($key. ": ".$value);
			}
		}
		else{
			$wgOut->addHTML($result);
		}
	}
	
	/**
	 * Tests the getTotalPointsFromUserId function by supplying -1 input parameter
	
	 */
	public function TestFunctionGetTotalPointsFromNegativeUserIdReturnsPointsForUserId(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getTotalPointsFromUserId(-1);
		// displays the result
		if (is_array($result)) {
			foreach ($result as $key=>$value) {
				$wgOut->addHTML($key. ": ".$value);
			}
		}
		else{
			$wgOut->addHTML($result);
		}
	}
	
	/**
	 * Tests the getTotalPointsFromUserId function by supplying null input parameter
	
	 */
	public function TestFunctionGetTotalPointsFromUserIdReturnsNullWhenUserIdNotFound(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getTotalPointsFromUserId(null);
		// displays the result
		if (is_array($result)) {
			foreach ($result as $key=>$value) {
				$wgOut->addHTML($key. ": ".$value);
			}
		}
		else{
			$wgOut->addHTML($result);
		}
	}
	
	/**
	 * Tests the getEditedPostFromUserId function by supplying 1 input parameter
	
	 */
	public function TestFunctionGetEditedPostFromUserIdReturnsEditedPost(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getEditedPostFromUserId(1);
		// displays the result
		if (is_array($result)) {
			foreach ($result as $key=>$value) {
				$wgOut->addHTML($key. ": ".$value);
			}
		}
		else{
			$wgOut->addHTML($result);
		}
	}
	
	/**
	 * Tests the getEditedPostFromUserId function by supplying null input parameter
	
	 */
	public function TestFunctionGetEditedPostFromNullUserIdReturnsInvalid(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getEditedPostFromUserId(null);
		// displays the result
		if (is_array($result)) {
			foreach ($result as $key=>$value) {
				$wgOut->addHTML($key. ": ".$value);
			}
		}
		else{
			$wgOut->addHTML($result);
		}
	}
	
	/**
	 * Tests the getEditedPostFromUserId function by supplying 0 input parameter
	
	 */
	public function TestFunctionGetEditedPostFromZeroUserIdReturnInvalid(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getEditedPostFromUserId(0);
		// displays the result
		if (is_array($result)) {
			foreach ($result as $key=>$value) {
				$wgOut->addHTML($key. ": ".$value);
			}
		}
		else{
			$wgOut->addHTML($result);
		}
	}
	
	/**
	 * Tests the getEditedPostFromUserId function by supplying -1 input parameter
	
	 */
	public function TestFunctionGetEditedPostFromNegativeUserIdReturnInvalid(){
		global $wgOut;
		$Point = new Point();
		$result = $Point->getEditedPostFromUserId(-1);
		// displays the result
		if (is_array($result)) {
			foreach ($result as $key=>$value) {
				$wgOut->addHTML($key. ": ".$value);
			}
		}
		else{
			$wgOut->addHTML($result);
		}
	}
	
	/**
	 * Tests the construct by supplying 0 input parameter
	
	 */
	public function TestFunctionConstructCreates50PointsInstance(){
		global $wgOut;
		$Point = new Point(0);
		$result = $Point->getPointsGenerated();
		// displays the result
		$wgOut->addHTML($result);
	}
	
	/**
	 * Tests the construct by supplying 1 input parameter
	
	 */
	public function TestFunctionConstructCreates100PointsInstance(){
		global $wgOut;
		$Point = new Point(1);
		$result = $Point->getPointsGenerated();
		// displays the result
		$wgOut->addHTML($result);
	}
	
	/**
	 * Tests the construct by supplying -1 input parameter
	
	 */
	public function TestFunctionConstructCreatesNegativePointsInstance(){
		global $wgOut;
		$Point = new Point(-1);
		$result = $Point->getPointsGenerated();
		// displays the result
		$wgOut->addHTML($result);
	}
}

