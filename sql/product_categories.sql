DROP TABLE product_categories;

CREATE TABLE product_categories
(
  id smallserial NOT NULL,
  name character varying(50) NOT NULL,
  sort smallint NOT NULL DEFAULT 0,
  status character(1) NOT NULL DEFAULT 'A'::bpchar, -- A=Active...
  created timestamp without time zone,
  modified timestamp without time zone,
  create_uid smallint,
  update_uid smallint,
  CONSTRAINT product_categories_pkey PRIMARY KEY (id),
  CONSTRAINT product_categories_name_key UNIQUE (name)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE product_categories
  OWNER TO wicked;
COMMENT ON COLUMN product_categories.status IS 'A=Active
I=Inactive';


-- Index: product_categories_status_idx

-- DROP INDEX product_categories_status_idx;

CREATE INDEX product_categories_status_idx
  ON product_categories
  USING btree
  (status COLLATE pg_catalog."default");



INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (1, 'Meat & Seafood / เนื้อสัตว์และอาหารทะเล', 10, 'A', '2015-02-08 16:35:01', '2015-02-08 16:35:01', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (2, 'Sauce & Salad Dressing / ซอสและน้ำสลัด', 20, 'A', '2015-02-08 16:36:53', '2015-02-08 16:36:53', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (3, 'Egg & Dairy Products / ไข่และผลิตภัณฑ์จากนม', 30, 'A', '2015-02-08 16:37:49', '2015-02-08 16:37:49', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (4, 'Frozen Products / ผลิตภัณฑ์แช่แข็ง', 40, 'A', '2015-02-08 16:38:28', '2015-02-08 16:38:28', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (5, 'Vegetable & Fruit / ผักและผลไม้', 50, 'A', '2015-02-08 16:40:58', '2015-02-08 16:40:58', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (6, 'A Others / อื่นๆ', 60, 'A', '2015-02-08 16:41:09', '2015-02-08 16:41:09', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (7, 'Spices & Seasoning / เครื่องเทศและผงปรุงรส', 70, 'A', '2015-02-08 16:41:19', '2015-02-08 16:41:19', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (8, 'Flour, Sugar & Salt / แป้ง,น้ำตาลและเกลือ', 80, 'A', '2015-02-08 16:41:31', '2015-02-08 16:41:31', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (9, 'Rice, Pasta & Noodle / ข้าว, เส้นพาสต้าและเส้นหมี่', 90, 'A', '2015-02-08 16:41:39', '2015-02-08 16:41:39', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (10, 'Sauce, Vinegar & Oil / ซอส, น้ำส้มสายชูและน้ำมัน', 100, 'A', '2015-02-08 16:41:50', '2015-02-08 16:41:50', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (12, 'Paper / กระดาษ', 120, 'A', '2015-02-08 16:43:44', '2015-02-08 16:43:44', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (13, 'Bag / ถุง', 130, 'A', '2015-02-08 16:43:55', '2015-02-08 16:43:55', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (14, 'Plastic Box & Cutlery / กล่องและช้อนส้อมพลาสติก', 140, 'A', '2015-02-08 16:44:05', '2015-02-08 16:44:05', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (11, 'B Other / อื่นๆ', 110, 'A', '2015-02-08 16:42:19', '2015-02-08 16:45:54', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (15, 'Cleaning Equipments / อุปกรณ์ทำความสะอาด', 150, 'A', '2015-02-08 16:44:34', '2015-02-08 16:47:07', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (16, 'Chemical Products / ผลิตภัณฑ์เคมี', 160, 'A', '2015-02-08 16:44:44', '2015-02-08 16:46:45', 1, 1);
INSERT INTO product_categories (id, name, sort, status, created, modified, create_uid, update_uid) VALUES (17, 'C Other / อื่นๆ', 170, 'A', '2015-02-08 16:42:19', '2015-02-08 16:45:54', 1, 1);