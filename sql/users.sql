DROP TABLE users;

CREATE TABLE users
(
  id smallserial NOT NULL,
  login character varying(10) NOT NULL,
  password character varying(32) NOT NULL,
  full_name character varying(100) NOT NULL,
  nick_name character varying(50),
  "position" character(1) NOT NULL, -- A=Admin...
  email character varying(50),
  pic character varying(100),
  status character(1) NOT NULL DEFAULT 'A'::bpchar, -- A=Active...
  created timestamp without time zone,
  modified timestamp without time zone,
  create_uid smallint,
  update_uid smallint,
  CONSTRAINT users_pkey PRIMARY KEY (id),
  CONSTRAINT users_login_key UNIQUE (login)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE users
  OWNER TO win;
COMMENT ON COLUMN users."position" IS 'A=Admin
S=Staff';
COMMENT ON COLUMN users.status IS 'A=Active
I=Inactive';


-- Index: users_login_idx

-- DROP INDEX users_login_idx;

CREATE INDEX users_login_idx
  ON users
  USING btree
  (login COLLATE pg_catalog."default");

-- Index: users_status_idx

-- DROP INDEX users_status_idx;

CREATE INDEX users_status_idx
  ON users
  USING btree
  (status COLLATE pg_catalog."default");


INSERT INTO users (login, password, full_name, nick_name, position, email, pic, created, modified, create_uid, update_uid) 
VALUES ('admin', 'c3284d0f94606de1fd2af172aba15bf3', 'Administrator', 'Admin', 'A', 'admin@wicked.com', '1.png', now(), now(), '1', '1');