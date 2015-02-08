DROP TABLE product_movements;

CREATE TABLE product_movements
(
  id bigserial NOT NULL,
  movement_date timestamp without time zone,
  movement_type character(3), -- REC=Receive (+)...
  product_id bigint,
  qty numeric(6,2),
  ref1 bigint, -- Ref Doc ID
  ref2 character varying(32),
  ref3 character varying(32),
  created timestamp without time zone,
  modified timestamp without time zone,
  create_uid smallint,
  update_uid smallint,
  CONSTRAINT product_movements_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE product_movements
  OWNER TO win;
COMMENT ON COLUMN product_movements.movement_type IS 'REC=Receive (+)
PIC=Pick up (-)
DES=Destroy (-)
ADJ=Adjust (+,-)';
COMMENT ON COLUMN product_movements.ref1 IS 'Ref Doc ID';


-- Index: product_movements_movement_date_idx

-- DROP INDEX product_movements_movement_date_idx;

CREATE INDEX product_movements_movement_date_idx
  ON product_movements
  USING btree
  (movement_date);

-- Index: product_movements_movement_type_idx

-- DROP INDEX product_movements_movement_type_idx;

CREATE INDEX product_movements_movement_type_idx
  ON product_movements
  USING btree
  (movement_type COLLATE pg_catalog."default");

-- Index: product_movements_product_id_idx

-- DROP INDEX product_movements_product_id_idx;

CREATE INDEX product_movements_product_id_idx
  ON product_movements
  USING btree
  (product_id);

-- Index: product_movements_ref1_idx

-- DROP INDEX product_movements_ref1_idx;

CREATE INDEX product_movements_ref1_idx
  ON product_movements
  USING btree
  (ref1);

