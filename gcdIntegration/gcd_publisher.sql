/*
-- Query: SELECT gcd_publisher.*
FROM gcd.gcd_publisher 
LEFT JOIN gcd.gcd_country ON gcd_country.id=gcd_publisher.country_id 
WHERE (gcd_country.name="United States" AND gcd_publisher.name="Marvel")
-- Date: 2015-11-02 14:33
*/
INSERT INTO `gcd_publisher` (`id`,`name`,`country_id`,`year_began`,`year_ended`,`notes`,`url`,`is_master`,`parent_id`,`imprint_count`,`brand_count`,`indicia_publisher_count`,`series_count`,`created`,`modified`,`issue_count`,`reserved`,`deleted`,`year_began_uncertain`,`year_ended_uncertain`) VALUES (78,'Marvel',225,1939,NULL,'','http://marvel.com',1,NULL,0,33,102,6948,'1999-06-15 00:00:00','2015-10-28 02:54:51',44982,0,0,0,0);
