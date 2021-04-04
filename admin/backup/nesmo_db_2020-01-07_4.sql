DROP TABLE tbl_backup;

tbl_backup;

INSERT INTO tbl_backup VALUES("1","2019-12-11","08:24:15","464654646456","EMP00001","1");
INSERT INTO tbl_backup VALUES("2","2020-01-07","22:01:27","nesmo_db_2020-01-07_0.sql","","1");
INSERT INTO tbl_backup VALUES("3","2020-01-07","22:01:41","nesmo_db_2020-01-07_1.sql","","1");
INSERT INTO tbl_backup VALUES("4","2020-01-07","22:01:09","nesmo_db_2020-01-07_2.sql","EMP00001","1");
INSERT INTO tbl_backup VALUES("5","2020-01-07","22:01:22","nesmo_db_2020-01-07_3.sql","EMP00001","1");



DROP TABLE tbl_batch;

tbl_batch;




DROP TABLE tbl_category;

tbl_category;

INSERT INTO tbl_category VALUES("CAT00001","domestic");
INSERT INTO tbl_category VALUES("CAT00002","commercial");
INSERT INTO tbl_category VALUES("CAT00003","accessories");



DROP TABLE tbl_cus_address;

tbl_cus_address;

INSERT INTO tbl_cus_address VALUES("2","CUS00001","sample","sample 2","Beliattass","Mullaitivu","Central");
INSERT INTO tbl_cus_address VALUES("3","CUS00003","paragahena","kudaheella","Beliatta","Hambantota","Southern");
INSERT INTO tbl_cus_address VALUES("4","CUS00002","","","","","");



DROP TABLE tbl_cuslogin;

tbl_cuslogin;

INSERT INTO tbl_cuslogin VALUES("dhanushka@gmail.com","1adbb3178591fd5bb0c248518f39bf6d","","0");
INSERT INTO tbl_cuslogin VALUES("sumudu@gmail.com","25f9e794323b453885f5181f1b624d0b","","0");
INSERT INTO tbl_cuslogin VALUES("user@gmail.com","81dc9bdb52d04dc20036dbd8313ed055","","0");



DROP TABLE tbl_customers;

tbl_customers;

INSERT INTO tbl_customers VALUES("CUS00001","prabath","Lakshitha","user@gmail.com","0","0775197009","0000-00-00","2019-10-12","0","1");
INSERT INTO tbl_customers VALUES("CUS00002","Dhanushka","Sampath","dhanushka@gmail.com","1","071-454544","2001-03-13","2019-12-24","0","1");
INSERT INTO tbl_customers VALUES("CUS00003","Sumudu","Geeth","sumudu@gmail.com","1","0785825222","2001-12-20","2019-12-24","5345","1");



DROP TABLE tbl_delivery;

tbl_delivery;




DROP TABLE tbl_feedback;

tbl_feedback;




DROP TABLE tbl_grn;

tbl_grn;




DROP TABLE tbl_inv_prod;

tbl_inv_prod;




DROP TABLE tbl_invoice;

tbl_invoice;




DROP TABLE tbl_messages;

tbl_messages;




DROP TABLE tbl_notification;

tbl_notification;

INSERT INTO tbl_notification VALUES("1","Deliverd","Your order has diliverd","2020-01-01","15:22:35","CUS00003","0");
INSERT INTO tbl_notification VALUES("2","Confirmed","Order was confirmed","2020-01-02","04:00:00","CUS00003","0");



DROP TABLE tbl_payment;

tbl_payment;




DROP TABLE tbl_prod_desc;

tbl_prod_desc;

