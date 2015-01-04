CREATE OR REPLACE VIEW  events_address_users_v 
  AS SELECT A.*, B.*
     FROM events_address_v A LEFT JOIN users_events_v B 
         ON A.eID = B.event_id;

