DROP TABLE requests;

CREATE TABLE requests
(
  id serial NOT NULL,
  request_date date NOT NULL,
  status character(1) NOT NULL DEFAULT 'N'::bpchar, -- N=New...
  receive_date timestamp without time zone,
  receive_uid smallint,
  created timestamp without time zone,
  modified timestamp without time zone,
  create_uid smallint,
  update_uid smallint,
  CONSTRAINT requests_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE requests
  OWNER TO win;
COMMENT ON COLUMN requests.status IS 'N=New
R=Received';


-- Index: requests_receive_date_idx

-- DROP INDEX requests_receive_date_idx;

CREATE INDEX requests_receive_date_idx
  ON requests
  USING btree
  (receive_date DESC NULLS LAST);

-- Index: requests_request_date_idx

-- DROP INDEX requests_request_date_idx;

CREATE INDEX requests_request_date_idx
  ON requests
  USING btree
  (request_date DESC NULLS LAST);

-- Index: requests_status_idx

-- DROP INDEX requests_status_idx;

CREATE INDEX requests_status_idx
  ON requests
  USING btree
  (status COLLATE pg_catalog."default");