INSERT INTO tbl_prod_desc VALUES("PRO00001","Home use
                  
                  
                  ","190L","220","50Hz","6L","Plastic","52x20.5x45CM","Pressure Tank and Faucets","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_desc VALUES("PRO00002","Free |  Metrial
                  
                  
                  
                  
                  
                  ","","","","","","","","0","0","0","0","0","0","2");
INSERT INTO tbl_prod_desc VALUES("PRO00003","ffff
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  ","200 Gallons","220V","50Hz","6","Food safe, Non Toxic, engineering grade Plastics","49CM x 35CM x 82 CM","NESMO RO water purifier with Pressure Tank and Faucets","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_desc VALUES("PRO00004","The Nesmo RO System Can Be Configured To Meet Your Specific Requirements. There Are Ten Interchangeable Filters With A Variety Of Treatment That Can Be Tailored To Local Water Conditions, So You Water Is The Best It Can Be. The Innovative QC Twist And Lock Design Makes Service Simple. Twist Off The Old Cortege And Twist On The New. No Messy Sump Removal. Nesmo RO Systems Make Daring Water Better And Life Easier.
                  ","200","220V","50Hz","6L","Food Safe, Non Toxic, Engineering Grade Plastics","52x20.5x45CM 12.5/11.5KGS","NESMO RO Luxury Water Purifier With Pressure Tank And Faucets","1","1","0","0","0","0","1");
INSERT INTO tbl_prod_desc VALUES("PRO00005","The K2533 inline GAC filter is one of Omnipure\'s K series inline filters that easily install directly to your water line and reduce weeping or seepage potential. This filter uses granular activated carbon to reduce chlorine, taste and odor in your water and is available with various fittings to meet your water line\'s specifications. Compatible parts include K2536, K2528, and K2540.  |
Dimensions: 11.25\" X 2.125\" |
Replace every 6-12 months |
Reduces chlorine, taste and odor
NSF Certified |
Available Fittings","","","","","","","","0","0","0","0","0","0","3");
INSERT INTO tbl_prod_desc VALUES("PRO00006","The AF-10-4010 filter uses mixed bed resins to reduce total ion concentration in your water. |
Dimensions: 9.9\" X 3.0\" | Replace every 6-12 months | Reduces ion concentration
                  ","","","","","","","","0","0","0","0","0","0","3");
INSERT INTO tbl_prod_desc VALUES("PRO00007","This filter suitable for warehouse. its support to cover more than 500L daily. Works without any intervention. The system senses if the water tank is not full, purifies and stores water automatically.
                  ","50","220","50","6000","Food safe, Non Toxic, engineering grade Plastics","500","Free Installation with Guide","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_desc VALUES("PRO00008","NESMO WATER Light Commercial Economy 200 GPD RO with enhanced chlorine removal with 20 Filter Housings
                  ","MAX: GDP:300G/24H","220","50Hz","11 Galloon","Food safe, Non Toxic, engineering grade Plastics","20CM x 10CM X 40CM","Frucets,","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_desc VALUES("PRO00009","Special Filter for home use this output is 300Galloons within 24Hours. this support 7 stages","300","220","50","6","Food safe, Non Toxic, engineering grade Plastics","10 x 40 x 30","NESMO RO water purifier with Pressure Tank and Faucets","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_desc VALUES("PRO00010","Special Filter for home use this output is 300Galloons within 24Hours. this support 7 stages","300","220","50","6","Food safe, Non Toxic, engineering grade Plastics","","NESMO RO water purifier with Pressure Tank and Faucets","1","1","1","1","1","1","1");
INSERT INTO tbl_prod_desc VALUES("PRO00011","This filter suitable for home used ","200","220","50","6","Food safe, Non Toxic, engineering grade Plastics","15 x 50 x 60","NESMO RO water purifier with Pressure Tank and Faucets","0","0","1","1","1","1","1");
INSERT INTO tbl_prod_desc VALUES("PRO00012","CTO is an acronym for Chlorine, Taste, and Odor. A filter recommended for CTO removal will produce water that is much clearer in color with a more appealing taste and elimination of odors.  |  Size : 70 x 248 MM | Weight: 350g","","","","","","","","0","0","0","0","0","0","1");



DROP TABLE tbl_prod_img;

tbl_prod_img;

INSERT INTO tbl_prod_img VALUES("33","PRO00002","CAT00003/PRO00002/CAT00003_PRO00002_1578373224_0.JPG");
INSERT INTO tbl_prod_img VALUES("34","PRO00002","CAT00003/PRO00002/CAT00003_PRO00002_1578373294_0.jpg");



DROP TABLE tbl_prod_warr;

tbl_prod_warr;

INSERT INTO tbl_prod_warr VALUES("1","1 year Warranty","365");
INSERT INTO tbl_prod_warr VALUES("2","6 Months warranty","180");
INSERT INTO tbl_prod_warr VALUES("3","No Warranty","0");



DROP TABLE tbl_products;

tbl_products;

INSERT INTO tbl_products VALUES("PRO00001","RO Luxury water purifier-Blue","NI-RO50-B","Blue","PRO00001","45000.00","42000.00","0","20","CAT00001/PRO00001/CAT00001_PRO00001_1576208438.jpg","CAT00001");
INSERT INTO tbl_products VALUES("PRO00002","Faucets","Faucets12","None","PRO00002","2000.00","4500.00","0","20","CAT00003/PRO00002/CAT00003_PRO00002_1576117347.jpg","CAT00003");
INSERT INTO tbl_products VALUES("PRO00003","Ro Basic Filter 500 Galloons","RO-BF-500","Blue","PRO00003","42000.00","0.00","0","10","CAT00001/PRO00003/CAT00001_PRO00003_1576172250.jpg","CAT00001");
INSERT INTO tbl_products VALUES("PRO00004","3 Stage Filter","ROG-50","Blue Transparent","PRO00004","39000.00","0.00","0","40","CAT00001/PRO00004/CAT00001_PRO00004_1576172268.jpg","CAT00001");
INSERT INTO tbl_products VALUES("PRO00005","Ro Mambrane","romembrane","White","PRO00005","2000.00","0.00","0","15","CAT00003/PRO00005/CAT00003_PRO00005_1576656012.jpg","CAT00003");
INSERT INTO tbl_products VALUES("PRO00006","Mineral ","mineral","None","PRO00006","2500.00","0.00","0","25","CAT00003/PRO00006/CAT00003_PRO00006_1576656727.jpg","CAT00003");
INSERT INTO tbl_products VALUES("PRO00007","Warehouse Basic Filter","NI-RO-400G-WH","Blue","PRO00007","95000.00","0.00","0","5","CAT00002/PRO00007/CAT00002_PRO00007_1577129089.jpg","CAT00002");
INSERT INTO tbl_products VALUES("PRO00008","Reverse Osmosis Warehouse 300 Gallons","NI-RO-300G-WOH","None","PRO00008","54000.00","0.00","0","5","CAT00002/PRO00008/CAT00002_PRO00008_1577160682.jpg","CAT00002");
INSERT INTO tbl_products VALUES("PRO00009","RO Mineral Water Filter - RED","NI-RO50-R","Wine Red","PRO00009","0.00","41999.00","0","20","CAT00001/PRO00009/CAT00001_PRO00009_1578221976.jpg","CAT00001");
INSERT INTO tbl_products VALUES("PRO00010","RO Mineral Water Filter - Pink","NI-RO50-P","Pink","PRO00010","43000.00","40000.00","0","20","CAT00001/PRO00010/CAT00001_PRO00010_1578222413.jpg","CAT00001");
INSERT INTO tbl_products VALUES("PRO00011","Rivers Osmosis Basic Filter 200 Gallons","RO-BF-200","none","PRO00011","35000.00","0.00","0","30","CAT00001/PRO00011/CAT00001_PRO00011_1578223316.JPG","CAT00001");
INSERT INTO tbl_products VALUES("PRO00012","RO CTO water filter","cto-filter","none","PRO00012","0.00","0.00","0","1","CAT00003/PRO00012/CAT00003_PRO00012_1578237663.png","CAT00003");



DROP TABLE tbl_province;

tbl_province;

INSERT INTO tbl_province VALUES("1","Central","Kandy");
INSERT INTO tbl_province VALUES("2","Central","Matale");
INSERT INTO tbl_province VALUES("3","Central","Nuwara Eliya");
INSERT INTO tbl_province VALUES("4","Eastern","Ampara");
INSERT INTO tbl_province VALUES("5","Eastern","Batticaloa");
INSERT INTO tbl_province VALUES("6","Eastern","Trincomalee");
INSERT INTO tbl_province VALUES("7","Northern","Jaffna");
INSERT INTO tbl_province VALUES("8","Northern","Kilinochchi");
INSERT INTO tbl_province VALUES("9","Northern","Mannar");
INSERT INTO tbl_province VALUES("10","Northern","Mullaitivu");
INSERT INTO tbl_province VALUES("11","Northern","Vavuniya");
INSERT INTO tbl_province VALUES("12","North Central","Anuradhapura");
INSERT INTO tbl_province VALUES("13","North Central","Polonnaruwa");
INSERT INTO tbl_province VALUES("14","North Western","Kurunegala");
INSERT INTO tbl_province VALUES("15","North Western","Puttalam");
INSERT INTO tbl_province VALUES("16","Sabaragamuwa","Kegalle");
INSERT INTO tbl_province VALUES("17","Sabaragamuwa","Ratnapura");
INSERT INTO tbl_province VALUES("18","Southern","Galle");
INSERT INTO tbl_province VALUES("19","Southern","Hambantota");
INSERT INTO tbl_province VALUES("20","Southern","Matara");
INSERT INTO tbl_province VALUES("21","Uva","Badulla");
INSERT INTO tbl_province VALUES("22","Uva","Monaragala");
INSERT INTO tbl_province VALUES("23","Western","Colombo");
INSERT INTO tbl_province VALUES("24","Western","Gampaha");
INSERT INTO tbl_province VALUES("25","Western","Kalutara");



DROP TABLE tbl_role;

tbl_role;

INSERT INTO tbl_role VALUES("1","Admin");
INSERT INTO tbl_role VALUES("2","Manager");
INSERT INTO tbl_role VALUES("3","Sales Manager");
INSERT INTO tbl_role VALUES("4","Technician ");



DROP TABLE tbl_suppliers;

tbl_suppliers;

INSERT INTO tbl_suppliers VALUES("SUP0001","BELIATTA","0475722150","contact@gmail.com","kudaheellla, Beliatta","1");
INSERT INTO tbl_suppliers VALUES("SUP0002","china","+978545625","china company pvt.ltd","china company pvt.ltd
bieging ,
china","1");
INSERT INTO tbl_suppliers VALUES("SUP0003","KoKo Company","0086137384","contact@koko.com","","1");



DROP TABLE tbl_ulogin;

tbl_ulogin;

INSERT INTO tbl_ulogin VALUES("admin@gmail.com","202cb962ac59075b964b07152d234b70","1","1");
INSERT INTO tbl_ulogin VALUES("Lahiru@gmail.com","8af3982673455323883c06fa59d2872a","2","1");
INSERT INTO tbl_ulogin VALUES("sasith@gmail.com","037f0b1dd44302fed8eba67c8ae2d582","4","1");
INSERT INTO tbl_ulogin VALUES("udara@gmail.com","d3835a509829130a0e70b4e85cde05d9","3","1");



DROP TABLE tbl_users;

tbl_users;

INSERT INTO tbl_users VALUES("EMP00001","admin","admin","admin@gmail.com","beliattaas8-97-","0713137009","1","950340649V","2019-10-16","2019-10-30","1","user.png","1");
INSERT INTO tbl_users VALUES("EMP00002","Sasith","Sampath","sasith@gmail.com","Middiniya road, Weerakatiya                            ","0775662750","1","970456852V","2002-01-03","0000-00-00","0","EMP00002_1575396929.jpg","1");
INSERT INTO tbl_users VALUES("EMP00003","Lahiru","Chamara","Lahiru@gmail.com","Koratuwa watta, Ambala,Beliatta
                            ","0772564620","1","950214456V","0000-00-00","0000-00-00","0","EMP00003_1575397234.jpg","1");
INSERT INTO tbl_users VALUES("EMP00004","Udara","Weerasinghe","udara@gmail.com","gsfgsgfsgf
                            ","0714567894","1","852456852V","0000-00-00","0000-00-00","0","EMP00004_1576564561.jpg","0");



DROP TABLE tbl_warr_prod;

tbl_warr_prod;




DROP TABLE tbl_warrenty;

tbl_warrenty;




