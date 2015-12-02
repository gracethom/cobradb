The SQL files in this folder were used to integrate a slimmed down version of the Grand Comics Database (GCD, comics.org) as CoBRA’s authoritative source information for comics issues.

2015-10-29.sql.zip (in Box > CoBRA_shared) - the full dump of the entire GCD database pulled from comics.org (really huge and we didn’t need the whole thing)

GCD_full_STRUCT.sql - contains the creation statements for each of the tables in the GCD database (didn’t need all of these)

GCD_cobra_STRUCT.sql - contains only the table creation information relevant to CoBRA (gcd_country, gcd_publisher, gcd_source, gcd_issue) and without unnecessary foreign key constraints to deleted tables (language, etc.). This script was dumped into the CoBRA MySQL database on IU webserve (the main CoBRA database) and the foreign key connections between activity_fact and gcd_issue were created later through phpMyAdmin GUI.


rawGCDQueries.txt - contains SQL statements used to query the full GCD and export the data we needed as insert statements (below). Series & issue were particularly tricky because we couldn’t include columns that would reference nonexistent tables (language, etc). Compare GCD_full_STRUCT.sql and GCD_cobra_STRUCT to see which columns are not included with the data. MySQL Workbench was used to run these queries on a full instance of the GCD. MySQL Workbench only allows result export as insert statements for one table at a time, which is why there are four separate queries for the data we needed.


The rest of the SQL files - gcd_country.sql, gcd_publisher.sql, gcd_series.sql, and gcd_issue.sql.zip - contain the insert statements for all series and issues published in the United States by Marvel and the series began before 1974. There is only one entry in each gcd_country.sql (United States) and gcd_publisher.sql (Marvel). There are 545 entries in gcd_series.sql and over 15,000 in gcd_issue.sql. These were all dumped into the CoBRA MySQL database on IU webserve (the gcd_issue.sql timed out, but actually uploaded each entry, just have to let it load before querying).
