CREATE OR REPLACE VIEW events_address_v
  AS SELECT A.*,
           B.street_no,   B.street_name,  B.street_direct_code,  B.city,
           B.postal_code, B.country_code, B.province_code,       B.misc_addr_line,
           B.addr_tel_no, B.addr_email,   B.latitude,            B.longitude
       FROM events_all_v A LEFT JOIN address B 
        ON A.addr_id = B.addr_id;
