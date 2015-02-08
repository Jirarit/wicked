DROP TABLE request_details;

CREATE TABLE request_details
(
  id bigserial NOT NULL,
  request_id serial NOT NULL,
  product_id bigint NOT NULL,
  request_qty numeric(6,2) NOT NULL DEFAULT 0,
  receive_qty numeric(6,2) NOT NULL DEFAULT 0,
  created timestamp without time zone,
  modified timestamp without time zone,
  create_uid bigint,
  update_uid bigint,
  CONSTRAINT request_details_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE request_details
  OWNER TO win;

-- Index: request_details_product_id_idx

-- DROP INDEX request_details_product_id_idx;

CREATE INDEX request_details_product_id_idx
  ON request_details
  USING btree
  (product_id);

-- Index: request_details_request_id_idx

-- DROP INDEX request_details_request_id_idx;

CREATE INDEX request_details_request_id_idx
  ON request_details
  USING btree
  (request_id);

