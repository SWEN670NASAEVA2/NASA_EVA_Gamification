# NASA_EVA_Gamification - PHASE 2

MediaWiki extension for gamification of wiki tasks, based on the requirements of NASA's Extravehicular Activities team.
### This guide is a continuation of [Phase 1](https://github.com/SWEN670NASAEVA/NASA_EVA_Gamification)
Phase 1 was prepared by:  Michael Salgo, Victoria Guadagno, Okechukwu Ogudebe, Jacqueline Macfadyen, Kevin Fortier, and Montrell Nuble


## NASA_EVA_Gamification Extension Installation Instructions

1. Make sure the “LocalSettings.php” file that you saved on the precious section is placed at the root level of the “MediaWiki” folder. 

2. Obtain the code from [GitHub](https://github.com/SWEN670NASAEVA2/NASA_EVA_Gamification)

3. Copy the entire `NASA_EVA_Gamification-master` directory to the `MediaWiki/extensions/NASA_WIKI_Gamification` directory.  Pay attention that when we create the new directory inside the Mediwiki/extensions, we are dropping the “-master” part of the name. 

4. Navigate to the “MediaWiki” directory and open the `LocalSettings.php` file so you can edit it:

	a) Change the default “MediaWiki” logo: 
		Find $wgLogo.  and replace everthing after the '=' sign with the following:
		"$wgResourceBasePath/extensions/NASA_EVA_Gamification/images/nasa-wiki-logo.png";
		
	b) Add global variables:
		Scroll down to the bottom of the page (after the last line) and paste the following lines:


		# Nasa Eva Gamification >> Phase 1
		wfLoadExtension('NASA_EVA_Gamification');
		$wgShowDebug = true;
		$wgDebugComments = true;
		$wgEnableParserCache = false;
		$wgCachePages = false;


		# Nasa Eva Gamification >> Phase 2
		$wgPhase2Images = "$wgResourceBasePath/extensions/NASA_EVA_Gamification/images/";
		$wgProfilePage=$wgServer.$wgResourceBasePath."/index.php/Special:UserGamificationProfile";
		$wgBadges=array('platinum'=>'500','gold'=>'200','silver'=>'100','bronze'=>'50');
		$wgPoints = array(0=>50, 1=>100);
		$wgLeaderBoardPointScale=100;

	c) Save the file.
	
	### Note: $wgShowDebug = true; is for debugging purposes; so, it is recommended to have it set to “true” in a development 	environment and set to “true” in a production environment.

5. Replace the default logo with the NasaWiki gamification logo: open 'LocalSettings.php' and search for $wgLogo.  Replace everthing after the '=' sign with the following:
		"$wgResourceBasePath/extensions/NASA_EVA_Gamification/images/nasa-wiki-logo.png";
	The line should look like:
		$wgLogo = "$wgResourceBasePath/extensions/NASA_EVA_Gamification/images/nasa-wiki-logo.png";
	Save the changes.

6. From a shell prompt,

	a) Navigate to the folder where you have saved the "MediaWiki"
	
	b) Run `php maintenance/update.php`

	### Note: if you get a security error, run the shell prompt as an administrator.

7. Move and replace the following files “From” the specified folder “To” the specified folder.

	a)
		File: WikiPage.php
		From folder: `mediawiki/extensions/NASA_EVA_Gamification/`
		To folder:  `mediawiki/includes/page/`

	b)
	  File: Revision.php
		From folder: `mediawiki/extensions/NASA_EVA_Gamification/`
		To folder:   `mediawiki/includes/`

8. From a shell prompt,

	a) Navigate to the folder where you have saved the `MediaWiki`
	
	b) Run `runphp.cmd`
	

9. Open a web browser and access you local instance: `http:localhost:8080`

	a) From the left hand-side navigation select `Special pages`
	
	b) Scroll down (almost until the end of the page) and verify that under the `Other Special pages` section the "User Gamification Profile" extension has been successfully installed.
	
	c) Click on `User Gamification Profile` to confirm.
	

10. Done.

## Note
This extension was designed for MediaWiki 1.27 or later
