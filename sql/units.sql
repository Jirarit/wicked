DROP TABLE units;

CREATE TABLE units
(
  id smallserial NOT NULL,
  name character varying(50) NOT NULL,
  status character(1) DEFAULT 'A'::bpchar, -- A=Active...
  created timestamp without time zone,
  modified timestamp without time zone,
  create_uid smallint,
  update_uid smallint,
  CONSTRAINT units_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE units
  OWNER TO wicked;
COMMENT ON COLUMN units.status IS 'A=Active
I=Inactive';

INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (1, 'กก', 'A', '2015-02-08 17:00:52', '2015-02-08 17:00:52', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (2, 'กป', 'A', '2015-02-08 17:01:16', '2015-02-08 17:01:16', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (3, 'กล', 'A', '2015-02-08 17:04:45', '2015-02-08 17:04:45', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (4, 'กล่อง', 'A', '2015-02-08 17:05:01', '2015-02-08 17:05:01', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (5, 'กส', 'A', '2015-02-08 17:05:10', '2015-02-08 17:05:10', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (6, 'ก้อน', 'A', '2015-02-08 17:05:20', '2015-02-08 17:05:20', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (7, 'ขวด', 'A', '2015-02-08 17:05:33', '2015-02-08 17:05:33', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (8, 'คู่', 'A', '2015-02-08 17:05:45', '2015-02-08 17:05:45', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (9, 'ชิ้น', 'A', '2015-02-08 17:06:48', '2015-02-08 17:06:48', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (10, 'ถุง', 'A', '2015-02-08 17:06:57', '2015-02-08 17:06:57', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (11, 'ปี๊บ', 'A', '2015-02-08 17:07:05', '2015-02-08 17:07:05', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (12, 'แผง', 'A', '2015-02-08 17:08:39', '2015-02-08 17:08:39', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (13, 'แผ่น', 'A', '2015-02-08 17:08:44', '2015-02-08 17:08:44', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (14, 'แพ็ค', 'A', '2015-02-08 17:08:55', '2015-02-08 17:08:55', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (15, 'ฟอง', 'A', '2015-02-08 17:09:01', '2015-02-08 17:09:01', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (16, 'ม้วน', 'A', '2015-02-08 17:09:08', '2015-02-08 17:09:08', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (17, 'ลูก', 'A', '2015-02-08 17:09:12', '2015-02-08 17:09:12', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (18, 'หลอด', 'A', '2015-02-08 17:09:19', '2015-02-08 17:09:19', 1, 1);
INSERT INTO units (id, name, status, created, modified, create_uid, update_uid) VALUES (19, 'อัน', 'A', '2015-02-08 17:09:27', '2015-02-08 17:09:27', 1, 1);