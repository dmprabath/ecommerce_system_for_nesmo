

CREATE TABLE `tbl_backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_date` date NOT NULL,
  `backup_time` time NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `backup_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_backupVALUES("1","2020-01-11","17:51:31","db_1578745291","EMP00001","1");





CREATE TABLE `tbl_batch` (
  `bat_id` varchar(10) NOT NULL,
  `grn_id` int(10) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `bat_cprice` float(15,2) NOT NULL,
  `bat_sprice` float(15,2) NOT NULL,
  `bat_qty` int(11) NOT NULL,
  `bat_rem` int(11) NOT NULL,
  `bat_rdate` date NOT NULL,
  `total_price` float(15,2) NOT NULL,
  `bat_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`bat_id`),
  KEY `prod_id` (`prod_id`),
  KEY `fk_grn` (`grn_id`),
  CONSTRAINT `fk_grn` FOREIGN KEY (`grn_id`) REFERENCES `tbl_grn` (`grn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_batch_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_batchVALUES("BAT00001","1","PRO00001","37000.00","43000.00","20","15","2018-04-08","740000.00","1");
INSERT INTO tbl_batchVALUES("BAT00002","2","PRO00007","79000.00","95000.00","30","24","2018-05-30","2370000.00","1");
INSERT INTO tbl_batchVALUES("BAT00003","3","PRO00005","1400.00","2700.00","300","286","2018-06-02","420000.00","1");
INSERT INTO tbl_batchVALUES("BAT00004","3","PRO00002","2200.00","2800.00","300","290","2018-06-02","660000.00","1");
INSERT INTO tbl_batchVALUES("BAT00005","3","PRO00012","2800.00","3600.00","300","299","2018-06-02","840000.00","1");
INSERT INTO tbl_batchVALUES("BAT00006","4","PRO00003","35000.00","40000.00","50","49","2020-01-09","1750000.00","1");
INSERT INTO tbl_batchVALUES("BAT00007","4","PRO00004","52000.00","57000.00","70","70","2020-01-09","3640000.00","1");





CREATE TABLE `tbl_category` (
  `cat_id` varchar(10) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_categoryVALUES("CAT00001","domestic");
INSERT INTO tbl_categoryVALUES("CAT00002","commercial");
INSERT INTO tbl_categoryVALUES("CAT00003","accessories");





CREATE TABLE `tbl_cus_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` varchar(10) NOT NULL,
  `line1` varchar(100) NOT NULL,
  `line2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL,
  `province` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cus_id` (`cus_id`),
  CONSTRAINT `tbl_cus_address_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO tbl_cus_addressVALUES("2","CUS00001","sample","sample 2","Beliattass","Mullaitivu","Eastern");
INSERT INTO tbl_cus_addressVALUES("3","CUS00003","parassgahena","kudaheella","Beliatta","Polonnaruwa","Southern");
INSERT INTO tbl_cus_addressVALUES("4","CUS00002","","","","","");
INSERT INTO tbl_cus_addressVALUES("5","CUS00005","kasun niwasa","pathirage road","maharagama","Colombo","Western");
INSERT INTO tbl_cus_addressVALUES("6","CUS00006","62/9","st ritas rd","rathmalana","Colombo","Western");





CREATE TABLE `tbl_cus_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` varchar(10) NOT NULL,
  `notif_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cust` (`cus_id`),
  KEY `fk_noti` (`notif_id`),
  CONSTRAINT `fk_cust` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_noti` FOREIGN KEY (`notif_id`) REFERENCES `tbl_notification` (`not_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO tbl_cus_notificationVALUES("1","CUS00003","1");
INSERT INTO tbl_cus_notificationVALUES("2","CUS00003","2");
INSERT INTO tbl_cus_notificationVALUES("3","CUS00005","3");
INSERT INTO tbl_cus_notificationVALUES("4","CUS00006","4");
INSERT INTO tbl_cus_notificationVALUES("5","CUS00006","5");
INSERT INTO tbl_cus_notificationVALUES("8","CUS00003","8");
INSERT INTO tbl_cus_notificationVALUES("9","CUS00003","9");
INSERT INTO tbl_cus_notificationVALUES("10","CUS00003","10");
INSERT INTO tbl_cus_notificationVALUES("11","CUS00003","11");
INSERT INTO tbl_cus_notificationVALUES("12","CUS00006","12");
INSERT INTO tbl_cus_notificationVALUES("13","CUS00003","13");
INSERT INTO tbl_cus_notificationVALUES("14","CUS00006","14");





CREATE TABLE `tbl_cuslogin` (
  `cus_email` varchar(100) NOT NULL,
  `cus_pass` varchar(100) NOT NULL,
  `temp_pass` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`cus_email`),
  CONSTRAINT `tbl_cuslogin_ibfk_1` FOREIGN KEY (`cus_email`) REFERENCES `tbl_customers` (`cus_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_cusloginVALUES("dasun@gmail.com","8af3982673455323883c06fa59d2872a","","0");
INSERT INTO tbl_cusloginVALUES("dhanushkssa@gmail.com","1adbb3178591fd5bb0c248518f39bf6d","","0");
INSERT INTO tbl_cusloginVALUES("safrazroxhameed96@gmail.com","7d2011be403afa15dd392973d2979278","","0");
INSERT INTO tbl_cusloginVALUES("sumudsu@gmail.com","202cb962ac59075b964b07152d234b70","","0");
INSERT INTO tbl_cusloginVALUES("user@gmail.com","81dc9bdb52d04dc20036dbd8313ed055","","0");





CREATE TABLE `tbl_customers` (
  `cus_id` varchar(10) NOT NULL,
  `cus_fname` varchar(25) NOT NULL,
  `cus_lname` varchar(25) NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `cus_gender` tinyint(1) NOT NULL,
  `cus_mobile` varchar(10) NOT NULL,
  `cus_dob` date NOT NULL,
  `cus_jdate` date NOT NULL,
  `temp_pass` int(10) NOT NULL,
  `cus_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`cus_id`),
  KEY `cus_email` (`cus_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_customersVALUES("CUS00001","prabath","Lakshitha","user@gmail.com","0","0775197009","0000-00-00","2019-10-12","0","1");
INSERT INTO tbl_customersVALUES("CUS00002","Dhanushka","Sampath","dhanushkssa@gmail.com","1","071-454544","2001-03-13","2019-12-24","0","1");
INSERT INTO tbl_customersVALUES("CUS00003","Sumudu","Geeth","sumudsu@gmail.com","1","0785822254","2001-12-20","2019-12-24","0","1");
INSERT INTO tbl_customersVALUES("CUS00004","saahen","Fernando","sahen@gmail.com","1","0774524568","0000-00-00","2020-01-10","0","1");
INSERT INTO tbl_customersVALUES("CUS00005","dasun Pathirana","Pathiramna","dasun@gmail.com","1","0745868952","2002-01-02","2020-01-10","0","1");
INSERT INTO tbl_customersVALUES("CUS00006","hameed","bhai","safrazroxhameed96@gmail.com","1","0752490206","1996-05-31","2020-01-11","0","1");





CREATE TABLE `tbl_feedback` (
  `feed_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` varchar(10) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `feed_msg` varchar(500) NOT NULL,
  `feed_star` tinyint(1) NOT NULL,
  `feed_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`feed_id`),
  KEY `fk_cus` (`cus_id`),
  KEY `fk_prod` (`prod_id`),
  CONSTRAINT `fk_cus` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`),
  CONSTRAINT `fk_prod` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `tbl_grn` (
  `grn_id` int(10) NOT NULL,
  `sup_id` varchar(10) NOT NULL,
  `grn_rdate` date NOT NULL,
  `grn_total` float(15,2) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `grn_discount` float NOT NULL,
  `grn_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`grn_id`),
  KEY `kk_sup` (`sup_id`),
  CONSTRAINT `kk_sup` FOREIGN KEY (`sup_id`) REFERENCES `tbl_suppliers` (`sup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_grnVALUES("1","SUP0001","2018-04-08","740000.00","20","0","1");
INSERT INTO tbl_grnVALUES("2","SUP0002","2018-05-30","2370000.00","30","0","1");
INSERT INTO tbl_grnVALUES("3","SUP0002","2018-06-02","1920000.00","900","0","1");
INSERT INTO tbl_grnVALUES("4","SUP0003","2020-01-09","5390000.00","120","0","1");





CREATE TABLE `tbl_inv_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_id` varchar(25) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `prod_cprice` float(15,2) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_sprice` float(15,2) NOT NULL,
  `warr_expire` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inv` (`inv_id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `fk_inv` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_inv_prod_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO tbl_inv_prodVALUES("1","INV20200109_0001","PRO00007","95000.00","1","20000.00","0000-00-00");
INSERT INTO tbl_inv_prodVALUES("2","INV20200110_0001","PRO00001","37000.00","3","42000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("3","INV20200110_0002","PRO00001","37000.00","3","42000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("4","INV20200110_0003","PRO00005","1400.00","1","2700.00","2020-01-10");
INSERT INTO tbl_inv_prodVALUES("5","INV20200110_0004","PRO00007","79000.00","1","95000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("6","INV20200110_0005","PRO00001","0.00","2","43000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("7","INV20200110_0006","PRO00001","37000.00","2","43000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("8","INV20200110_0007","PRO00007","79000.00","1","95000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("9","INV20200110_0008","PRO00007","79000.00","1","95000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("10","INV20200110_0009","PRO00005","1400.00","1","2700.00","2020-01-10");
INSERT INTO tbl_inv_prodVALUES("11","INV20200110_0010","PRO00007","79000.00","1","95000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("12","INV20200110_0011","PRO00007","79000.00","1","95000.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("13","INV20200110_0012","PRO00005","1400.00","1","2700.00","2020-01-10");
INSERT INTO tbl_inv_prodVALUES("14","INV20200110_0013","PRO00002","2200.00","10","4500.00","2020-07-08");
INSERT INTO tbl_inv_prodVALUES("15","INV20200110_0014","PRO00005","1400.00","1","2700.00","2020-01-10");
INSERT INTO tbl_inv_prodVALUES("16","INV20200110_0015","PRO00005","1400.00","6","2700.00","2020-01-10");
INSERT INTO tbl_inv_prodVALUES("17","INV20200110_0016","PRO00012","2800.00","1","3600.00","2021-01-09");
INSERT INTO tbl_inv_prodVALUES("18","INV20200111_0001","PRO00003","35000.00","1","40000.00","2021-01-10");
INSERT INTO tbl_inv_prodVALUES("19","INV20200111_0002","PRO00005","1400.00","4","2700.00","2020-01-11");





CREATE TABLE `tbl_invoice` (
  `inv_id` varchar(25) NOT NULL,
  `cus_id` varchar(10) NOT NULL,
  `inv_date` date NOT NULL,
  `inv_qty` int(10) NOT NULL,
  `inv_discount` float(15,2) NOT NULL,
  `inv_total` float(15,2) NOT NULL,
  `inv_paid` float(15,2) NOT NULL,
  `pay_id` varchar(10) NOT NULL,
  `inv_user` varchar(10) NOT NULL,
  `inv_type` varchar(15) NOT NULL,
  `inv_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`inv_id`),
  KEY `cus_id` (`cus_id`),
  KEY `fk_users` (`inv_user`),
  CONSTRAINT `tbl_invoice_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_invoiceVALUES("INV20200109_0001","CUS00003","2020-01-09","1","0.00","95000.00","70000.00","1","","online","3");
INSERT INTO tbl_invoiceVALUES("INV20200110_0001","CUS00003","2020-01-10","3","0.00","126000.00","30000.00","5","","online","2");
INSERT INTO tbl_invoiceVALUES("INV20200110_0002","CUS00003","2020-01-10","3","0.00","126000.00","126000.00","6","","online","1");
INSERT INTO tbl_invoiceVALUES("INV20200110_0003","CUS00003","2020-01-10","1","0.00","2700.00","2700.00","7","","online","2");
INSERT INTO tbl_invoiceVALUES("INV20200110_0004","CUS00003","2020-01-10","1","0.00","95000.00","95000.00","8","","online","2");
INSERT INTO tbl_invoiceVALUES("INV20200110_0005","CUS00001","2020-01-10","2","0.00","86000.00","0.00","","EMP00004","offline","1");
INSERT INTO tbl_invoiceVALUES("INV20200110_0006","CUS00004","2020-01-10","2","0.00","43000.00","43000.00","10","EMP00004","offline","2");
INSERT INTO tbl_invoiceVALUES("INV20200110_0007","CUS00003","2020-01-10","1","0.00","95000.00","95000.00","11","","online","1");
INSERT INTO tbl_invoiceVALUES("INV20200110_0008","CUS00003","2020-01-10","1","0.00","95000.00","95000.00","12","","online","1");
INSERT INTO tbl_invoiceVALUES("INV20200110_0009","CUS00003","2020-01-10","1","0.00","2700.00","2700.00","13","","online","2");
INSERT INTO tbl_invoiceVALUES("INV20200110_0010","CUS00003","2020-01-10","1","0.00","95000.00","95000.00","14","","online","1");
INSERT INTO tbl_invoiceVALUES("INV20200110_0011","CUS00003","2020-01-10","1","0.00","95000.00","95000.00","15","","online","2");
INSERT INTO tbl_invoiceVALUES("INV20200110_0012","CUS00003","2020-01-10","1","0.00","2700.00","2700.00","16","","online","1");
INSERT INTO tbl_invoiceVALUES("INV20200110_0013","CUS00003","2020-01-10","10","0.00","45000.00","20000.00","17","","online","2");
INSERT INTO tbl_invoiceVALUES("INV20200110_0014","CUS00003","2020-01-10","1","0.00","2700.00","1000.00","18","","online","2");
INSERT INTO tbl_invoiceVALUES("INV20200110_0015","CUS00003","2020-01-10","6","0.00","16200.00","16200.00","19","","online","1");
INSERT INTO tbl_invoiceVALUES("INV20200110_0016","CUS00005","2020-01-10","1","0.00","3600.00","3600.00","20","","online","1");
INSERT INTO tbl_invoiceVALUES("INV20200111_0001","CUS00006","2020-01-11","1","0.00","40000.00","40000.00","21","","online","1");
INSERT INTO tbl_invoiceVALUES("INV20200111_0002","CUS00006","2020-01-11","4","0.00","10800.00","10800.00","22","","online","3");





CREATE TABLE `tbl_messages` (
  `msg_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `msg_email` varchar(200) NOT NULL,
  `msg_contact` varchar(50) NOT NULL,
  `msg_title` varchar(100) NOT NULL,
  `msg_message` varchar(500) NOT NULL,
  `msg_date` date NOT NULL,
  `msg_time` time NOT NULL,
  `parent_id` tinyint(1) NOT NULL,
  `msg_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO tbl_messagesVALUES("1","HIRu","hiru@gmail.com","456465465","asasas","sdsdsdasda","0000-00-00","11:01:55","0","0");
INSERT INTO tbl_messagesVALUES("2","lahiru Chamara","chamara@gmail.com","0714567892","Emergency","Messages brings a refreshingly beautiful and responsive Material Design touch to the stale state of text messaging. In a world with clunky SMS and MMS apps ...","2020-01-08","15:01:07","0","1");
INSERT INTO tbl_messagesVALUES("12","lahiru Chamara","chamara@gmail.com","","Reply For :Emergency","This email From nesmo international(pvt)ltd Sales Team,
Nesmo International (pvt)ltd,
103,
Highlevel Road,                            
                    ","2020-01-08","18:00:53","2","1");
INSERT INTO tbl_messagesVALUES("13","Kasun Sampath","kasun@gmail.com","0713137009","Report to Crazy Horse","All the Sioux were defeated. Our clan   
got poor, but a few got richer.
They fought two wars. I did not
take part. No one remembers your vision   
or even your real name. Now   
the children go to town and like   
loud music. I married a.","2020-01-09","01:01:53","0","0");
INSERT INTO tbl_messagesVALUES("14","Dilina","dilina@gmail.com","0717513294","Mal chamara","Hr CSS Style – Change Color Border Style. The HTML <hr> element represents a Horizontal-rule and it is used for page break via line. It creates horizontal line, which makes someone to understand that there is an end of the page or a sentence break.
","2020-01-10","11:01:05","0","0");





CREATE TABLE `tbl_notification` (
  `not_id` int(11) NOT NULL AUTO_INCREMENT,
  `not_title` varchar(100) NOT NULL,
  `not_msg` varchar(200) NOT NULL,
  `not_date` date NOT NULL,
  `not_time` time NOT NULL,
  `not_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`not_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO tbl_notificationVALUES("1","Order Success","Your order  has been paid successfully. needs several days to process your order Thank You","2020-01-10","20:01:41","1");
INSERT INTO tbl_notificationVALUES("2","Order Success","Your order  has been paid successfully. needs several days to process your order Thank You","2020-01-10","22:01:06","1");
INSERT INTO tbl_notificationVALUES("3","Order Success","Your order  has been paid successfully. needs several days to process your order Thank You","2020-01-10","23:01:52","0");
INSERT INTO tbl_notificationVALUES("4","Order Success","Your order  has been paid successfully. needs several days to process your order Thank You","2020-01-11","14:01:17","0");
INSERT INTO tbl_notificationVALUES("5","Order Success","Your order  has been paid successfully. needs several days to process your order Thank You","2020-01-11","14:01:31","0");
INSERT INTO tbl_notificationVALUES("6","Order Confirm","INV20200110_0014 This order has Confirmed, we are preparing your order","2020-01-11","15:01:12","0");
INSERT INTO tbl_notificationVALUES("7","Order Confirm","INV20200110_0013 This order has Confirmed, we are preparing your order","2020-01-11","15:01:04","0");
INSERT INTO tbl_notificationVALUES("8","Order Confirm","INV20200110_0003 This order has Confirmed, we are preparing your order","2020-01-11","15:01:20","0");
INSERT INTO tbl_notificationVALUES("9","Order Confirm","INV20200110_0001 This order has Confirmed, we are preparing your order","2020-01-11","15:01:51","0");
INSERT INTO tbl_notificationVALUES("10","Order Confirm","INV20200110_0009 This order has Confirmed, we are preparing your order","2020-01-11","15:01:55","0");
INSERT INTO tbl_notificationVALUES("11","Order Confirm","INV20200110_0011 This order has Confirmed, we are preparing your order","2020-01-11","15:01:42","0");
INSERT INTO tbl_notificationVALUES("12","Order Confirm","INV20200111_0002 This order has Confirmed, we are preparing your order","2020-01-11","15:01:09","0");
INSERT INTO tbl_notificationVALUES("13","Order was deliverd"," INV20200109_0001 This order has Deliverd, Thank you deal with us","2020-01-11","16:01:46","0");
INSERT INTO tbl_notificationVALUES("14","Order was deliverd"," INV20200111_0002 This order has Deliverd, Thank you deal with us","2020-01-11","16:01:01","0");





CREATE TABLE `tbl_payment` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_id` varchar(25) NOT NULL,
  `pay_amount` float(15,2) NOT NULL,
  `pay_date` date NOT NULL,
  `pay_time` time NOT NULL,
  `pay_type` varchar(12) NOT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `inv_id` (`inv_id`),
  CONSTRAINT `tbl_payment_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`inv_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO tbl_paymentVALUES("1","INV20200109_0001","95000.00","2020-01-09","16:01:27","");
INSERT INTO tbl_paymentVALUES("2","INV20200109_0001","25000.00","2020-01-02","02:50:00","offline");
INSERT INTO tbl_paymentVALUES("3","INV20200109_0001","10000.00","2020-01-02","01:00:00","offline");
INSERT INTO tbl_paymentVALUES("4","INV20200109_0001","10000.00","2020-01-01","01:00:00","offline");
INSERT INTO tbl_paymentVALUES("5","INV20200110_0001","30000.00","2020-01-10","12:01:18","");
INSERT INTO tbl_paymentVALUES("6","INV20200110_0002","126000.00","2020-01-10","12:01:24","");
INSERT INTO tbl_paymentVALUES("7","INV20200110_0003","2700.00","2020-01-10","12:01:41","online");
INSERT INTO tbl_paymentVALUES("8","INV20200110_0004","95000.00","2020-01-10","12:01:12","online");
INSERT INTO tbl_paymentVALUES("9","INV20200110_0005","86000.00","2020-01-10","16:01:00","offline");
INSERT INTO tbl_paymentVALUES("10","INV20200110_0006","43000.00","2020-01-10","17:01:40","offline");
INSERT INTO tbl_paymentVALUES("11","INV20200110_0007","95000.00","2020-01-10","19:01:27","online");
INSERT INTO tbl_paymentVALUES("12","INV20200110_0008","95000.00","2020-01-10","19:01:37","online");
INSERT INTO tbl_paymentVALUES("13","INV20200110_0009","2700.00","2020-01-10","19:01:06","online");
INSERT INTO tbl_paymentVALUES("14","INV20200110_0010","95000.00","2020-01-10","19:01:07","online");
INSERT INTO tbl_paymentVALUES("15","INV20200110_0011","95000.00","2020-01-10","19:01:51","online");
INSERT INTO tbl_paymentVALUES("16","INV20200110_0012","2700.00","2020-01-10","20:01:40","online");
INSERT INTO tbl_paymentVALUES("17","INV20200110_0013","20000.00","2020-01-10","20:01:54","online");
INSERT INTO tbl_paymentVALUES("18","INV20200110_0014","1000.00","2020-01-10","20:01:35","online");
INSERT INTO tbl_paymentVALUES("19","INV20200110_0015","16200.00","2020-01-10","22:01:05","online");
INSERT INTO tbl_paymentVALUES("20","INV20200110_0016","3600.00","2020-01-10","23:01:44","online");
INSERT INTO tbl_paymentVALUES("21","INV20200111_0001","40000.00","2020-01-11","14:01:11","online");
INSERT INTO tbl_paymentVALUES("22","INV20200111_0002","10800.00","2020-01-11","14:01:26","online");





CREATE TABLE `tbl_prod_desc` (
  `desc_id` varchar(10) NOT NULL,
  `prod_desc` varchar(1000) NOT NULL,
  `capacity` varchar(150) NOT NULL,
  `voltage` varchar(10) NOT NULL,
  `power` varchar(10) NOT NULL,
  `tank_capacity` varchar(10) NOT NULL,
  `material` varchar(150) NOT NULL,
  `dimension` varchar(150) NOT NULL,
  `contains` varchar(150) NOT NULL,
  `stage_pp` tinyint(4) NOT NULL,
  `stage_cto` tinyint(4) NOT NULL,
  `stage_post` tinyint(4) NOT NULL,
  `stage_ro` tinyint(4) NOT NULL,
  `stage_udf` tinyint(4) NOT NULL,
  `stage_min` tinyint(4) NOT NULL,
  `warr_id` varchar(10) NOT NULL,
  PRIMARY KEY (`desc_id`),
  KEY `desc_id` (`desc_id`),
  KEY `fk_warr` (`warr_id`),
  CONSTRAINT `fk_desc` FOREIGN KEY (`desc_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_warr` FOREIGN KEY (`warr_id`) REFERENCES `tbl_prod_warr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_prod_descVALUES("PRO00001","Home use
                  
                  
                  ","190L","220","50Hz","6L","Plastic","52x20.5x45CM","Pressure Tank and Faucets","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_descVALUES("PRO00002","Free |  Metrial
                  
                  
                  
                  
                  
                  ","","","","","","","","0","0","0","0","0","0","2");
INSERT INTO tbl_prod_descVALUES("PRO00003","ffff
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  ","200 Gallons","220V","50Hz","6","Food safe, Non Toxic, engineering grade Plastics","49CM x 35CM x 82 CM","NESMO RO water purifier with Pressure Tank and Faucets","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_descVALUES("PRO00004","The Nesmo RO System Can Be Configured To Meet Your Specific Requirements. There Are Ten Interchangeable Filters With A Variety Of Treatment That Can Be Tailored To Local Water Conditions, So You Water Is The Best It Can Be. The Innovative QC Twist And Lock Design Makes Service Simple. Twist Off The Old Cortege And Twist On The New. No Messy Sump Removal. Nesmo RO Systems Make Daring Water Better And Life Easier.
                  ","200","220V","50Hz","6L","Food Safe, Non Toxic, Engineering Grade Plastics","52x20.5x45CM 12.5/11.5KGS","NESMO RO Luxury Water Purifier With Pressure Tank And Faucets","1","1","0","0","0","0","1");
INSERT INTO tbl_prod_descVALUES("PRO00005","The K2533 inline GAC filter is one of Omnipure\'s K series inline filters that easily install directly to your water line and reduce weeping or seepage potential. This filter uses granular activated carbon to reduce chlorine, taste and odor in your water and is available with various fittings to meet your water line\'s specifications. Compatible parts include K2536, K2528, and K2540.  |
Dimensions: 11.25\" X 2.125\" |
Replace every 6-12 months |
Reduces chlorine, taste and odor
NSF Certified |
Available Fittings","","","","","","","","0","0","0","0","0","0","3");
INSERT INTO tbl_prod_descVALUES("PRO00006","The AF-10-4010 filter uses mixed bed resins to reduce total ion concentration in your water. |
Dimensions: 9.9\" X 3.0\" | Replace every 6-12 months | Reduces ion concentration
                  ","","","","","","","","0","0","0","0","0","0","3");
INSERT INTO tbl_prod_descVALUES("PRO00007","This filter suitable for warehouse. its support to cover more than 500L daily. Works without any intervention. The system senses if the water tank is not full, purifies and stores water automatically.
                  ","50","220","50","6000","Food safe, Non Toxic, engineering grade Plastics","500","Free Installation with Guide","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_descVALUES("PRO00008","NESMO WATER Light Commercial Economy 200 GPD RO with enhanced chlorine removal with 20 Filter Housings
                  ","MAX: GDP:300G/24H","220","50Hz","11 Galloon","Food safe, Non Toxic, engineering grade Plastics","20CM x 10CM X 40CM","Frucets,","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_descVALUES("PRO00009","Special Filter for home use this output is 300Galloons within 24Hours. this support 7 stages","300","220","50","6","Food safe, Non Toxic, engineering grade Plastics","10 x 40 x 30","NESMO RO water purifier with Pressure Tank and Faucets","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_descVALUES("PRO00010","Special Filter for home use this output is 300Galloons within 24Hours. this support 7 stages","300","220","50","6","Food safe, Non Toxic, engineering grade Plastics","","NESMO RO water purifier with Pressure Tank and Faucets","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_descVALUES("PRO00011","This filter suitable for home used ","200","220","50","6","Food safe, Non Toxic, engineering grade Plastics","15 x 50 x 60","NESMO RO water purifier with Pressure Tank and Faucets","0","0","1","1","1","1","1");
INSERT INTO tbl_prod_descVALUES("PRO00012","CTO is an acronym for Chlorine, Taste, and Odor. A filter recommended for CTO removal will produce water that is much clearer in color with a more appealing taste and elimination of odors.  |  Size : 70 x 248 MM | Weight: 350g","","","","","","","","0","0","0","0","0","0","1");





CREATE TABLE `tbl_prod_img` (
  `pi_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` varchar(10) NOT NULL,
  `prod_image` varchar(500) NOT NULL,
  PRIMARY KEY (`pi_id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `tbl_prod_img_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

INSERT INTO tbl_prod_imgVALUES("33","PRO00002","CAT00003/PRO00002/CAT00003_PRO00002_1578373224_0.JPG");
INSERT INTO tbl_prod_imgVALUES("34","PRO00002","CAT00003/PRO00002/CAT00003_PRO00002_1578373294_0.jpg");





CREATE TABLE `tbl_prod_warr` (
  `id` varchar(10) NOT NULL,
  `warrenty` varchar(500) NOT NULL,
  `nodate` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_prod_warrVALUES("1","1 year Warranty","365");
INSERT INTO tbl_prod_warrVALUES("2","6 Months warranty","180");
INSERT INTO tbl_prod_warrVALUES("3","No Warranty","0");





CREATE TABLE `tbl_products` (
  `prod_id` varchar(10) NOT NULL,
  `prod_name` varchar(200) NOT NULL,
  `prod_modal` varchar(100) NOT NULL,
  `prod_color` varchar(20) NOT NULL,
  `desc_id` varchar(10) NOT NULL,
  `prod_price` float(15,2) NOT NULL,
  `prod_dprice` float(15,2) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `prod_rlevel` int(11) NOT NULL,
  `prod_img` varchar(500) NOT NULL,
  `cat_id` varchar(10) NOT NULL,
  PRIMARY KEY (`prod_id`),
  KEY `fk_cat_id` (`cat_id`),
  KEY `fk_desc` (`desc_id`),
  CONSTRAINT `fk_cat_id` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_productsVALUES("PRO00001","RO Luxury water purifier-Blue","NI-RO50-B","Blue","PRO00001","45000.00","42000.00","10","30","CAT00001/PRO00001/CAT00001_PRO00001_1576208438.jpg","CAT00001");
INSERT INTO tbl_productsVALUES("PRO00002","Faucets","Faucets12","None","PRO00002","3000.00","4500.00","290","20","CAT00003/PRO00002/CAT00003_PRO00002_1576117347.jpg","CAT00003");
INSERT INTO tbl_productsVALUES("PRO00003","Ro Basic Filter 500 Galloons","RO-BF-500","Blue","PRO00003","42000.00","0.00","49","10","CAT00001/PRO00003/CAT00001_PRO00003_1576172250.jpg","CAT00001");
INSERT INTO tbl_productsVALUES("PRO00004","3 Stage Filter","ROG-50","Blue Transparent","PRO00004","39000.00","0.00","70","44","CAT00001/PRO00004/CAT00001_PRO00004_1576172268.jpg","CAT00001");
INSERT INTO tbl_productsVALUES("PRO00005","Ro Mambrane","romembrane","White","PRO00005","2000.00","0.00","286","15","CAT00003/PRO00005/CAT00003_PRO00005_1576656012.jpg","CAT00003");
INSERT INTO tbl_productsVALUES("PRO00006","Mineral ","mineral","None","PRO00006","2500.00","0.00","0","10","CAT00003/PRO00006/CAT00003_PRO00006_1576656727.jpg","CAT00003");
INSERT INTO tbl_productsVALUES("PRO00007","Warehouse Basic Filter","NI-RO-400G-WH","Blue","PRO00007","95000.00","0.00","24","25","CAT00002/PRO00007/CAT00002_PRO00007_1577129089.jpg","CAT00002");
INSERT INTO tbl_productsVALUES("PRO00008","Reverse Osmosis Warehouse 300 Gallons","NI-RO-300G-WOH","None","PRO00008","54000.00","0.00","0","5","CAT00002/PRO00008/CAT00002_PRO00008_1577160682.jpg","CAT00002");
INSERT INTO tbl_productsVALUES("PRO00009","RO Mineral Water Filter - RED","NI-RO50-R","Wine Red","PRO00009","0.00","41999.00","0","20","CAT00001/PRO00009/CAT00001_PRO00009_1578221976.jpg","CAT00001");
INSERT INTO tbl_productsVALUES("PRO00010","RO Mineral Water Filter - Pink","NI-RO50-P","Pink","PRO00010","43000.00","40000.00","0","20","CAT00001/PRO00010/CAT00001_PRO00010_1578222413.jpg","CAT00001");
INSERT INTO tbl_productsVALUES("PRO00011","Rivers Osmosis Basic Filter 200 Gallons","RO-BF-200","none","PRO00011","35000.00","0.00","0","30","CAT00001/PRO00011/CAT00001_PRO00011_1578223316.JPG","CAT00001");
INSERT INTO tbl_productsVALUES("PRO00012","RO CTO water filter","cto-filter","none","PRO00012","0.00","0.00","299","1","CAT00003/PRO00012/CAT00003_PRO00012_1578237663.png","CAT00003");





CREATE TABLE `tbl_province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(50) NOT NULL,
  `districts` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

INSERT INTO tbl_provinceVALUES("1","Central","Kandy");
INSERT INTO tbl_provinceVALUES("2","Central","Matale");
INSERT INTO tbl_provinceVALUES("3","Central","Nuwara Eliya");
INSERT INTO tbl_provinceVALUES("4","Eastern","Ampara");
INSERT INTO tbl_provinceVALUES("5","Eastern","Batticaloa");
INSERT INTO tbl_provinceVALUES("6","Eastern","Trincomalee");
INSERT INTO tbl_provinceVALUES("7","Northern","Jaffna");
INSERT INTO tbl_provinceVALUES("8","Northern","Kilinochchi");
INSERT INTO tbl_provinceVALUES("9","Northern","Mannar");
INSERT INTO tbl_provinceVALUES("10","Northern","Mullaitivu");
INSERT INTO tbl_provinceVALUES("11","Northern","Vavuniya");
INSERT INTO tbl_provinceVALUES("12","North Central","Anuradhapura");
INSERT INTO tbl_provinceVALUES("13","North Central","Polonnaruwa");
INSERT INTO tbl_provinceVALUES("14","North Western","Kurunegala");
INSERT INTO tbl_provinceVALUES("15","North Western","Puttalam");
INSERT INTO tbl_provinceVALUES("16","Sabaragamuwa","Kegalle");
INSERT INTO tbl_provinceVALUES("17","Sabaragamuwa","Ratnapura");
INSERT INTO tbl_provinceVALUES("18","Southern","Galle");
INSERT INTO tbl_provinceVALUES("19","Southern","Hambantota");
INSERT INTO tbl_provinceVALUES("20","Southern","Matara");
INSERT INTO tbl_provinceVALUES("21","Uva","Badulla");
INSERT INTO tbl_provinceVALUES("22","Uva","Monaragala");
INSERT INTO tbl_provinceVALUES("23","Western","Colombo");
INSERT INTO tbl_provinceVALUES("24","Western","Gampaha");
INSERT INTO tbl_provinceVALUES("25","Western","Kalutara");





CREATE TABLE `tbl_role` (
  `role_id` tinyint(1) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_roleVALUES("1","Admin");
INSERT INTO tbl_roleVALUES("2","Manager");
INSERT INTO tbl_roleVALUES("3","Sales Manager");
INSERT INTO tbl_roleVALUES("4","Technician ");





CREATE TABLE `tbl_suppliers` (
  `sup_id` varchar(10) NOT NULL,
  `sup_name` varchar(200) NOT NULL,
  `sup_contact` varchar(50) NOT NULL,
  `sup_email` varchar(200) NOT NULL,
  `sup_address` varchar(200) NOT NULL,
  `sup_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_suppliersVALUES("SUP0001","Ningbo Keman Environmental Technology Co Ltd","85229458888","info@ningbo.com","Yuyao, Ningbo, Zhejiang, China","1");
INSERT INTO tbl_suppliersVALUES("SUP0002","HANGZHOU DEEFINE FILTRATION TECHNOLOGY CO., LTD.","86-571-85858787","info@HANGZHOU.com","No. 32 Xianxing Road, Xianlin Town, Yuhang District, Hangzhou, Zhejiang, China 311122","1");
INSERT INTO tbl_suppliersVALUES("SUP0003","NanJing Tsung Water Technology Co., Ltd."," 86-25-87152848","info@NanJing.com","Dongshan Town, Jiangning Distrinct, Nanjing City, Nanjing, Jiangsu, China 211100","1");





CREATE TABLE `tbl_ulogin` (
  `user_name` varchar(100) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `pwd_reset` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_name`),
  KEY `fk_type` (`user_type`),
  KEY `user_name` (`user_name`),
  CONSTRAINT `fk_role` FOREIGN KEY (`user_type`) REFERENCES `tbl_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbl_ulogin_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `tbl_users` (`emp_email`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_uloginVALUES("admin@gmail.com","202cb962ac59075b964b07152d234b70","1","1");
INSERT INTO tbl_uloginVALUES("Lahiru@gmail.com","202cb962ac59075b964b07152d234b70","2","1");
INSERT INTO tbl_uloginVALUES("sasith@gmail.com","202cb962ac59075b964b07152d234b70","4","1");
INSERT INTO tbl_uloginVALUES("udara@gmail.com","202cb962ac59075b964b07152d234b70","3","1");





CREATE TABLE `tbl_user_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `notif_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`),
  KEY `fk_not` (`notif_id`),
  CONSTRAINT `fk_not` FOREIGN KEY (`notif_id`) REFERENCES `tbl_notification` (`not_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `tbl_users` (
  `emp_id` varchar(9) NOT NULL,
  `emp_fname` varchar(100) NOT NULL,
  `emp_lname` varchar(100) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_address` varchar(200) NOT NULL,
  `emp_mobile` varchar(10) NOT NULL,
  `emp_gender` tinyint(1) NOT NULL,
  `emp_nic` varchar(20) NOT NULL,
  `emp_birth` date NOT NULL,
  `emp_join` date NOT NULL,
  `emp_role` tinyint(1) NOT NULL,
  `emp_img` varchar(200) NOT NULL,
  `emp_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `fk_email` (`emp_email`),
  KEY `fk_role` (`emp_role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_usersVALUES("EMP00001","admin","admin","admin@gmail.com","beliattaas8-97-","0713137009","1","950340649V","2019-10-16","2019-10-30","1","user.png","1");
INSERT INTO tbl_usersVALUES("EMP00002","Sasith","Sampath","sasith@gmail.com","Middiniya road, Weerakatiya                            ","0775662750","1","970456852V","2002-01-03","0000-00-00","0","EMP00002_1575396929.jpg","1");
INSERT INTO tbl_usersVALUES("EMP00003","Lahiru","Chamara","Lahiru@gmail.com","Ambala Beliatta","0772564620","1","950214456V","2002-01-01","0000-00-00","0","EMP00003_1575397234.jpg","1");
INSERT INTO tbl_usersVALUES("EMP00004","Udara","Weerasinghe","udara@gmail.com","gsfgsgfsgf
                            ","0714567894","1","852456852V","0000-00-00","0000-00-00","0","EMP00004_1576564561.jpg","1");





CREATE TABLE `tbl_warr_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warr_id` varchar(11) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `warr_probleme` varchar(200) NOT NULL,
  `solution` varchar(600) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `tbl_warr_prod_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `tbl_products` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_warr_prodVALUES("1","1","PRO00007","Can i change this                            
                            ","","0");





CREATE TABLE `tbl_warrenty` (
  `warr_id` int(11) NOT NULL AUTO_INCREMENT,
  `cus_id` varchar(10) NOT NULL,
  `inv_id` varchar(100) NOT NULL,
  `warr_claim` varchar(2000) NOT NULL,
  `operator` varchar(10) NOT NULL,
  `warr_date` date NOT NULL,
  `complete_date` date NOT NULL,
  `description` varchar(800) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`warr_id`),
  KEY `cus_id` (`cus_id`),
  KEY `operater` (`operator`),
  KEY `inv_id` (`inv_id`),
  CONSTRAINT `tbl_warrenty_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customers` (`cus_id`),
  CONSTRAINT `tbl_warrenty_ibfk_3` FOREIGN KEY (`inv_id`) REFERENCES `tbl_invoice` (`inv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_warrentyVALUES("1","CUS00003","INV20200110_0010","","","2020-01-10","0000-00-00","","3");



