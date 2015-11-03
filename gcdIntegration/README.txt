The SQL files in this folder were used to integrate a slimmed down version of the Grand Comics Database (GCD, comics.org) as CoBRA’s authoritative source information for comics issues.

2015-10-29.sql.zip (in Box > CoBRA_shared) - the full dump of the entire GCD database pulled from comics.org (really huge and we didn’t need the whole thing)

GCD_full_STRUCT.sql - contains the creation statements for each of the tables in the GCD database (didn’t need all of these)

GCD_cobra_STRUCT.sql - contains only the table creation information relevant to CoBRA (gcd_country, gcd_publisher, gcd_source, gcd_issue) and without unnecessary foreign key constraints to deleted tables (language, etc.). This script was dumped into the CoBRA MySQL database on IU webserve (the main CoBRA database) and the foreign key connections between activity_fact and gcd_issue were created later through phpMyAdmin GUI.

The rest of the files - gcd_country.sql, gcd_publisher.sql, gcd_series.sql, and gcd_issue.sql.zip - contain the insert statements for all series and issues published in the United States by Marvel and the series began before 1974. There is only one entry in each gcd_country.sql (United States) and gcd_publisher.sql (Marvel). There are 545 entries in gcd_series.sql and over 15,000 in gcd_issue.sql. These were all dumped into the CoBRA MySQL database on IU webserve (the gcd_issue.sql timed out, but actually uploaded each entry, just have to let it load before querying).

See the following SQL statements used to grab these insert statements. Series & issue were particularly tricky because we couldn’t include columns that would reference nonexistent tables (language, etc). Compare GCD_full_STRUCT.sql and GCD_cobra_STRUCT to see which columns are not included with the data. MySQL Workbench was used to run these queries on a full instance of the GCD. MySQL Workbench only allows result export as insert statements for one table at a time, which is why there are four separate queries for the data we needed.





SQL Queries for GCD

GCD Query for limited data published by Marvel in the United States starting before 1974

SELECT gcd_series.id AS 'series id', gcd_issue.id AS 'issue id', gcd_series.name AS 'series name', gcd_series.year_began AS 'series year began', gcd_issue.number AS 'issue num', gcd_issue.volume AS 'issue vol', gcd_issue.publication_date AS 'issue pub date', gcd_country.name AS 'country', gcd_publisher.name AS 'publisher'
FROM gcd.gcd_issue 
LEFT JOIN gcd.gcd_series ON gcd_series.id=gcd_issue.series_id 
LEFT JOIN gcd.gcd_publisher ON gcd_publisher.id=gcd_series.publisher_id 
LEFT JOIN gcd.gcd_country ON gcd_country.id=gcd_publisher.country_id 
WHERE (gcd_country.name="United States" AND gcd_publisher.name="Marvel" AND gcd_series.year_began<1974)
ORDER BY gcd_series.name;



GCD Query for United States

SELECT gcd_country.*
FROM gcd.gcd_country
WHERE (gcd_country.name="United States");

GCD Query for Marvel published in the United States

SELECT gcd_publisher.*
FROM gcd.gcd_publisher 
LEFT JOIN gcd.gcd_country ON gcd_country.id=gcd_publisher.country_id 
WHERE (gcd_country.name="United States" AND gcd_publisher.name="Marvel");

GCD Query for all Marvel series published in the United States starting before 1974

SELECT gcd_series.id, gcd_series.name, gcd_series.sort_name, gcd_series.format, gcd_series.year_began, gcd_series.year_began_uncertain, gcd_series.year_ended, gcd_series.year_ended_uncertain, gcd_series.publication_dates, gcd_series.is_current, gcd_series.publisher_id, gcd_series.country_id, gcd_series.tracking_notes, gcd_series.notes, gcd_series.publication_notes, gcd_series.has_gallery, gcd_series.open_reserve, gcd_series.issue_count, gcd_series.created, gcd_series.modified, gcd_series.reserved, gcd_series.deleted, gcd_series.has_indicia_frequency, gcd_series.has_isbn, gcd_series.has_barcode, gcd_series.has_issue_title, gcd_series.has_volume, gcd_series.is_comics_publication, gcd_series.color,dimensions, gcd_series.paper_stock, gcd_series.binding, gcd_series.publishing_format, gcd_series.has_rating, gcd_series.is_singleton
FROM gcd.gcd_series  
LEFT JOIN gcd.gcd_publisher ON gcd_publisher.id=gcd_series.publisher_id 
LEFT JOIN gcd.gcd_country ON gcd_country.id=gcd_publisher.country_id 
WHERE (gcd_country.name="United States" AND gcd_publisher.name="Marvel" AND gcd_series.year_began<1974)
ORDER BY gcd_series.name;


GCD Query for all issues of Marvel series published in the United States starting before 1974

SELECT gcd_issue.id, gcd_issue.number, gcd_issue.volume, gcd_issue.no_volume, gcd_issue.display_volume_with_number, gcd_issue.series_id, gcd_issue.indicia_pub_not_printed, gcd_issue.no_brand, gcd_issue.publication_date, gcd_issue.key_date, gcd_issue.sort_code, gcd_issue.price, gcd_issue.page_count, gcd_issue.page_count_uncertain, gcd_issue.indicia_frequency, gcd_issue.no_indicia_frequency, gcd_issue.editing, gcd_issue.no_editing, gcd_issue.notes, gcd_issue.created, gcd_issue.modified, gcd_issue.reserved, gcd_issue.deleted, gcd_issue.is_indexed, gcd_issue.isbn, gcd_issue.valid_isbn, gcd_issue.no_isbn, gcd_issue.variant_of_id, gcd_issue.variant_name, gcd_issue.barcode, gcd_issue.no_barcode, gcd_issue.title, gcd_issue.no_title, gcd_issue.on_sale_date, gcd_issue.on_sale_date_uncertain, gcd_issue.rating, gcd_issue.no_rating
FROM gcd.gcd_issue 
LEFT JOIN gcd.gcd_series ON gcd_series.id=gcd_issue.series_id 
LEFT JOIN gcd.gcd_publisher ON gcd_publisher.id=gcd_series.publisher_id 
LEFT JOIN gcd.gcd_country ON gcd_country.id=gcd_publisher.country_id 
WHERE (gcd_country.name="United States" AND gcd_publisher.name="Marvel" AND gcd_series.year_began<1974)
ORDER BY gcd_series.name;