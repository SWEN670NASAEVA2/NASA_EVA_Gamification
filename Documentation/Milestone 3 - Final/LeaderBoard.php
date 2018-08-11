<?php

/**
 * @todo document
 */

class LeaderBoard implements IDBAccessObject {
	
    
	
    /**
     * Displays the name of pages created by a user taking that user ID as input.
     * @param type $clickedUser
     * @return string
     */
     public function displayAddedPages($clickedUser){
         $html="";
         if (is_int($clickedUser) && $clickedUser>=0){
            $mydbr = wfGetDB( DB_SLAVE );
            $query="select distinct page_title,rev_user_text from revision r join page p on r.rev_page=p.page_id
                   where r.rev_user = $clickedUser and rev_parent_id = 0";
            $myres=$mydbr->query($query);
            $html="<div>";
            $counter=0;
            while ($myrow=$mydbr->fetchRow($myres)){
                ++$counter;
                $pageTitle=$myrow['page_title'];
                $userText=$myrow['rev_user_text'];
                if ($counter==1){
                     $html.="Pages created by ".ucfirst($userText).":<br/>";
                }             
                $html.=$pageTitle."<br/>";                            
            } 
            $html.="</div>";
         }
         else{
              $html="<div>User ID must be valid</div>";
         }
         return $html;
     }
     
    /**
     * Displays the name of pages edited by a user by taking that user ID as input.
     * @param type $clickedUser
     * @return string
     */
     public function displayEditedPages($clickedUser){
        $html="";
        if (is_int($clickedUser) && $clickedUser>=0){
            $mydbr = wfGetDB( DB_SLAVE );
            $query="select distinct page_title, rev_user_text from revision r join page p on r.rev_page=p.page_id
                    where r.rev_user = $clickedUser and rev_parent_id != 0";
            $myres=$mydbr->query($query);
            $html="<div>";
            $counter=0;
             while ($myrow=$mydbr->fetchRow($myres)){
                 $pageTitle=$myrow['page_title'];
                 $userText=$myrow['rev_user_text'];
                 ++$counter;
                 if ($counter==1){
                      $html.="Pages edited by ".ucfirst($userText).":<br/>";
                 }                    
                 $html.=$pageTitle."<br/>";                 
             } 
             $html.="</div>";
        }
        else{
            $html="<div>User ID must be valid</div>";
        }
         return $html;
     }

    /**
     * Generates badges on the fly based on points as input.
     * @global type $wgBadges
     * @param type $totalPoints
     * @return array
     */ 
     public function getBadges($totalPoints){
           global $wgBadges;
           $badgesGenerated=array();
           if (is_int($totalPoints) && $totalPoints >=0){
                foreach ($wgBadges as $key => $value) {
                    while ($totalPoints>=$value){
                        array_push($badgesGenerated, $key);
                        $totalPoints-=$value;
                    }
                }
           }
           return $badgesGenerated;
    }
    
   
    /**
     * Displays a scaled leaderboard for a user with points +/-100 of the $userPoints.
     * 
     * @global type $wgPhase2Images
     * @global type $wgProfilePage
     * @global type $wgLeaderBoardPointScale
     * @param type $userId
     * @param type $userPoints
     * @return string
     */
    public function displayLeaderBoard($userId,$userPoints){
        global $wgPhase2Images, $wgProfilePage, $wgLeaderBoardPointScale;
        $html="";
        if (is_int($userId) && $userId>=0 && is_int($userPoints) && $userPoints>=0){
            $min = $userPoints - $wgLeaderBoardPointScale;
            $max = $userPoints + $wgLeaderBoardPointScale;
            $mydbr = wfGetDB( DB_SLAVE );
            $html="<table class='wikitable'>";
            $html.="<tr><th>Username</th><th>Added Post</th><th>Edited Post</th><th>Points</th><th>Badges</th></tr>";
            $query="select r.rev_user, r.rev_user_text as username,
                   (select count(rev_parent_id) from revision where rev_parent_id = 0 and rev_user=r.rev_user) 
                    as added_post, 
                    (select count(rev_parent_id) from revision where rev_parent_id != 0 and rev_user=r.rev_user) 
                    as edited_post, 
                    sum(r.rev_points_generated) as points
                    from my_wiki.revision r join my_wiki.user u on u.user_id=r.rev_user
                    group by r.rev_user 
                    having points between $min and $max
                    order by points desc";
            $myres=$mydbr->query($query);
            $position = 0;
            while ($myrow=$mydbr->fetchRow($myres)){
                    ++$position;
                    $points=$myrow['points'];
                    $currentUser=$myrow['rev_user'];
                    $username=$myrow['username'];
                    $addedPost=$myrow['added_post'];
                    $editedPost=$myrow['edited_post'];
                    if ($currentUser==$userId){
                        $html.="<tr class=\"this_user\"><td>".$username."</td>";
                    }
                    else{
                        $html.="<tr><td>".$username."</td>";
                    }               
                    if ($addedPost==0){
                        $html.="<td>$addedPost</td>";
                    }
                    else{
                       $html.="<td><a href=\"$wgProfilePage?user=".$currentUser."&add=1\">".$addedPost."</a></td>"; 
                    }
                    if ($editedPost==0){
                        $html.="<td>$editedPost</td>";
                    }
                    else{
                       $html.="<td><a href=\"$wgProfilePage?user=".$currentUser."&edit=1\">".$editedPost."</a></td>"; 
                    }     
                    $html.="<td>".$points."</td>";
                    $html.="<td>";
                    $badgesEarned=$this->getBadges(intval($points));
                    $counter=0;
                    $previousBadge="";
                    foreach($badgesEarned as $badge){
                        ++$counter;
                        if ($badge==$previousBadge || $counter==1){
                             $html.="<img src=\"".$wgPhase2Images.$badge.".png\" alt=\"".$badge."\" title=\"".$badge."\" width=\"18\" height=\"25\">";
                        }
                        else{                                            
                             $html.="<br/><img src=\"".$wgPhase2Images.$badge.".png\" alt=\"".$badge."\" title=\"".$badge."\" width=\"18\" height=\"25\">";                       
                        }
                        $previousBadge=$badge;
                    }
                    $html.="</td></tr>";
            } 
            $html.="</table>";
        }
        else{
            $html="<div>Unable to display leaderboard, validate user's ID and points!</div>";
        }
        return $html;
    }
}