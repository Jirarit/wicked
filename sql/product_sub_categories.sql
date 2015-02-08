DROP TABLE product_sub_categories;

CREATE TABLE product_sub_categories
(
  id smallserial NOT NULL,
  name character varying(50) NOT NULL,
  product_category_id smallint NOT NULL,
  status character(1) NOT NULL DEFAULT 'A'::bpchar, -- A=Active...
  created timestamp without time zone,
  modified timestamp without time zone,
  create_uid smallint,
  update_uid smallint,
  CONSTRAINT product_sub_categories_pkey PRIMARY KEY (id),
  CONSTRAINT product_sub_categories_name_key UNIQUE (name)
)
WITH (
  OIDS=FALSE
);
COMMENT ON COLUMN product_sub_categories.status IS 'A=Active
I=Inactive';


-- Index: product_sub_categories_product_category_id_idx

-- DROP INDEX product_sub_categories_product_category_id_idx;

CREATE INDEX product_sub_categories_product_category_id_idx
  ON product_sub_categories
  USING btree
  (product_category_id);

-- Index: product_sub_categories_status_idx

-- DROP INDEX product_sub_categories_status_idx;

CREATE INDEX product_sub_categories_status_idx
  ON product_sub_categories
  USING btree
  (status COLLATE pg_catalog."default");

