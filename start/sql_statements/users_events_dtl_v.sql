CREATE OR REPLACE VIEW users_events_dtl_v
  AS SELECT A.*, B.* 
  FROM users_events_v A JOIN events B
    ON  A.event_id  = B.eID;
