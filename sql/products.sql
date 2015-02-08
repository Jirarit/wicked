DROP TABLE products;

CREATE TABLE products
(
  id bigserial NOT NULL,
  product_no character varying(15),
  product_name character varying(100),
  product_category_id smallint NOT NULL,
  product_sub_category_id smallint NOT NULL,
  unit_id smallint,
  par_stock numeric(6,2) NOT NULL DEFAULT 0,
  onhand_qty numeric(6,2) NOT NULL DEFAULT 0,
  last_update_onhand timestamp without time zone DEFAULT '1900-01-01 00:00:00'::timestamp without time zone,
  status character(1) DEFAULT 'A'::bpchar, -- A=Active...
  created timestamp without time zone,
  modified timestamp without time zone,
  create_uid smallint,
  update_uid smallint,
  CONSTRAINT products_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE products
  OWNER TO wicked;
COMMENT ON COLUMN products.status IS 'A=Active
I=Inactive';


-- Index: products_par_stock_onhand_qty_idx

-- DROP INDEX products_par_stock_onhand_qty_idx;

CREATE INDEX products_par_stock_onhand_qty_idx
  ON products
  USING btree
  (par_stock, onhand_qty);

-- Index: products_product_category_id_product_sub_category_id_idx

-- DROP INDEX products_product_category_id_product_sub_category_id_idx;

CREATE INDEX products_product_category_id_product_sub_category_id_idx
  ON products
  USING btree
  (product_category_id, product_sub_category_id);

-- Index: products_product_name_idx

-- DROP INDEX products_product_name_idx;

CREATE INDEX products_product_name_idx
  ON products
  USING btree
  (product_name COLLATE pg_catalog."default");

-- Index: products_product_no_idx

-- DROP INDEX products_product_no_idx;

CREATE INDEX products_product_no_idx
  ON products
  USING btree
  (product_no COLLATE pg_catalog."default");

-- Index: products_status_idx

-- DROP INDEX products_status_idx;

CREATE INDEX products_status_idx
  ON products
  USING btree
  (status COLLATE pg_catalog."default");


INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170168','ไก่เลิกเหล้า (W)','1','0','14','15','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170176','ซี่โครงหมูกอและ (W)','1','0','14','10','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170171','ซี่โครงหมูแดง (W)','1','0','14','20','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170173','น่องไก่พะโล้ (W)','1','0','14','20','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170177','สันคอหมูหมัก (W)','1','0','14','20','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170162','หมูบูตะ','1','0','14','20','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170178','บักกุเต๋','1','0','14','10','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170163','ปลาแซลม่อนแร่ 120 กรัม','1','0','14','20','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170174','ปลาหมึกวง (W)','1','0','14','20','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-104137','เศษปลาแซลมอน','1','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-172124','ซอสเคอรีเวิร์ส (W)','2','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-172105','ซอสเทอริยากิยูสุ','2','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-172101','ซอสผัดไทย','2','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-172104','ซอสเพสโต้แองโซวี่','2','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-172111','ซอสมะเขือเทศ (สปริง)','2','0','14','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-172126','ซอสหมูแดง (W)','2','0','14','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-173118','น้ำมะขามเปียก','2','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-173106','น้ำสลัดญี่ปุ่น (น้ำสลัดแซลมอน)','2','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-172123','น้ำพริกเผา','2','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-171105','พริกแกงสด','2','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170161','ไข่ออนเซิน','3','0','15','15','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-140101','ไข่ไก่ เบอร์ 2','3','0','12','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-142101','ครีมชีส  ฟิลาเดลเฟีย  2 กิโลกรัม','3','0','4','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-142102','เนยจืดอลาวรี่  5 kg.','3','0','4','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-142104','มายองเนส ตราคิวพี','3','0','14','4','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-142105','วิปปิ้งครีมคูลินารีครีม For Cooking 1 Lite','3','0','4','4','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-142109','มาสคาโพนชีส','3','0','2','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-142111','มอสซาเลร่าชีส (เส้น)','3','0','10','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-142116','พาเมซานชีส สามเหลี่ยม 1/200g','3','0','6','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-103107','ไก่บด','4','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-105118','หมูบด','4','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-105135','ไส้กรอกแฮม','4','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-103127','ไก่ทอด คาราเกะ(900g/แพ็ค)(6แพ็ค/กล่อง)','4','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-104149','กุ้งขาวปอกเปลือกผ่าหลังไว้หาง(IQF) 21-25ตัว/ปอนด์','4','0','1','4','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-104103','ปูนิ่ม size L pack/4 ตัว/กก.','4','0','1','4','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-104109','ปลาแซลม่อนรมควัน พรีสไลส์ 1000 กรัม','4','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-104120','ไข่ปลาแซลม่อน (แพ็ค 500 กรัม)','4','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-104150','ไข่ปู สีส้ม (โตบิโก๊ะ) 500g/แพ็ค','4','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-105136','น้ำต้มกระดูกไก่ 100% (Pure) Frozen','4','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-11-112131','มันฝรั่งติดเปลือก แบบเวจ(เสี้ยวพระจันทร์)2.27kg*6ถุง','4','0','10','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-11-114141','เฟรนฟรายด์ (แบบขด)','4','0','10','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-11-114134','ถั่วอีดามาเมะ (ถั่วแระญี่ปุ่น) 5กก/แพ็ค','4','0','1','0.5','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150111','แผ่นนาโช่ (ตอติญ่า)เอลชาโร8 นิ้ว','4','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150125','แผ่นนาโช่ (ตอติญ่า) ดานิต้า 8 นิ้ว','4','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-10-104152','ดีหมึก','4','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-11-111129','หอมแดงไทย  (ตัดแต่ง)','5','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-11-111130','กระเทียมจีนตัดจุก (ตัดแต่ง)','5','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-12-120103','มะนาวแป้นเขียว #400','5','0','17','20','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-12-120104','มะนาวเหลือง Yellow Lemon','5','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-11-114155','กวางตุ้งฮ่องกงขนาดเล็ก (Bocchoy)','5','0','1','0.8','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-11-114154','ฟักทอง ญี่ปุ่น (สั่งล่วงหน้า 2 วัน)','5','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150137','ขนมปังบาแกตต์','6','0','9','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('3-34-340159','ขนมปังบียอส Brioche 6ชิ้น/แถว (W)','6','0','9','12','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-151121','เส้นบะหมี่ญี่ปุ่น (นำชัย) 500g/แพ็ค','6','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-151125','เส้นยากิโซบะ(500g/แพ็ค)(สั่งล่วงหน้า2วัน)','6','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170160','เกล็ดขนมปังเครื่องเทศ','6','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-17-170109','เห็ดหวาน','6','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132123','มิโซสีกลาง 1kg(เต้าเจี๊ยว)','6','0','10','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132159','วาซาบิ โทคุเซ็น 400g/แพ็ค','6','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160132','งาบด (ขวดใหญ่) Sesami paste','6','0','2','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132126','ยูสุโคโช ซอสพริก 85 กรัม','6','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160111','ปลาแองโชวี่ (กระป๋องใหญ่)','6','0','2','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-130106','White Truffle Oil (น้ำมันเห็ดทัพเพิล)','6','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160180','แคปหมู(150กรัม/แพ็ค)','6','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-134103','ใบกระวาน (เบย์ลีฟ) 15 กรัม','7','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-134132','พริกไทยดำเม็ด  ','7','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-134128','พริกไทยป่นขวด ตราไร่ทิพย์ 60 กรัม','7','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160101','พริกป่น บางช้าง','7','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160157','สโมกปาปิก้า(Smoked Hot Paprika)','7','0','2','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132118','ฮอนดาชิ (ผงชูรสญี่ปุ่น) 1 kg.','7','0','4','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132189','ผงวิงแซ่บ','7','0','10','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-134133','ผงต้มยำ(ตรา สไปซ์สตอรี่)','7','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150107','แป้งข้าวเจ้า','8','0','10','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150102','แป้งข้าวโพด 1กก.','8','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150136','แป้งเทมปุระ (Tempura Mix R) ตัวใหม่','8','0','14','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150103','แป้งสาลี ตราว่าว 1 กิโลกรัม (แป้งเอนกประสงค์)','8','0','1','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150140','แป้งมัน สำปะหลัง','8','0','10','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132150','น้ำตาลทรายขาว ตราลิน 1 กก. 25ถุง/กระสอบ','8','0','1','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132110','น้ำตาลทรายแดง 1 กิโลกรัม','8','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132112','น้ำตาลปิ๊บ (มิตรผล) 1kg/แพ็ค','8','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132117','เกลือปรุงทิพย์ 1 กิโลกรัม','8','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-152102','ข้าวญี่ปุ่น Haruka  5 กก./ถุง','9','0','10','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-152112','ข้าวหอมมะลิคัดพิเศษ 100% (ลูกค้า) ตราหงส์ทอง 49 กิโลกรัม','9','0','5','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-152110','ข้าวเหนียวใหม่เขี้ยวงู 49กก./กระสอบ','9','0','5','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-152114','ข้าวกล้องไรซ์เบอรี่','9','0','1','5','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-151101','เส้นเพนเน่ 87  แอคเนซี   500 กรัม','9','0','14','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-151113','เส้นสปาเก็ตตี้ เบอร์ 1 แอคนีซี 500 กรัม','9','0','14','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-151104','เส้นสปาเก็ตตี้ เบอร์ 3  แอคนีซี  500 กรัม','9','0','14','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-151126','เส้นหมี่ไวไว อบแห้ง  (180g/แพ็ค)','9','0','14','5','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150110','ใบเมี่ยงญวน','9','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132161','ซอสพริก ศรีราชา (แดง)','10','0','7','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132177','ซีอิ้วขาว ตราเด็กสมบูรณ์ สูตร1ขนาด1000 cc','10','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132108','ซีอิ้วญี่ปุ่น (โชยุ) kikkoman 1000 มล.','10','0','7','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132170','ซีอิ้วดำ ตราเด็กสมบูรณ์ สูตร 5 ขนาด 940 กรัม','10','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132157','น้ำปลาทิพย์รส ฉลากเหลือง 4500 มล.','10','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-130105','น้ำมันงาตรามังกรคู่','10','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-130103','น้ำมันมะกอก Pure 5 ลิตร','10','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-130101','น้ำมันรำข้าวคิง 18 ลิตร','10','0','11','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-130104','น้ำมันหอยนางรม ตราเด็กสมบูรณ์  6 kg.','10','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132129','น้ำส้มสายชูหมักจากข้าวหอมมะลิ คิวพี','10','0','7','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132125','น้ำส้มสายชูกลั่น คิวพี 3 ลิตร (1ลัง/6แกลลอน)','10','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132102','ซอสเทนดูริ 300 มล. (แพ็ค/6)','10','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132146','Tabasco 60 ml.','10','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132145','ซอสมะเขือเทศ ไฮน์ ขวดเล็ก','10','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132119','กะทิอร่อยดี UHT 1000 ml.','11','0','4','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-15-150101','เกล็ดขนมปัง Crumb  1 กิโลกรัม','11','0','10','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160163','เก่ากี้','11','0','1','0.3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160115','เห็ดหอมแห้ง','11','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160143','งาขาว','11','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-161102','ถั่วลิสงเลาะเปลือก','11','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-161101','เม็ดมะม่วงหิมพานต์','11','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160106','สาหร่ายโนริ เกรด A (No cut)','11','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160141','สาหร่ายวากาเมะ (แห้ง)','11','0','1','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-16-160107','สาหร่ายแห้งป่น 100 กรัม','11','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('3-33-330101','ผงฟู ตราเบสท์ฟู้ดส์  1kg. Baking Powder','11','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('3-33-330103','ผงเบคกิ้งโซดา  1kg. Baking Soda','11','0','10','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-133108','แตงกวาดอง cornichon','11','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-133103','เมล็ดเคเปอร์ในน้ำเกลือ ฟรากาตา 240 กรัม','11','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132113','น้ำผึ้งเวชพงศ์','11','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132132','เหล้าจีนฮวยเตียงตราเจดีย์640มล(ฉลากฟ้าเจดีย์เหลือง','11','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132122','มิริน Hinode Mirin 1.8 Lite','11','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-13-132131','สาเก Mizkan เรียวริชู สาเกปรุงรส 1.8 ลิตร','11','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('1-14-142133','มัสตาร์ด (ขวดบีบ) 226g','11','0','7','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411101','กระดาษทิชชู่แบบม้วนคู่ 24แพ็ค/ลัง','12','0','14','4','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411131','กระดาษไขพิเศษ ขนาด 40*60 นิ้ว (กล่อง/500แผ่น)','12','0','13','50','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411185','กระดาษรองขนม ขนาด20*20cm. พิมพ์ด้านมัน (W)','12','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411141','ถุงขยะดำ ไทย-แบล็ค 36*45','13','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411136','ถุงขยะดำไทย-แบล็ค 24*28','13','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411135','ถุงขยะดำไทย-แบล็ค 30*40','13','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411114','ถุงน้ำตาลหูเกลียว 21*11*29 cm. ยี่ห้อ Aro','13','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411110','ถุงร้อน 14*22','13','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411111','ถุงร้อน 4*6 ขนาด  2 กิโลกรัม/แพ็ค','13','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411109','ถุงร้อน 6*9','13','0','14','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411102','กล่องข้าวพลาสติก+ฝา กล่องเหลี่ยม  ขนาด 650 ml.','14','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411103','กล่องชาม + ฝา กล่องกลม  650 ml.','14','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411104','ถ้วยน้ำจิ้ม+ฝา 50 ใบ 4oz.','14','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-412117','ช้อนพลาสติกสีดำ (100ชิ้น/แพ็ค)','14','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-412146','ส้อมพลาสติกใส (1แพ็ค*100ชิ้น)','14','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-412145','มีดพลาสติกใส (1แพ็ค*100ชิ้น)','14','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-412124','ผ้า Sponge','15','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411133','ฟองน้ำล้างจานตาข่าย  3m (6ชิ้น/แพ็ค)','15','0','9','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411132','สก็อตไบรต์ 3M ขนาด 4x6 12ชิ้น/แพ็คคู่','15','0','9','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('5-54-540131','ถุงมือยางส้ม','15','0','8','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411137','ถุงมือแพทย์ (เชฟการ์ด) 100 ชิ้น','15','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-40-400189','น้ำยาทำความสะอาดเครื่องใช้ห้องครัว','16','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-40-400106','น้ำยาล้างจานด้วยมือ (หน้าร้าน)','16','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-40-400185','ครีมทำความสะอาดขัดเงาโลหะ (เมทัล คลีนเนอร์)','16','0','18','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-40-400120','น้ำยาล้างจานด้วยเครื่อง(Summer)ฝาสีขาวโอเมก้า ซี','16','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-40-400191','น้ำยาเคลือบแห้งจาน (Summer) โอเมก้า ซี','16','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-40-400188','เคมีล้างเครื่องล้างจาน (Summer) โอเมก้า ซี','16','0','3','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411105','แก๊สกระป๋อง Aiko 220 กรัม (1x3)','17','0','2','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411106','ปืนยิงแก๊ส','17','0','19','3','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411120','ฟิล์มใสถนอมอาหาร  30ซ.ม.* 500 เมตร','17','0','16','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411149','อลูมิเนียมฟอยส์ 45cc*75m','17','0','4','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411116','หนังยางวงเล็ก','17','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411184','หนังยางวงใหญ่','17','0','10','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('4-41-411118','ไม้เสียบอาหาร 8  นิ้ว  ใช้ในครัว','17','0','14','1','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
INSERT INTO products (product_no, product_name, product_category_id, product_sub_category_id, unit_id, par_stock, created, modified, create_uid, update_uid) VALUES ('8-81-810132','เทปใสแกนเล็ก 3M 18มม.x33มม (ม้วนเล็ก)','17','0','16','2','2015-02-08 17:38:00','2015-02-08 17:38:00','1','1');
