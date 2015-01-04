CREATE OR REPLACE VIEW events_all_v
      AS SELECT  events.*
         FROM events 
      UNION
         SELECT A.eID,           A.eventName,    A.location,      A.genre,
                A.url,           B.sdate_time,   B.edate_time,    A.privacy,
                A.event_descr,   A.event_status, A.addr_id,       A.parent_event_id,
                A.tag_1,         A.tag_2,        A.tag_3,         A.tag_4,
                A.tag_5,         A.tag_6
         FROM events A JOIN repeat_events B 
           ON A.eID  = B.event_id;

