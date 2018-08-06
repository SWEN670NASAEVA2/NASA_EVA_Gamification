-- SQL Objects for NASA EVA Gamification extension

  -- --------------------------------------------
  -- PHASE 2 > rev_points_generated is field needed for storing points
  -- ADD COLUMN TO revision TABLE
  -- ------------------------------------------
ALTER TABLE revision
  	ADD rev_points_generated INT(4) unsigned NOT NULL
  	AFTER rev_page;
