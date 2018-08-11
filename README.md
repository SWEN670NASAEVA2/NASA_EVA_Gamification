# NASA_EVA_Gamification

MediaWiki extension for gamification of wiki tasks, based on the requirements of NASA's Extravehicular Activities team.

## NASA_EVA_Gamification Extension Installation Instructions

1. Obtain the code from [GitHub](https://github.com/SWEN670NASAEVA2/NASA_EVA_Gamification)

2. From the extracted files and folders, move the entire folder called `NASA_EVA_Gamification` inside `mediawiki/extensions/` folder.

3. Add the following code at the bottom of your `LocalSettings.php` file and save the changes:

		# Nasa Eva Gamification >> Phase 1
		wfLoadExtension(
		'NASA_EVA_Gamification' );
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

4. Replace the default logo with the NasaWiki gamification logo: open 'LocalSettings.php' and search for $wgLogo.  Replace everthing after the '=' sign with the following:
		"$wgResourceBasePath/extensions/NASA_EVA_Gamification/images/nasa-wiki-logo.png";
	The line should look like:
		$wgLogo = "$wgResourceBasePath/extensions/NASA_EVA_Gamification/images/nasa-wiki-logo.png";
	Save the changes.

5. From a shell prompt,
	a) Navigate to the folder where you have saved the "MediaWiki"
	b) Run `php maintenance/update.php`

	### Note: if you get a security error, run the shell prompt as an administrator.

6. Move and replace the following files “From” the specified folder “To” the specified folder.
	a)
		File: WikiPage.php
		From folder: `mediawiki/extensions/NASA_EVA_Gamification/`
		To folder:  `mediawiki/includes/page/`

	b)
	  File: Revision.php
		From folder: `mediawiki/extensions/NASA_EVA_Gamification/`
		To folder:   `mediawiki/includes/`

7. From a shell prompt,
	a) Navigate to the folder where you have saved the `MediaWiki`
	b) Run `runphp.cmd`

8. Open a web browser and access you local instance: `http:localhost:8080`
	a) From the left hand-side navigation select `Special pages`
  b) Scroll down (almost until the end of the page) and verify that under the `Other Special pages` section the "User Gamification Profile" extension has been successfully installed.
	c) Click on `User Gamification Profile` to confirm.

9. Done.

## Note
This extension was designed for MediaWiki 1.27 or later
