DROP TABLE IF EXISTS branches;

CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO branches VALUES('13','Oyingbo Market','','','Yaba','Lagos State','2021-12-02 00:56:38','2021-12-02 00:56:38');
INSERT INTO branches VALUES('14','Marina Market','','','Idumota','Lagos State','2021-12-02 00:58:53','2021-12-02 00:58:53');
INSERT INTO branches VALUES('15','Oshodi Market','','','oshodi','Lagos State','2021-12-07 09:17:32','2021-12-07 09:17:32');
INSERT INTO branches VALUES('16','Tinubu','','','Alimosho','Lagos','2021-12-13 13:11:10','2021-12-13 13:11:10');



DROP TABLE IF EXISTS currency;

CREATE TABLE `currency` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(10,6) NOT NULL,
  `base_currency` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO currency VALUES('3','NGN','0.000000','1','1','','2021-10-24 13:26:33');



DROP TABLE IF EXISTS database_backups;

CREATE TABLE `database_backups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS deposit_methods;

CREATE TABLE `deposit_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS deposit_requests;

CREATE TABLE `deposit_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `method_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `transaction_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS email_templates;

CREATE TABLE `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS failed_jobs;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS faq_translations;

CREATE TABLE `faq_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `faq_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faq_translations_faq_id_locale_unique` (`faq_id`,`locale`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO faq_translations VALUES('1','1','English','How to open an account?','Account opening is very easy. Just need to click Sign Up and enter some initial details for opening account. After that you need to verify your email address and that\'s ready to go.','2021-08-31 11:07:50','2021-09-05 16:37:10');
INSERT INTO faq_translations VALUES('2','2','English','How to deposit money?','You can deposit money via online payment gateway such as PayPal, Stripe, Razorpay, Paystack, Flutterwave as well as BlockChain for bitcoin. You can also deposit money by coming to our office physically.','2021-08-31 11:09:26','2021-09-05 16:38:39');
INSERT INTO faq_translations VALUES('3','3','English','How to withdraw money from my account?','We have different types of withdraw method. You can withdraw money to your bank account as well as your mobile banking account.','2021-08-31 11:09:39','2021-09-05 16:47:11');
INSERT INTO faq_translations VALUES('7','4','English','How to Apply for Loan?','You can apply loan based on your collateral.','2021-09-05 16:47:59','2021-09-05 16:47:59');
INSERT INTO faq_translations VALUES('8','5','English','How to Apply for Fixed Deposit?','If you have available balance in your account then you can apply for fixed deposit.','2021-09-05 16:58:05','2021-09-05 16:58:05');



DROP TABLE IF EXISTS faqs;

CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO faqs VALUES('1','1','','2021-08-31 11:06:18','2021-08-31 11:06:18');
INSERT INTO faqs VALUES('2','1','','2021-08-31 11:09:26','2021-08-31 11:09:26');
INSERT INTO faqs VALUES('3','1','','2021-08-31 11:09:39','2021-08-31 11:09:39');
INSERT INTO faqs VALUES('4','1','','2021-09-05 16:47:59','2021-09-05 16:47:59');
INSERT INTO faqs VALUES('5','1','','2021-09-05 16:58:05','2021-09-05 16:58:05');



DROP TABLE IF EXISTS fdr_plans;

CREATE TABLE `fdr_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `interest_rate` decimal(10,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `duration_type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO fdr_plans VALUES('1','Basic','10.00','500.00','8.00','12','month','1','','2021-08-09 15:34:14','2021-09-05 14:39:27');
INSERT INTO fdr_plans VALUES('2','Standard','100.00','1000.00','10.00','24','month','1','','2021-09-05 14:39:11','2021-09-05 14:39:34');
INSERT INTO fdr_plans VALUES('3','Professional','500.00','20000.00','15.00','36','month','1','','2021-09-05 14:40:06','2021-09-05 14:40:06');



DROP TABLE IF EXISTS fdrs;

CREATE TABLE `fdrs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fdr_plan_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) unsigned NOT NULL,
  `deposit_amount` decimal(10,2) NOT NULL,
  `return_amount` decimal(10,2) NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_date` date DEFAULT NULL,
  `mature_date` date DEFAULT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `approved_user_id` bigint(20) DEFAULT NULL,
  `created_user_id` bigint(20) DEFAULT NULL,
  `updated_user_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS gift_cards;

CREATE TABLE `gift_cards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `used_at` datetime DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO gift_cards VALUES('1','Q53F-LP3P-5F20-L65Z','3','5000.00','1','9','2021-10-24 15:00:34','','2021-10-24 15:00:13','2021-10-24 15:00:34');
INSERT INTO gift_cards VALUES('2','S782-SF0Q-7051-2F24','3','10000.00','1','9','2021-10-24 15:12:21','','2021-10-24 15:11:46','2021-10-24 15:12:21');



DROP TABLE IF EXISTS loan_collaterals;

CREATE TABLE `loan_collaterals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `collateral_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_price` decimal(10,2) NOT NULL,
  `attachments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS loan_payments;

CREATE TABLE `loan_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) NOT NULL,
  `paid_at` date NOT NULL,
  `late_penalties` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `repayment_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO loan_payments VALUES('1','1','2021-10-24','0.00','104.17','2187.50','','9','9','1','2021-10-24 15:17:53','2021-10-24 15:17:53');



DROP TABLE IF EXISTS loan_products;

CREATE TABLE `loan_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` decimal(10,2) DEFAULT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest_rate` decimal(10,2) NOT NULL,
  `interest_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` int(11) NOT NULL,
  `term_period` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO loan_products VALUES('7','Market Loan - 10,000','','10000.00','','5.00','flat_rate','4','+1 week','1','2021-11-30 10:34:14','2021-12-13 13:48:10');
INSERT INTO loan_products VALUES('11','Market Loan - 20,000','','20000.00','','5.00','flat_rate','4','+1 week','1','2021-12-05 07:51:15','2021-12-13 13:48:35');
INSERT INTO loan_products VALUES('12','Market Loan - 30,000','','30000.00','','5.00','flat_rate','4','+1 week','1','2021-12-13 13:49:16','2021-12-13 13:49:16');



DROP TABLE IF EXISTS loan_repayments;

CREATE TABLE `loan_repayments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint(20) NOT NULL,
  `repayment_date` date NOT NULL,
  `amount_to_pay` decimal(10,2) NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `principal_amount` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `total_paid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `updated_by_id` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=358 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO loan_repayments VALUES('301','156','2022-01-02','5000.00','0.00','5000.00','0.00','0.00','','4','','2021-12-05 09:17:15','2021-12-05 10:58:31');
INSERT INTO loan_repayments VALUES('300','156','2021-12-26','5000.00','0.00','5000.00','0.00','5000.00','','4','','2021-12-05 09:17:15','2021-12-05 10:58:38');
INSERT INTO loan_repayments VALUES('299','156','2021-12-19','5000.00','0.00','5000.00','0.00','10000.00','','4','','2021-12-05 09:17:15','2021-12-05 10:58:44');
INSERT INTO loan_repayments VALUES('298','156','2021-12-12','5000.00','0.00','5000.00','0.00','15000.00','','4','Justina Carpenter','2021-12-05 09:17:15','2021-12-06 00:55:11');
INSERT INTO loan_repayments VALUES('302','161','2021-12-12','25000.00','5000.00','25000.00','0.00','75000.00','','4','admin admin','2021-12-05 22:50:30','2021-12-05 23:17:35');
INSERT INTO loan_repayments VALUES('303','161','2021-12-19','25000.00','5000.00','25000.00','0.00','50000.00','','4','admin admin','2021-12-05 22:50:30','2021-12-05 23:18:28');
INSERT INTO loan_repayments VALUES('304','161','2021-12-26','25000.00','5000.00','25000.00','0.00','25000.00','','4','admin admin','2021-12-05 22:50:30','2021-12-05 23:18:34');
INSERT INTO loan_repayments VALUES('305','161','2022-01-02','25000.00','5000.00','25000.00','0.00','0.00','','4','admin admin','2021-12-05 22:50:30','2021-12-05 23:18:39');
INSERT INTO loan_repayments VALUES('310','178','1970-01-01','25000.00','0.00','25000.00','0.00','75000.00','','0','','2021-12-08 13:07:09','2021-12-08 13:07:09');
INSERT INTO loan_repayments VALUES('311','178','1970-01-08','25000.00','0.00','25000.00','0.00','50000.00','','0','','2021-12-08 13:07:09','2021-12-08 13:07:09');
INSERT INTO loan_repayments VALUES('312','178','1970-01-15','25000.00','0.00','25000.00','0.00','25000.00','','0','','2021-12-08 13:07:09','2021-12-08 13:07:09');
INSERT INTO loan_repayments VALUES('313','178','1970-01-22','25000.00','0.00','25000.00','0.00','0.00','','0','','2021-12-08 13:07:09','2021-12-08 13:07:09');
INSERT INTO loan_repayments VALUES('314','179','2021-12-15','25000.00','5000.00','25000.00','0.00','75000.00','','0','','2021-12-09 05:44:05','2021-12-09 05:44:05');
INSERT INTO loan_repayments VALUES('315','179','2021-12-22','25000.00','5000.00','25000.00','0.00','50000.00','','0','','2021-12-09 05:44:05','2021-12-09 05:44:05');
INSERT INTO loan_repayments VALUES('316','179','2021-12-29','25000.00','5000.00','25000.00','0.00','25000.00','','0','','2021-12-09 05:44:05','2021-12-09 05:44:05');
INSERT INTO loan_repayments VALUES('317','179','2022-01-05','25000.00','5000.00','25000.00','0.00','0.00','','0','','2021-12-09 05:44:05','2021-12-09 05:44:05');
INSERT INTO loan_repayments VALUES('352','189','1970-01-15','2500.00','0.00','2500.00','0.00','2500.00','','0','','2021-12-15 22:38:42','2021-12-15 22:38:42');
INSERT INTO loan_repayments VALUES('351','189','1970-01-08','2500.00','0.00','2500.00','0.00','5000.00','','0','','2021-12-15 22:38:42','2021-12-15 22:38:42');
INSERT INTO loan_repayments VALUES('350','189','1970-01-01','2500.00','0.00','2500.00','0.00','7500.00','','0','','2021-12-15 22:38:42','2021-12-15 22:38:42');
INSERT INTO loan_repayments VALUES('342','187','1970-01-01','5000.00','0.00','5000.00','0.00','15000.00','','0','','2021-12-13 13:01:08','2021-12-13 13:01:08');
INSERT INTO loan_repayments VALUES('343','187','1970-01-08','5000.00','0.00','5000.00','0.00','10000.00','','0','','2021-12-13 13:01:08','2021-12-13 13:01:08');
INSERT INTO loan_repayments VALUES('344','187','1970-01-15','5000.00','0.00','5000.00','0.00','5000.00','','0','','2021-12-13 13:01:08','2021-12-13 13:01:08');
INSERT INTO loan_repayments VALUES('345','187','1970-01-22','5000.00','0.00','5000.00','0.00','0.00','','0','','2021-12-13 13:01:08','2021-12-13 13:01:08');
INSERT INTO loan_repayments VALUES('346','188','1970-01-01','5000.00','0.00','5000.00','0.00','15000.00','','0','','2021-12-13 13:21:04','2021-12-13 13:21:04');
INSERT INTO loan_repayments VALUES('347','188','1970-01-08','5000.00','0.00','5000.00','0.00','10000.00','','0','','2021-12-13 13:21:04','2021-12-13 13:21:04');
INSERT INTO loan_repayments VALUES('348','188','1970-01-15','5000.00','0.00','5000.00','0.00','5000.00','','0','','2021-12-13 13:21:04','2021-12-13 13:21:04');
INSERT INTO loan_repayments VALUES('349','188','1970-01-22','5000.00','0.00','5000.00','0.00','0.00','','0','','2021-12-13 13:21:04','2021-12-13 13:21:04');
INSERT INTO loan_repayments VALUES('353','189','1970-01-22','2500.00','0.00','2500.00','0.00','0.00','','0','','2021-12-15 22:38:42','2021-12-15 22:38:42');
INSERT INTO loan_repayments VALUES('354','190','1970-01-01','2500.00','0.00','2500.00','0.00','7500.00','','0','','2021-12-15 23:05:07','2021-12-15 23:05:07');
INSERT INTO loan_repayments VALUES('355','190','1970-01-08','2500.00','0.00','2500.00','0.00','5000.00','','0','','2021-12-15 23:05:07','2021-12-15 23:05:07');
INSERT INTO loan_repayments VALUES('356','190','1970-01-15','2500.00','0.00','2500.00','0.00','2500.00','','0','','2021-12-15 23:05:07','2021-12-15 23:05:07');
INSERT INTO loan_repayments VALUES('357','190','1970-01-22','2500.00','0.00','2500.00','0.00','0.00','','0','','2021-12-15 23:05:07','2021-12-15 23:05:07');



DROP TABLE IF EXISTS loans;

CREATE TABLE `loans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_product_id` bigint(20) unsigned NOT NULL,
  `borrower_id` bigint(20) unsigned NOT NULL,
  `first_payment_date` date DEFAULT NULL,
  `release_date` timestamp NULL DEFAULT NULL,
  `duration` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) NOT NULL,
  `applied_amount` decimal(10,2) NOT NULL,
  `total_payable` decimal(10,2) DEFAULT NULL,
  `total_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `late_payment_penalties` decimal(10,2) NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_date` date DEFAULT NULL,
  `approved_user_id` bigint(20) DEFAULT NULL,
  `created_user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO loans VALUES('190','SYT197717684788575419M','7','77','1970-01-01','2021-12-15 00:00:00','','1','10000.00','10500.00','10500.00','0.00','','16','','','1','2021-12-15','1','67','2021-12-15 23:01:37','2021-12-15 23:06:44');
INSERT INTO loans VALUES('189','SYT682140','7','77','1970-01-01','2021-12-15 00:00:00','','1','10000.00','10500.00','10500.00','0.00','','16','','','2','2021-12-15','1','75','2021-12-15 22:38:04','2021-12-15 23:00:13');
INSERT INTO loans VALUES('188','SYT769744','11','69','1970-01-01','2021-12-13 00:00:00','','1','20000.00','21000.00','20000.00','0.00','','16','','','1','2021-12-13','1','73','2021-12-13 13:18:03','2021-12-13 13:22:29');
INSERT INTO loans VALUES('187','SYT244966','11','74','1970-01-01','2021-12-13 00:00:00','','1','20000.00','21000.00','8500.00','0.00','','16','','','1','2021-12-13','1','73','2021-12-13 12:56:56','2021-12-16 00:07:16');



DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES('1','2014_10_12_000000_create_users_table','1');
INSERT INTO migrations VALUES('2','2014_10_12_100000_create_password_resets_table','1');
INSERT INTO migrations VALUES('3','2018_11_12_152015_create_email_templates_table','1');
INSERT INTO migrations VALUES('4','2019_08_19_000000_create_failed_jobs_table','1');
INSERT INTO migrations VALUES('5','2019_09_01_080940_create_settings_table','1');
INSERT INTO migrations VALUES('6','2020_07_02_145857_create_database_backups_table','1');
INSERT INTO migrations VALUES('7','2020_07_06_142817_create_roles_table','1');
INSERT INTO migrations VALUES('8','2020_07_06_143240_create_permissions_table','1');
INSERT INTO migrations VALUES('9','2021_03_22_071324_create_setting_translations','1');
INSERT INTO migrations VALUES('10','2021_07_02_145504_create_pages_table','1');
INSERT INTO migrations VALUES('11','2021_07_02_145952_create_page_translations_table','1');
INSERT INTO migrations VALUES('12','2021_08_06_104648_create_branches_table','1');
INSERT INTO migrations VALUES('13','2021_08_07_100944_create_other_banks_table','1');
INSERT INTO migrations VALUES('14','2021_08_07_111236_create_currency_table','1');
INSERT INTO migrations VALUES('15','2021_08_08_132702_create_payment_gateways_table','1');
INSERT INTO migrations VALUES('16','2021_08_08_152535_create_deposit_methods_table','1');
INSERT INTO migrations VALUES('17','2021_08_08_164152_create_withdraw_methods_table','1');
INSERT INTO migrations VALUES('18','2021_08_09_064023_create_transactions_table','1');
INSERT INTO migrations VALUES('19','2021_08_09_132854_create_fdr_plans_table','1');
INSERT INTO migrations VALUES('20','2021_08_10_075622_create_gift_cards_table','1');
INSERT INTO migrations VALUES('21','2021_08_10_095536_create_fdrs_table','1');
INSERT INTO migrations VALUES('22','2021_08_10_102503_create_support_tickets_table','1');
INSERT INTO migrations VALUES('23','2021_08_10_102527_create_support_ticket_messages_table','1');
INSERT INTO migrations VALUES('24','2021_08_20_092846_create_payment_requests_table','1');
INSERT INTO migrations VALUES('25','2021_08_20_150101_create_deposit_requests_table','1');
INSERT INTO migrations VALUES('26','2021_08_20_160124_create_withdraw_requests_table','1');
INSERT INTO migrations VALUES('27','2021_08_23_160216_create_notifications_table','1');
INSERT INTO migrations VALUES('28','2021_08_31_070908_create_services_table','1');
INSERT INTO migrations VALUES('29','2021_08_31_071002_create_service_translations_table','1');
INSERT INTO migrations VALUES('30','2021_08_31_075115_create_news_table','1');
INSERT INTO migrations VALUES('31','2021_08_31_075125_create_news_translations_table','1');
INSERT INTO migrations VALUES('32','2021_08_31_094252_create_faqs_table','1');
INSERT INTO migrations VALUES('33','2021_08_31_094301_create_faq_translations_table','1');
INSERT INTO migrations VALUES('34','2021_08_31_101309_create_testimonials_table','1');
INSERT INTO migrations VALUES('35','2021_08_31_101319_create_testimonial_translations_table','1');
INSERT INTO migrations VALUES('36','2021_08_31_201125_create_navigations_table','1');
INSERT INTO migrations VALUES('37','2021_08_31_201126_create_navigation_items_table','1');
INSERT INTO migrations VALUES('38','2021_08_31_201127_create_navigation_item_translations_table','1');
INSERT INTO migrations VALUES('39','2021_09_04_142110_create_teams_table','1');
INSERT INTO migrations VALUES('40','2021_10_04_082019_create_loan_products_table','1');
INSERT INTO migrations VALUES('41','2021_10_06_070947_create_loans_table','1');
INSERT INTO migrations VALUES('42','2021_10_06_071153_create_loan_collaterals_table','1');
INSERT INTO migrations VALUES('43','2021_10_12_104151_create_loan_repayments_table','1');
INSERT INTO migrations VALUES('44','2021_10_14_065743_create_loan_payments_table','1');
INSERT INTO migrations VALUES('45','2019_12_14_000001_create_personal_access_tokens_table','2');



DROP TABLE IF EXISTS navigation_item_translations;

CREATE TABLE `navigation_item_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_item_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `navigation_item_translations_navigation_item_id_locale_unique` (`navigation_item_id`,`locale`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO navigation_item_translations VALUES('6','6','English','Home','2021-08-31 18:17:46','2021-08-31 18:17:46');
INSERT INTO navigation_item_translations VALUES('7','7','English','About','2021-08-31 18:17:58','2021-08-31 18:17:58');
INSERT INTO navigation_item_translations VALUES('8','8','English','Services','2021-08-31 18:18:44','2021-08-31 18:18:44');
INSERT INTO navigation_item_translations VALUES('10','10','English','FAQ','2021-08-31 18:19:27','2021-08-31 18:19:27');
INSERT INTO navigation_item_translations VALUES('11','11','English','Contact','2021-08-31 18:19:43','2021-08-31 18:19:43');
INSERT INTO navigation_item_translations VALUES('15','15','English','Contact','2021-08-31 19:12:42','2021-09-04 17:22:15');
INSERT INTO navigation_item_translations VALUES('26','20','English','About','2021-09-04 17:21:32','2021-09-04 17:21:32');
INSERT INTO navigation_item_translations VALUES('27','21','English','Services','2021-09-04 17:22:06','2021-09-04 17:22:06');
INSERT INTO navigation_item_translations VALUES('28','22','English','Terms & Condition','2021-09-04 17:22:58','2021-09-04 17:22:58');
INSERT INTO navigation_item_translations VALUES('29','23','English','Privacy Policy','2021-09-04 17:23:10','2021-09-04 17:23:10');
INSERT INTO navigation_item_translations VALUES('30','24','English','FAQ','2021-09-04 17:23:20','2021-09-04 17:23:20');



DROP TABLE IF EXISTS navigation_items;

CREATE TABLE `navigation_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `navigation_id` bigint(20) unsigned NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` bigint(20) unsigned DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `css_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `navigation_items_parent_id_foreign` (`parent_id`),
  KEY `navigation_items_page_id_foreign` (`page_id`),
  KEY `navigation_items_navigation_id_index` (`navigation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO navigation_items VALUES('6','1','dynamic_url','','/','','_self','','1','1','','','2021-08-31 18:17:46','2021-08-31 18:28:52');
INSERT INTO navigation_items VALUES('7','1','dynamic_url','','/about','','_self','','2','1','','','2021-08-31 18:17:58','2021-08-31 18:28:52');
INSERT INTO navigation_items VALUES('8','1','dynamic_url','','/services','','_self','','3','1','','','2021-08-31 18:18:44','2021-08-31 18:28:52');
INSERT INTO navigation_items VALUES('10','1','dynamic_url','','faq','','_self','','4','1','','','2021-08-31 18:19:27','2021-09-04 17:20:28');
INSERT INTO navigation_items VALUES('11','1','dynamic_url','','/contact','','_self','','5','1','','','2021-08-31 18:19:43','2021-09-04 17:20:28');
INSERT INTO navigation_items VALUES('15','2','dynamic_url','','/contact','','_self','','1','1','','','2021-08-31 19:12:42','2021-09-04 17:22:17');
INSERT INTO navigation_items VALUES('20','2','dynamic_url','','/about','','_self','','2','1','','','2021-09-04 17:21:32','2021-09-04 17:22:17');
INSERT INTO navigation_items VALUES('21','2','dynamic_url','','/services','','_self','','3','1','','','2021-09-04 17:22:06','2021-09-04 17:22:17');
INSERT INTO navigation_items VALUES('22','3','page','2','','','_self','','2','1','','','2021-09-04 17:22:58','2021-09-04 17:23:26');
INSERT INTO navigation_items VALUES('23','3','page','1','','','_self','','1','1','','','2021-09-04 17:23:10','2021-09-04 17:23:26');
INSERT INTO navigation_items VALUES('24','3','dynamic_url','','/faq','','_self','','3','1','','','2021-09-04 17:23:20','2021-09-04 17:23:26');



DROP TABLE IF EXISTS navigations;

CREATE TABLE `navigations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO navigations VALUES('1','Primary Menu','1','2021-08-31 12:11:31','2021-08-31 12:11:31');
INSERT INTO navigations VALUES('2','Quick Explore','1','2021-08-31 19:11:36','2021-08-31 19:11:36');
INSERT INTO navigations VALUES('3','Pages','1','2021-08-31 19:11:43','2021-09-04 17:22:30');



DROP TABLE IF EXISTS news;

CREATE TABLE `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS news_translations;

CREATE TABLE `news_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_translations_news_id_locale_unique` (`news_id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS notifications;

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO notifications VALUES('a8475666-9097-497c-b980-65b26e75dd24','App\\Notifications\\DepositMoney','App\\Models\\User','6','{\"message\":\"Dear Sir, Your account has been credited by \\u20a62,000.00 on 2021-10-24 01:38 PM\"}','2021-10-24 13:40:41','2021-10-24 13:39:55','2021-10-24 13:40:41');
INSERT INTO notifications VALUES('9d065718-1142-4c6f-b213-9b538b4469a3','App\\Notifications\\DepositMoney','App\\Models\\User','9','{\"message\":\"Dear Sir, Your account has been credited by \\u20a62,000.00 on 2021-10-24 03:08 PM\"}','','2021-10-24 15:09:04','2021-10-24 15:09:04');
INSERT INTO notifications VALUES('0f1cb713-0959-4902-88e7-cb2a387d770c','App\\Notifications\\ApprovedLoanRequest','App\\Models\\User','9','{\"message\":\"Dear Sir, Your loan request has been approved. Your account has been credited by \\u20a650,000.00 on 2021-10-24 03:16 PM\"}','2021-10-24 15:27:53','2021-10-24 15:16:18','2021-10-24 15:27:53');



DROP TABLE IF EXISTS other_banks;

CREATE TABLE `other_banks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `swift_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_currency` bigint(20) NOT NULL,
  `minimum_transfer_amount` decimal(10,2) NOT NULL,
  `maximum_transfer_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS page_translations;

CREATE TABLE `page_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_translations_page_id_locale_unique` (`page_id`,`locale`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO page_translations VALUES('1','1','English','Privacy Policy','<h1>Privacy Policy for Livo Bank</h1>
<p>At LivoBank, accessible from https://livo-bank.trickycode.xyz, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by LivoBank and how we use it.</p>
<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>
<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in LivoBank. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the <a href=\"https://www.termsfeed.com/privacy-policy-generator/\">TermsFeed Privacy Policy Generator</a>.</p>
<h2>Consent</h2>
<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>
<h2>Information we collect</h2>
<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>
<h2>How we use your information</h2>
<p>We use the information we collect in various ways, including to:</p>
<ul>
<li>Provide, operate, and maintain our website</li>
<li>Improve, personalize, and expand our website</li>
<li>Understand and analyze how you use our website</li>
<li>Develop new products, services, features, and functionality</li>
<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>
<li>Send you emails</li>
<li>Find and prevent fraud</li>
</ul>
<h2>Log Files</h2>
<p>LivoBank follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services\' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users\' movement on the website, and gathering demographic information.</p>
<h2>Advertising Partners Privacy Policies</h2>
<p>You may consult this list to find the Privacy Policy for each of the advertising partners of LivoBank.</p>
<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on LivoBank, which are sent directly to users\' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>
<p>Note that LivoBank has no access to or control over these cookies that are used by third-party advertisers.</p>
<h2>Third Party Privacy Policies</h2>
<p>LivoBank\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.</p>
<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers\' respective websites.</p>
<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>
<p>Under the CCPA, among other rights, California consumers have the right to:</p>
<p>Request that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
<p>Request that a business delete any personal data about the consumer that a business has collected.</p>
<p>Request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>
<h2>GDPR Data Protection Rights</h2>
<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
<p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
<p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
<p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
<p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
<p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
<p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>
<h2>Children\'s Information</h2>
<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>
<p>LivoBank does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>','2021-08-31 11:42:32','2021-09-05 15:27:37');
INSERT INTO page_translations VALUES('2','2','English','Terms & Condition','<h2><strong>Terms and Conditions</strong></h2>
<p>Welcome to LivoBank!</p>
<p>These terms and conditions outline the rules and regulations for the use of Livo Bank\'s Website, located at https://livo-bank.trickycode.xyz.</p>
<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use LivoBank if you do not agree to take all of the terms and conditions stated on this page.</p>
<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company’s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>
<h3><strong>Cookies</strong></h3>
<p>We employ the use of cookies. By accessing LivoBank, you agreed to use cookies in agreement with the Livo Bank\'s Privacy Policy.</p>
<p>Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>
<h3><strong>License</strong></h3>
<p>Unless otherwise stated, Livo Bank and/or its licensors own the intellectual property rights for all material on LivoBank. All intellectual property rights are reserved. You may access this from LivoBank for your own personal use subjected to restrictions set in these terms and conditions.</p>
<p>You must not:</p>
<ul>
<li>Republish material from LivoBank</li>
<li>Sell, rent or sub-license material from LivoBank</li>
<li>Reproduce, duplicate or copy material from LivoBank</li>
<li>Redistribute content from LivoBank</li>
</ul>
<p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the <a href=\"https://www.termsandconditionsgenerator.com\">Terms And Conditions Generator</a>.</p>
<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. Livo Bank does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of Livo Bank,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, Livo Bank shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>
<p>Livo Bank reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.</p>
<p>You warrant and represent that:</p>
<ul>
<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;</li>
<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;</li>
<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.</li>
</ul>
<p>You hereby grant Livo Bank a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>
<h3><strong>Hyperlinking to our Content</strong></h3>
<p>The following organizations may link to our Website without prior written approval:</p>
<ul>
<li>Government agencies;</li>
<li>Search engines;</li>
<li>News organizations;</li>
<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and</li>
<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
</ul>
<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.</p>
<p>We may consider and approve other link requests from the following types of organizations:</p>
<ul>
<li>commonly-known consumer and/or business information sources;</li>
<li>dot.com community sites;</li>
<li>associations or other groups representing charities;</li>
<li>online directory distributors;</li>
<li>internet portals;</li>
<li>accounting, law and consulting firms; and</li>
<li>educational institutions and trade associations.</li>
</ul>
<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of Livo Bank; and (d) the link is in the context of general resource information.</p>
<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.</p>
<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to Livo Bank. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>
<p>Approved organizations may hyperlink to our Website as follows:</p>
<ul>
<li>By use of our corporate name; or</li>
<li>By use of the uniform resource locator being linked to; or</li>
<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.</li>
</ul>
<p>No use of Livo Bank\'s logo or other artwork will be allowed for linking absent a trademark license agreement.</p>
<h3><strong>iFrames</strong></h3>
<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>
<h3><strong>Content Liability</strong></h3>
<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>
<h3><strong>Your Privacy</strong></h3>
<p>Please read Privacy Policy</p>
<h3><strong>Reservation of Rights</strong></h3>
<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>
<h3><strong>Removal of links from our website</strong></h3>
<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>
<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>
<h3><strong>Disclaimer</strong></h3>
<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:</p>
<ul>
<li>limit or exclude our or your liability for death or personal injury;</li>
<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
</ul>
<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.</p>
<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>','2021-08-31 11:44:42','2021-09-05 15:34:10');



DROP TABLE IF EXISTS pages;

CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO pages VALUES('1','privacy-policy','1','2021-08-31 11:42:32','2021-08-31 11:42:32');
INSERT INTO pages VALUES('2','terms-condition','1','2021-08-31 11:44:42','2021-08-31 11:44:42');



DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS payment_gateways;

CREATE TABLE `payment_gateways` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supported_currencies` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exchange_rate` decimal(10,6) DEFAULT NULL,
  `fixed_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `charge_in_percentage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `minimum_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `maximum_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO payment_gateways VALUES('1','PayPal','PayPal','paypal.png','0','{\"client_id\":\"\",\"client_secret\":\"\",\"environment\":\"sandbox\"}','','{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"USD\"}','','','0.00','0.00','0.00','0.00','','');
INSERT INTO payment_gateways VALUES('2','Stripe','Stripe','stripe.png','0','{\"secret_key\":\"\",\"publishable_key\":\"\"}','','{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}','','','0.00','0.00','0.00','0.00','','');
INSERT INTO payment_gateways VALUES('3','Razorpay','Razorpay','razorpay.png','0','{\"razorpay_key_id\":\"\",\"razorpay_key_secret\":\"\"}','','{\"INR\":\"INR\"}','','','0.00','0.00','0.00','0.00','','');
INSERT INTO payment_gateways VALUES('4','Paystack','Paystack','paystack.png','0','{\"paystack_public_key\":\"\",\"paystack_secret_key\":\"\"}','','{\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}','','','0.00','0.00','0.00','0.00','','');
INSERT INTO payment_gateways VALUES('5','BlockChain','BlockChain','blockchain.png','0','{\"blockchain_api_key\":\"\",\"blockchain_xpub\":\"\"}','','{\"BTC\":\"BTC\"}','','','0.00','0.00','0.00','0.00','','');
INSERT INTO payment_gateways VALUES('6','Flutterwave','Flutterwave','flutterwave.png','1','{\"public_key\":\"FLWPUBK_TEST-89e101883e9a29f48c93c007e031e0ec-X\",\"secret_key\":\"FLWSECK_TEST-53da5e54c43923426d9e30e91cbc1909-X\",\"encryption_key\":\"FLWSECK_TEST90667356906a\",\"environment\":\"sandbox\"}','NGN','{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}','','1.000000','0.00','0.25','100.00','500000.00','','2021-10-24 13:31:07');



DROP TABLE IF EXISTS payment_requests;

CREATE TABLE `payment_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `currency_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS permissions;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) NOT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS personal_access_tokens;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO personal_access_tokens VALUES('1','App\\Models\\User','1','developer-access','b1cb2bd8a7f331b4ff7c06fc381254616fe933e68287b9050cd4a9ebb3c85267','[\"*\"]','','2021-11-14 02:35:22','2021-11-14 02:35:22');
INSERT INTO personal_access_tokens VALUES('2','App\\Models\\User','1','MyApp','07e715daf886b191086d7760e4cde7680ca5525ae0b50d18acd478fea26a0142','[\"*\"]','','2021-11-14 21:38:47','2021-11-14 21:38:47');
INSERT INTO personal_access_tokens VALUES('3','App\\Models\\User','1','MyApp','2774a047716040fe6b4998cb8756eb1c232e18c14339ed416affe5d0acf62e69','[\"*\"]','','2021-11-15 00:38:04','2021-11-15 00:38:04');
INSERT INTO personal_access_tokens VALUES('4','App\\Models\\User','1','MyApp','64682154c1f7c126f1691d3f604ba301d7e191c3d65e4366d50951d1aadd782d','[\"*\"]','','2021-11-15 00:38:37','2021-11-15 00:38:37');
INSERT INTO personal_access_tokens VALUES('5','App\\Models\\User','1','MyApp','d1cdc6c923cb974635cb4c4bf6e68328f505bd69418e47056ec68ed975e611ef','[\"*\"]','','2021-11-15 00:38:40','2021-11-15 00:38:40');
INSERT INTO personal_access_tokens VALUES('6','App\\Models\\User','1','MyApp','fac9a79795f1b9b17acf4a6332d219d4ed3074f2020398ad8827bad91cef576a','[\"*\"]','','2021-11-15 06:25:55','2021-11-15 06:25:55');
INSERT INTO personal_access_tokens VALUES('7','App\\Models\\User','1','MyApp','4f6cf2e5a06656c2935db3452e1c16c01a6144f8cc3e0ea5082932caa777b94b','[\"*\"]','','2021-11-15 06:27:13','2021-11-15 06:27:13');
INSERT INTO personal_access_tokens VALUES('8','App\\Models\\User','1','MyApp','626b0b5fd7591d8bff5f34066fd400f6d0452b27a70dc21c6b0835abb81f5ea9','[\"*\"]','','2021-11-15 06:29:12','2021-11-15 06:29:12');
INSERT INTO personal_access_tokens VALUES('9','App\\Models\\User','1','MyApp','c7c91f3d95491ade05383c823e60e4ddc911a0de48eb6f130260833a8190274d','[\"*\"]','','2021-11-15 06:30:46','2021-11-15 06:30:46');
INSERT INTO personal_access_tokens VALUES('10','App\\Models\\User','1','MyApp','d32c24bb87589b6cb297cab569f035efb1fd05149cfa9b14dd31b9802ddb792f','[\"*\"]','','2021-11-15 06:35:47','2021-11-15 06:35:47');
INSERT INTO personal_access_tokens VALUES('11','App\\Models\\User','1','MyApp','7e049fcbad83f477bea46eaad8f22bac967c499a2ec21e2edd4b154b720a4c2e','[\"*\"]','','2021-11-16 22:41:28','2021-11-16 22:41:28');
INSERT INTO personal_access_tokens VALUES('12','App\\Models\\User','1','MyApp','70a8c67f5d764e7ede9061ad121786896f37ff8154a5b817fbd7d6ecd3dd433e','[\"*\"]','','2021-11-17 08:19:43','2021-11-17 08:19:43');
INSERT INTO personal_access_tokens VALUES('13','App\\Models\\User','1','MyApp','7a564d37681db48047424bf69881af173d0f2aa3097578e6c1d6da57acccfb36','[\"*\"]','','2021-11-17 10:34:16','2021-11-17 10:34:16');
INSERT INTO personal_access_tokens VALUES('14','App\\Models\\User','1','MyApp','631c3cbab3845debaf92a95b7a90cc0f6d3f449d317c72596ea73065d2121ae4','[\"*\"]','','2021-11-17 10:36:56','2021-11-17 10:36:56');
INSERT INTO personal_access_tokens VALUES('15','App\\Models\\User','1','MyApp','cff26afb9cfd89b5af0787d9ae8205fe444a0be6bc01282d3accac4a2ee06c7a','[\"*\"]','','2021-11-17 10:37:41','2021-11-17 10:37:41');
INSERT INTO personal_access_tokens VALUES('16','App\\Models\\User','1','MyApp','7ee8e723aae21a3294baa442affc190cb7afbe92ba77cae39332a4885c45e426','[\"*\"]','','2021-11-17 11:18:13','2021-11-17 11:18:13');
INSERT INTO personal_access_tokens VALUES('17','App\\Models\\User','17','MyApp','44ad72719bfc3b2b3e69662136ed6d19d64d8cf52c687745afc4018dcdd8aa7b','[\"*\"]','','2021-11-17 11:26:29','2021-11-17 11:26:29');
INSERT INTO personal_access_tokens VALUES('18','App\\Models\\User','1','MyApp','99f6ac50fa6b64f35dbff7b95d78b8301f7da1c17bfa05c6a8079d39c09ca517','[\"*\"]','','2021-11-17 15:49:10','2021-11-17 15:49:10');
INSERT INTO personal_access_tokens VALUES('19','App\\Models\\User','17','MyApp','8baaacf9c0e3154048f62929f2922b7e974c865b7ff15e5a531ae551ce523aec','[\"*\"]','','2021-11-17 19:32:45','2021-11-17 19:32:45');
INSERT INTO personal_access_tokens VALUES('20','App\\Models\\User','1','MyApp','ce2a7bd4f8ddf52b978abddbbfc9a416016b35225759d1d55895ea4860b3bff9','[\"*\"]','','2021-11-18 06:58:28','2021-11-18 06:58:28');
INSERT INTO personal_access_tokens VALUES('21','App\\Models\\User','1','MyApp','d216cd78281c7008bc4022fc70369a439ba6225d88e323029435fbf4d8a3a33f','[\"*\"]','','2021-11-18 07:45:29','2021-11-18 07:45:29');
INSERT INTO personal_access_tokens VALUES('22','App\\Models\\User','1','MyApp','4479f332b29385845828b39ca4c60389e1658a3990fa9355a97123545b2db783','[\"*\"]','','2021-11-18 08:13:46','2021-11-18 08:13:46');
INSERT INTO personal_access_tokens VALUES('23','App\\Models\\User','1','MyApp','952166dbe6440989890891ae84acaf8974378e26f3108818ed0cee35bdaa6c2c','[\"*\"]','','2021-11-18 09:01:05','2021-11-18 09:01:05');
INSERT INTO personal_access_tokens VALUES('24','App\\Models\\User','1','MyApp','b35ea314f08f822a0a26031c7f01d9ed26aaa029b67e34e83f9a20eea2fada17','[\"*\"]','','2021-11-18 09:01:33','2021-11-18 09:01:33');
INSERT INTO personal_access_tokens VALUES('25','App\\Models\\User','1','MyApp','16d899618cec0f0a36f4435790866de11f1dfafa3c9ced10cfe41f62c0c1acfc','[\"*\"]','','2021-11-18 09:02:26','2021-11-18 09:02:26');



DROP TABLE IF EXISTS repayments;

CREATE TABLE `repayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` varchar(100) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `loan_product_id` int(20) DEFAULT NULL,
  `borrower_id` int(20) DEFAULT NULL,
  `agent_id` int(20) DEFAULT NULL,
  `total_paid` varchar(50) DEFAULT NULL,
  `balance` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO repayments VALUES('23','SYT702670','13','7','61','67','50000','0','4','2021-12-09 07:04:46','2021-12-09 07:04:46');
INSERT INTO repayments VALUES('20','SYT597080','13','7','60','67','3000','97000','4','2021-12-08 15:56:28','2021-12-08 15:56:28');
INSERT INTO repayments VALUES('21','SYT597080','13','7','60','67','2000','95000','4','2021-12-09 05:45:27','2021-12-09 05:45:27');
INSERT INTO repayments VALUES('22','SYT702670','13','7','61','67','50000','50000','4','2021-12-09 07:03:16','2021-12-09 07:03:16');
INSERT INTO repayments VALUES('24','SYT961804','13','7','60','67','2000','98000','4','2021-12-12 08:50:34','2021-12-12 08:50:34');
INSERT INTO repayments VALUES('25','SYT961804','13','7','60','67','5000','93000','4','2021-12-12 08:55:52','2021-12-12 08:55:52');
INSERT INTO repayments VALUES('26','SYT961804','13','7','60','67','93000','0','4','2021-12-12 08:57:02','2021-12-12 08:57:02');
INSERT INTO repayments VALUES('27','SYT244966','16','11','74','73','5000','15000','4','2021-12-13 13:03:16','2021-12-13 13:03:16');
INSERT INTO repayments VALUES('28','SYT769744','16','11','69','73','200','19800','4','2021-12-13 13:21:43','2021-12-13 13:21:43');
INSERT INTO repayments VALUES('29','SYT769744','16','11','69','73','19800','0','4','2021-12-13 13:22:29','2021-12-13 13:22:29');
INSERT INTO repayments VALUES('30','SYT682140','16','7','77','75','2000','8000','4','2021-12-15 22:39:20','2021-12-15 22:39:20');
INSERT INTO repayments VALUES('31','SYT682140','16','7','77','75','8000','0','4','2021-12-15 22:43:12','2021-12-15 22:43:12');
INSERT INTO repayments VALUES('32','SYT197717684788575419M','16','7','77','75','10000','0','4','2021-12-15 23:05:47','2021-12-15 23:05:47');
INSERT INTO repayments VALUES('33','SYT244966','16','11','74','67','3500','11500','4','2021-12-16 00:07:16','2021-12-16 00:07:16');



DROP TABLE IF EXISTS roles;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES('1','Agent','','2021-11-17 12:22:37','2021-11-17 12:22:37');



DROP TABLE IF EXISTS service_translations;

CREATE TABLE `service_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_translations_service_id_locale_unique` (`service_id`,`locale`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO service_translations VALUES('1','2','English','Money Transfer','Paragraph of text beneath the heading to explain the heading.','2021-08-31 08:34:38','2021-08-31 08:34:38');
INSERT INTO service_translations VALUES('2','3','English','Multi Currency','Paragraph of text beneath the heading to explain the heading.','2021-08-31 08:35:33','2021-09-05 12:34:07');
INSERT INTO service_translations VALUES('3','4','English','Exchange Currency','Paragraph of text beneath the heading to explain the heading.','2021-08-31 08:38:26','2021-08-31 08:38:26');
INSERT INTO service_translations VALUES('4','5','English','Fixed Deposit','Paragraph of text beneath the heading to explain the heading.','2021-08-31 08:38:44','2021-08-31 08:38:44');
INSERT INTO service_translations VALUES('5','6','English','Apply Loan','Paragraph of text beneath the heading to explain the heading.','2021-08-31 08:39:01','2021-08-31 08:39:01');
INSERT INTO service_translations VALUES('6','7','English','Payment Request','Paragraph of text beneath the heading to explain the heading.','2021-08-31 08:39:19','2021-08-31 08:50:50');



DROP TABLE IF EXISTS services;

CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO services VALUES('2','<i class=\"icofont-paper-plane\"></i>','2021-08-31 08:34:38','2021-09-05 16:33:22');
INSERT INTO services VALUES('3','<i class=\"icofont-money\"></i>','2021-08-31 08:35:33','2021-09-05 12:29:47');
INSERT INTO services VALUES('4','<i class=\"icofont-exchange\"></i>','2021-08-31 08:38:26','2021-09-05 12:30:04');
INSERT INTO services VALUES('5','<i class=\"icofont-bank-alt\"></i>','2021-08-31 08:38:44','2021-09-05 12:30:19');
INSERT INTO services VALUES('6','<i class=\"icofont-file-text\"></i>','2021-08-31 08:39:01','2021-09-05 12:30:32');
INSERT INTO services VALUES('7','<i class=\"icofont-pay\"></i>','2021-08-31 08:39:19','2021-09-05 12:30:43');



DROP TABLE IF EXISTS setting_translations;

CREATE TABLE `setting_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `setting_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_translations_setting_id_locale_unique` (`setting_id`,`locale`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO setting_translations VALUES('1','38','English','Sytiamo Microfinance','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('2','39','English','ASSIST NIGERIAN MARKET WOMEN TO MAKE IMPACT Partner with us','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('3','51','English','1','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('4','69','English','500','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('5','70','English','5','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('6','71','English','1','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('7','72','English','200','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('8','56','English','About Us','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('9','67','English','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('10','68','English','Our Services','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('11','58','English','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('12','59','English','Fixed Deposit Plans','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('13','60','English','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('14','61','English','Loan Packages','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('15','62','English','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('16','63','English','We served over 500+ Customers','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('17','64','English','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-10-24 13:33:15','2021-10-24 13:33:15');
INSERT INTO setting_translations VALUES('18','53','English','Quick Explore','2021-10-24 13:33:46','2021-10-24 13:33:46');
INSERT INTO setting_translations VALUES('19','52','English','2','2021-10-24 13:33:46','2021-10-24 13:33:46');
INSERT INTO setting_translations VALUES('20','54','English','Pages','2021-10-24 13:33:46','2021-10-24 13:33:46');
INSERT INTO setting_translations VALUES('21','55','English','3','2021-10-24 13:33:46','2021-10-24 13:33:46');
INSERT INTO setting_translations VALUES('22','49','English','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-10-24 13:33:46','2021-10-24 13:33:46');
INSERT INTO setting_translations VALUES('23','84','English','','2021-10-24 13:33:46','2021-10-24 13:33:46');
INSERT INTO setting_translations VALUES('24','85','English','','2021-10-24 13:33:47','2021-10-24 13:33:47');
INSERT INTO setting_translations VALUES('25','86','English','','2021-10-24 13:33:47','2021-10-24 13:33:47');
INSERT INTO setting_translations VALUES('26','41','English','Copyright © 2021 <a href=\"#\" target=\"_blank\">Enkwave Solutions</a>  -  All Rights Reserved.','2021-10-24 13:33:47','2021-10-24 13:33:47');



DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO settings VALUES('1','mail_type','smtp','','2021-10-24 13:49:04');
INSERT INTO settings VALUES('2','backend_direction','ltr','','2021-10-24 14:30:32');
INSERT INTO settings VALUES('3','language','English','','2021-10-24 13:22:21');
INSERT INTO settings VALUES('4','email_verification','enabled','','2021-10-24 14:30:32');
INSERT INTO settings VALUES('5','allow_singup','yes','','2021-10-24 14:30:32');
INSERT INTO settings VALUES('6','company_name','Sytiamo Technology','2021-10-24 12:19:51','2021-10-24 13:22:21');
INSERT INTO settings VALUES('7','site_title','Sytiamo','2021-10-24 12:19:51','2021-10-24 13:22:21');
INSERT INTO settings VALUES('8','phone','(+234) 816 010 4387','2021-10-24 12:19:51','2021-10-24 13:22:21');
INSERT INTO settings VALUES('9','email','info@sytiamo.com','2021-10-24 12:19:51','2021-10-24 13:22:21');
INSERT INTO settings VALUES('10','timezone','Africa/Lagos','2021-10-24 12:19:51','2021-10-24 13:22:21');
INSERT INTO settings VALUES('38','main_heading','Sytiamo Microfinance','2021-08-31 16:38:10','2021-10-24 13:33:15');
INSERT INTO settings VALUES('39','sub_heading','ASSIST NIGERIAN MARKET WOMEN TO MAKE IMPACT Partner with us','2021-08-31 16:39:15','2021-10-24 13:33:15');
INSERT INTO settings VALUES('84','facebook_link','','2021-10-24 13:33:46','2021-10-24 13:33:46');
INSERT INTO settings VALUES('40','about_us','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-08-31 16:39:15','2021-08-31 16:57:30');
INSERT INTO settings VALUES('41','copyright','Copyright © 2021 <a href=\"#\" target=\"_blank\">Enkwave Solutions</a>  -  All Rights Reserved.','2021-08-31 16:39:15','2021-10-24 13:33:47');
INSERT INTO settings VALUES('46','meta_keywords','','2021-08-31 16:39:15','2021-08-31 16:39:15');
INSERT INTO settings VALUES('47','meta_content','','2021-08-31 16:39:15','2021-08-31 16:39:15');
INSERT INTO settings VALUES('48','our_mission','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.</p>','2021-08-31 16:54:44','2021-08-31 16:54:44');
INSERT INTO settings VALUES('49','footer_about_us','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-08-31 16:58:14','2021-09-05 12:24:45');
INSERT INTO settings VALUES('51','primary_menu','1','2021-08-31 18:30:14','2021-08-31 18:30:14');
INSERT INTO settings VALUES('52','footer_menu_1','2','2021-08-31 18:30:14','2021-08-31 19:13:31');
INSERT INTO settings VALUES('53','footer_menu_1_title','Quick Explore','2021-09-01 07:50:56','2021-09-01 07:50:56');
INSERT INTO settings VALUES('54','footer_menu_2_title','Pages','2021-09-01 07:50:56','2021-09-05 12:24:45');
INSERT INTO settings VALUES('55','footer_menu_2','3','2021-09-01 07:50:56','2021-09-01 07:50:56');
INSERT INTO settings VALUES('56','home_about_us_heading','About Us','2021-09-05 11:52:18','2021-09-05 11:54:38');
INSERT INTO settings VALUES('57','home_about_us','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-09-05 11:52:18','2021-09-05 11:52:18');
INSERT INTO settings VALUES('58','home_service_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 11:52:18','2021-09-05 12:12:10');
INSERT INTO settings VALUES('59','home_fixed_deposit_heading','Fixed Deposit Plans','2021-09-05 11:52:18','2021-09-05 12:19:41');
INSERT INTO settings VALUES('60','home_fixed_deposit_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 11:52:18','2021-09-05 12:19:41');
INSERT INTO settings VALUES('61','home_loan_heading','Loan Packages','2021-09-05 11:52:18','2021-09-05 12:19:41');
INSERT INTO settings VALUES('62','home_loan_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 11:52:18','2021-09-05 12:19:41');
INSERT INTO settings VALUES('63','home_testimonial_heading','We served over 500+ Customers','2021-09-05 11:52:18','2021-09-05 12:19:41');
INSERT INTO settings VALUES('64','home_testimonial_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 11:52:18','2021-09-05 12:19:41');
INSERT INTO settings VALUES('65','home_partner_heading','Partners who support us','2021-09-05 11:52:18','2021-09-05 12:19:41');
INSERT INTO settings VALUES('66','home_partner_content','Lets know moreel necessitatibus dolor asperiores illum possimus sint voluptates incidunt molestias nostrum laudantium. Maiores porro cumque quaerat.','2021-09-05 11:52:18','2021-09-05 12:19:41');
INSERT INTO settings VALUES('67','home_about_us_content','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','2021-09-05 11:54:15','2021-09-05 11:54:15');
INSERT INTO settings VALUES('68','home_service_heading','Our Services','2021-09-05 11:54:38','2021-09-05 12:12:10');
INSERT INTO settings VALUES('69','total_customer','500','2021-09-05 12:06:39','2021-09-05 12:08:10');
INSERT INTO settings VALUES('70','total_branch','5','2021-09-05 12:06:39','2021-09-05 12:11:53');
INSERT INTO settings VALUES('71','total_transactions','1','2021-09-05 12:06:39','2021-09-05 12:11:53');
INSERT INTO settings VALUES('72','total_countries','200','2021-09-05 12:06:39','2021-09-05 12:11:53');
INSERT INTO settings VALUES('73','about_page_title',' Who We Are','2021-09-05 16:07:18','2021-09-05 16:07:18');
INSERT INTO settings VALUES('74','our_team_title','Meet Our Team','2021-09-05 16:07:18','2021-09-05 16:07:18');
INSERT INTO settings VALUES('75','our_team_sub_title','Today’s users expect effortless experiences. Don’t let essential people and processes stay stuck in the past. Speed it up, skip the hassles','2021-09-05 16:07:18','2021-09-05 16:07:18');
INSERT INTO settings VALUES('76','about_us_content','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>','2021-09-05 16:08:15','2021-09-05 16:08:15');
INSERT INTO settings VALUES('77','address','Suite 16, 5th floor, Eleganza biro plaza, plot 634 Adeyemo Alakija Street Victoria Island, Lagos.','2021-10-24 13:20:34','2021-10-24 13:22:21');
INSERT INTO settings VALUES('78','logo','logo.png','2021-10-24 13:23:46','2021-10-24 13:23:46');
INSERT INTO settings VALUES('79','website_enable','yes','2021-10-24 13:24:14','2021-10-24 14:30:32');
INSERT INTO settings VALUES('80','currency_position','left','2021-10-24 13:24:14','2021-10-24 14:30:32');
INSERT INTO settings VALUES('81','date_format','Y-m-d','2021-10-24 13:24:14','2021-10-24 14:30:32');
INSERT INTO settings VALUES('82','time_format','12','2021-10-24 13:24:14','2021-10-24 14:30:32');
INSERT INTO settings VALUES('83','mobile_verification','disabled','2021-10-24 13:24:14','2021-10-24 14:30:32');
INSERT INTO settings VALUES('85','twitter_link','','2021-10-24 13:33:47','2021-10-24 13:33:47');
INSERT INTO settings VALUES('86','linkedin_link','','2021-10-24 13:33:47','2021-10-24 13:33:47');
INSERT INTO settings VALUES('87','from_email','tolu.adejimi@enkwave.com','2021-10-24 13:49:01','2021-10-24 13:49:04');
INSERT INTO settings VALUES('88','from_name','Admin','2021-10-24 13:49:01','2021-10-24 13:49:04');
INSERT INTO settings VALUES('89','smtp_host','mail.enkwave.com','2021-10-24 13:49:01','2021-10-24 13:49:04');
INSERT INTO settings VALUES('90','smtp_port','465','2021-10-24 13:49:01','2021-10-24 13:49:04');
INSERT INTO settings VALUES('91','smtp_username','tolu.adejimi@enkwave.com','2021-10-24 13:49:01','2021-10-24 13:49:04');
INSERT INTO settings VALUES('92','smtp_password','Tolulope2580@','2021-10-24 13:49:01','2021-10-24 13:49:04');
INSERT INTO settings VALUES('93','smtp_encryption','ssl','2021-10-24 13:49:01','2021-10-24 13:49:04');



DROP TABLE IF EXISTS support_ticket_messages;

CREATE TABLE `support_ticket_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `support_ticket_id` bigint(20) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO support_ticket_messages VALUES('1','1','hello','51','1638839106search.png','2021-12-07 02:05:06','2021-12-07 02:05:06');
INSERT INTO support_ticket_messages VALUES('2','1','test','1','1638839248search.png','2021-12-07 02:07:28','2021-12-07 02:07:28');
INSERT INTO support_ticket_messages VALUES('3','2','hello','58','','2021-12-07 01:55:11','2021-12-07 01:55:11');
INSERT INTO support_ticket_messages VALUES('4','3','hello','58','','2021-12-08 08:25:59','2021-12-08 08:25:59');
INSERT INTO support_ticket_messages VALUES('5','4','that the new update
tt','60','','2021-12-08 09:34:14','2021-12-08 09:34:14');
INSERT INTO support_ticket_messages VALUES('6','5','the amount is not completed for a perticuler user','60','','2021-12-08 09:36:36','2021-12-08 09:36:36');
INSERT INTO support_ticket_messages VALUES('7','6','tttttt','60','','2021-12-08 15:46:45','2021-12-08 15:46:45');
INSERT INTO support_ticket_messages VALUES('8','7','ndu fail to make payment for to days','77','','2021-12-15 23:09:53','2021-12-15 23:09:53');



DROP TABLE IF EXISTS support_tickets;

CREATE TABLE `support_tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `priority` tinyint(4) NOT NULL DEFAULT 0,
  `created_user_id` bigint(20) NOT NULL,
  `operator_id` bigint(20) DEFAULT NULL,
  `closed_user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO support_tickets VALUES('5','60','Amount not completed','2','0','53','','1','2021-12-08 09:36:36','2021-12-08 10:37:36');
INSERT INTO support_tickets VALUES('6','60','thtttt','1','0','53','','','2021-12-08 15:46:45','2021-12-08 15:46:45');
INSERT INTO support_tickets VALUES('7','77','Fail to make payment','1','0','75','','','2021-12-15 23:09:53','2021-12-15 23:09:53');



DROP TABLE IF EXISTS teams;

CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS testimonial_translations;

CREATE TABLE `testimonial_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `testimonial_id` bigint(20) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `testimonial_translations_testimonial_id_locale_unique` (`testimonial_id`,`locale`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS testimonials;

CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS transactions;

CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `currency_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `dr_cr` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_id` bigint(20) DEFAULT NULL,
  `ref_id` bigint(20) DEFAULT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `other_bank_id` bigint(20) DEFAULT NULL,
  `gateway_id` bigint(20) DEFAULT NULL,
  `created_user_id` bigint(20) DEFAULT NULL,
  `updated_user_id` bigint(20) DEFAULT NULL,
  `branch_id` bigint(20) DEFAULT NULL,
  `transaction_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO transactions VALUES('5','9','3','5000.00','0.00','cr','Deposit','GiftCard','2','Redeem Gift Card','','','','','','9','','','','2021-10-24 15:00:34','2021-10-24 15:00:34');
INSERT INTO transactions VALUES('2','6','3','2000.00','5.00','cr','Deposit','Flutterwave','2','Deposit Via Flutterwave','','','','','6','6','','','','2021-10-24 13:38:58','2021-10-24 13:39:55');
INSERT INTO transactions VALUES('3','6','3','1000.00','0.00','dr','Transfer','Online','2','','','','','','','6','','','','2021-10-24 13:42:15','2021-10-24 13:42:15');
INSERT INTO transactions VALUES('4','5','3','1000.00','0.00','cr','Transfer','Online','2','','','','3','','','6','','','','2021-10-24 13:42:15','2021-10-24 13:42:15');
INSERT INTO transactions VALUES('6','9','3','2000.00','5.00','cr','Deposit','Flutterwave','2','Deposit Via Flutterwave','','','','','6','9','','','','2021-10-24 15:08:03','2021-10-24 15:09:04');
INSERT INTO transactions VALUES('7','9','3','10000.00','0.00','cr','Deposit','GiftCard','2','Redeem Gift Card','','','','','','9','','','','2021-10-24 15:12:21','2021-10-24 15:12:21');
INSERT INTO transactions VALUES('8','9','3','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','1','','','','','1','','','','2021-10-24 15:16:18','2021-10-24 15:16:18');
INSERT INTO transactions VALUES('9','9','3','2187.50','0.00','dr','Loan_Repayment','Online','2','Loan Repayment','1','','','','','9','','','','2021-10-24 15:17:53','2021-10-24 15:17:53');
INSERT INTO transactions VALUES('10','9','3','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','4','','','','','1','','','','2021-11-18 16:00:59','2021-11-18 16:00:59');
INSERT INTO transactions VALUES('12','10','3','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','33','','','','','1','','','','2021-11-20 22:06:42','2021-11-20 22:06:42');
INSERT INTO transactions VALUES('13','10','3','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','31','','','','','1','','','','2021-11-20 22:56:51','2021-11-20 22:56:51');
INSERT INTO transactions VALUES('14','9','3','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','37','','','','','1','','','','2021-11-21 17:54:03','2021-11-21 17:54:03');
INSERT INTO transactions VALUES('15','11','3','6000.00','0.00','cr','Loan','Manual','2','Loan Approved','47','','','','','1','','','','2021-11-21 19:56:01','2021-11-21 19:56:01');
INSERT INTO transactions VALUES('16','13','3','10000.00','0.00','cr','Loan','Manual','2','Loan Approved','49','','','','','1','','','','2021-11-21 20:11:26','2021-11-21 20:11:26');
INSERT INTO transactions VALUES('17','9','3','10000.00','0.00','cr','Loan','Manual','2','Loan Approved','50','','','','','1','','','','2021-11-22 13:01:16','2021-11-22 13:01:16');
INSERT INTO transactions VALUES('18','9','1','1000.00','0.00','cr','Loan','Manual','2','Loan Approved','51','','','','','1','','','','2021-11-22 18:14:12','2021-11-22 18:14:12');
INSERT INTO transactions VALUES('19','11','1','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','53','','','','','1','','','','2021-11-22 19:05:00','2021-11-22 19:05:00');
INSERT INTO transactions VALUES('20','22','1','200000.00','0.00','cr','Loan','Manual','2','Loan Approved','54','','','','','1','','','','2021-11-22 19:10:00','2021-11-22 19:10:00');
INSERT INTO transactions VALUES('21','27','1','400000.00','0.00','cr','Loan','Manual','2','Loan Approved','55','','','','','1','','','','2021-11-22 19:16:53','2021-11-22 19:16:53');
INSERT INTO transactions VALUES('22','27','1','500000.00','0.00','cr','Loan','Manual','2','Loan Approved','56','','','','','1','','','','2021-11-22 19:18:53','2021-11-22 19:18:53');
INSERT INTO transactions VALUES('23','29','1','500000.00','0.00','cr','Loan','Manual','2','Loan Approved','57','','','','','1','','','','2021-11-22 19:42:48','2021-11-22 19:42:48');
INSERT INTO transactions VALUES('24','10','1','5000.00','0.00','cr','Loan','Manual','2','Loan Approved','52','','','','','1','','','','2021-11-22 20:30:17','2021-11-22 20:30:17');
INSERT INTO transactions VALUES('25','13','1','80000.00','0.00','cr','Loan','Manual','2','Loan Approved','58','','','','','1','','','','2021-11-22 22:09:49','2021-11-22 22:09:49');
INSERT INTO transactions VALUES('26','28','1','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','60','','','','','1','','','','2021-11-23 08:18:39','2021-11-23 08:18:39');
INSERT INTO transactions VALUES('27','35','1','10000.00','0.00','cr','Loan','Manual','2','Loan Approved','62','','','','','1','','','','2021-11-26 20:05:31','2021-11-26 20:05:31');
INSERT INTO transactions VALUES('28','10','1','10000.00','0.00','cr','Loan','Manual','2','Loan Approved','63','','','','','1','','','','2021-11-27 20:25:06','2021-11-27 20:25:06');
INSERT INTO transactions VALUES('29','1','3','100000.00','0.00','cr','Loan','Manual','2','Loan Approved','91','','','','','1','','','','2021-11-29 23:41:20','2021-11-29 23:41:20');
INSERT INTO transactions VALUES('30','1','1','100000.00','0.00','cr','Loan','Manual','2','Loan Approved','98','','','','','1','','','','2021-11-30 01:17:30','2021-11-30 01:17:30');
INSERT INTO transactions VALUES('31','40','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','105','','','','','1','','','','2021-11-30 09:38:00','2021-11-30 09:38:00');
INSERT INTO transactions VALUES('32','40','1','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','107','','','','','1','','','','2021-11-30 10:21:41','2021-11-30 10:21:41');
INSERT INTO transactions VALUES('33','40','1','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','108','','','','','1','','','','2021-11-30 10:27:41','2021-11-30 10:27:41');
INSERT INTO transactions VALUES('34','40','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','109','','','','','1','','','','2021-11-30 10:31:29','2021-11-30 10:31:29');
INSERT INTO transactions VALUES('35','41','1','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','110','','','','','1','','','','2021-12-01 11:52:44','2021-12-01 11:52:44');
INSERT INTO transactions VALUES('36','41','1','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','115','','','','','1','','','','2021-12-01 22:04:29','2021-12-01 22:04:29');
INSERT INTO transactions VALUES('37','40','1','50000.00','0.00','cr','Loan','Manual','2','Loan Approved','116','','','','','1','','','','2021-12-01 22:08:12','2021-12-01 22:08:12');
INSERT INTO transactions VALUES('38','41','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','117','','','','','1','','','','2021-12-01 22:13:57','2021-12-01 22:13:57');
INSERT INTO transactions VALUES('39','41','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','118','','','','','1','','','','2021-12-01 22:16:02','2021-12-01 22:16:02');
INSERT INTO transactions VALUES('40','42','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','119','','','','','1','','','','2021-12-01 22:18:42','2021-12-01 22:18:42');
INSERT INTO transactions VALUES('41','43','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','122','','','','','1','','','','2021-12-01 22:33:19','2021-12-01 22:33:19');
INSERT INTO transactions VALUES('42','43','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','123','','','','','1','','','','2021-12-01 22:37:13','2021-12-01 22:37:13');
INSERT INTO transactions VALUES('43','40','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','124','','','','','1','','','','2021-12-01 22:38:58','2021-12-01 22:38:58');
INSERT INTO transactions VALUES('44','43','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','125','','','','','1','','','','2021-12-01 22:40:26','2021-12-01 22:40:26');
INSERT INTO transactions VALUES('45','42','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','126','','','','','1','','','','2021-12-01 22:47:34','2021-12-01 22:47:34');
INSERT INTO transactions VALUES('51','40','1','10000.00','0.00','cr','Loan','Manual','2','Loan Approved','134','','','','','1','','','','2021-12-02 00:05:30','2021-12-02 00:05:30');
INSERT INTO transactions VALUES('50','43','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','133','','','','','1','','','','2021-12-01 23:33:22','2021-12-01 23:33:22');
INSERT INTO transactions VALUES('52','54','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','141','','','','','1','','','','2021-12-05 06:05:24','2021-12-05 06:05:24');
INSERT INTO transactions VALUES('53','51','1','10000.00','0.00','cr','Loan','Manual','2','Loan Approved','142','','','','','1','','','','2021-12-05 06:19:33','2021-12-05 06:19:33');
INSERT INTO transactions VALUES('54','51','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','143','','','','','1','','','','2021-12-05 06:48:45','2021-12-05 06:48:45');
INSERT INTO transactions VALUES('55','58','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','144','','','','','1','','','','2021-12-05 06:52:03','2021-12-05 06:52:03');
INSERT INTO transactions VALUES('56','56','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','151','','','','','1','','','','2021-12-05 07:41:09','2021-12-05 07:41:09');
INSERT INTO transactions VALUES('57','59','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','156','','','','','1','','','','2021-12-05 09:17:15','2021-12-05 09:17:15');
INSERT INTO transactions VALUES('58','56','1','100000.00','0.00','cr','Loan','Manual','2','Loan Approved','161','','','','','1','','','','2021-12-05 22:50:30','2021-12-05 22:50:30');
INSERT INTO transactions VALUES('60','60','1','100000.00','0.00','cr','Loan','Manual','2','Loan Approved','178','','','','','1','','','','2021-12-08 13:07:09','2021-12-08 13:07:09');
INSERT INTO transactions VALUES('61','60','1','100000.00','0.00','cr','Loan','Manual','2','Loan Approved','179','','','','','1','','','','2021-12-09 05:44:05','2021-12-09 05:44:05');
INSERT INTO transactions VALUES('68','74','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','187','','','','','1','','','','2021-12-13 13:01:08','2021-12-13 13:01:08');
INSERT INTO transactions VALUES('69','69','1','20000.00','0.00','cr','Loan','Manual','2','Loan Approved','188','','','','','1','','','','2021-12-13 13:21:04','2021-12-13 13:21:04');
INSERT INTO transactions VALUES('70','77','1','10000.00','0.00','cr','Loan','Manual','2','Loan Approved','189','','','','','1','','','','2021-12-15 22:38:42','2021-12-15 22:38:42');
INSERT INTO transactions VALUES('71','77','1','10000.00','0.00','cr','Loan','Manual','2','Loan Approved','190','','','','','1','','','','2021-12-15 23:05:07','2021-12-15 23:05:07');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bvn` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hbus_stop` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sbus_stop` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `branch_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `gname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gphone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gbus_stop` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gname2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gphone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaddress2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g2bus_stop` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gpicture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `sms_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_no` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `api_token` (`api_token`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES('1','admin','','','admin@admin.com','','','','','','','','0000-00-00','','admin','','1','1','','','','','','','','','default.png','','2021-10-24 12:17:04','','$2y$10$bA7Le1OoO5Kr4/mJtuvR9.RRSspMHe3O58tT/a8zx1B8gp4Uwbh2y','','','','','yuaAFDzdMxGH0ehw16HFxkwHUAPdWXm4R8jSEWUVrcX601sKu57AjqqWM1dQ','2021-10-24 12:17:04','2021-11-19 13:03:18','0');
INSERT INTO users VALUES('60','Martins','M','Micheal','martins@micheal.com','+2348023245812','123456789','123456789','4 igamu, Lagos','Igamu Bus stop','Shop 32 Oshodi Market','Oshodi Bus stop','2021-12-07','male','customer','','14','1','Jenifer Badmus','+2349056546163','Ikorodu, Lagos','Ikorodu Bus Stop.','Mariam Badmus','+2348033445035','Lekki, Ajah','Ajah Bus Stop','','','','','','','','','','','2021-12-07 07:23:35','2021-12-07 07:23:35','0');
INSERT INTO users VALUES('61','Adejimi','A','Tolulope','Adejimi+A+Tolulope@email.com','+2348105059613','12345678','','4, Akinola St, Ketu, Lagos','Toll gate','shop 12, oshodi','Oshodi Bus stop','0000-00-00','Male','customer','','Oshodi Market','1','Mr Okoko','+2348105059613','4 Okomiko street, lagos','Okoko bus stop','Mr Muda','+2348034285208','ketu','ikosi picture','b58d1353-18d9-46d1-bd26-7d3262952b247180497607972785655_out.jpg','','','','','','','','','','2021-12-07 08:27:39','2021-12-07 08:27:39','0');
INSERT INTO users VALUES('67','Tolu','A','Adejimi','agent1@gmail.com','08105059613','','','','','','','0000-00-00','','user','1','13,14,15,16','1','','','','','','','','','','','2021-12-12 08:28:09','','$2y$10$O.m/97qOrfzk6JeSWXiuOOZ0xZJJZkdJ7hXtROEFz.JFn/iCbY5.K','','','','','','2021-12-12 08:28:09','2021-12-12 08:28:09','0');
INSERT INTO users VALUES('68','thee','ee','eee','thee+ee+eee@email.com','+234555','','','eee','fff','eee','ggg','0000-00-00','Male','customer','','Oyingbo Market','1','thh','+2346666','rrg','6666','','','','','eb8668e2-6791-411f-8f33-130508d63ce67284198097409591134_out.jpg','','','','','','','','','','2021-12-12 07:33:08','2021-12-12 07:33:08','0');
INSERT INTO users VALUES('69','Kelvin','anta','williams','rr+rr+rr@email.com','+234444','rr','','rrr','rr','rr','rr','0000-00-00','Male','customer','','Oyingbo Market','1','55','+23455555','444','3333','','','','','26604d90-6f8f-4baf-92ec-470575fd9c643732388371417423479_out.jpg','0a4ae693-e73c-4e0f-abfa-0a378604090a171449558790642285_out.jpg','','','','','','','','','2021-12-12 07:53:33','2021-12-12 07:53:33','0');
INSERT INTO users VALUES('71','Nath','A','Nath','Nath+A+Nath@email.com','+2348105059613','','','shshsh','xnxndn','dnsjsj','sjsjsj','0000-00-00','Male','customer','','Oshodi Market','1','Dapo','+234810509613','dhdjdjej','ejsj','','','','','fe7c10cb-0c28-48b8-9208-4ec7d1b38dd23218377281871443974_out.jpg','92854a99-26dc-47f7-b298-30bf6137ba488271666665661999168_out.jpg','','','','','','','','','2021-12-13 08:30:16','2021-12-13 08:30:16','0');
INSERT INTO users VALUES('72','okeke','Miracle','555','okeke+Miracle+555@email.com','+234555','','','55','55','55','55','0000-00-00','Male','customer','','Oyingbo Market','1','555','+234555','555','555','','','','','bd6b92f0-3a7a-4c35-9130-7fecdf16806a4334981580507027778_out.jpg','0986ada7-99c5-4ebd-8443-04112d1d085f2117348494503407034_out.jpg','','','','','','','','','2021-12-13 08:55:01','2021-12-13 08:55:01','0');
INSERT INTO users VALUES('73','Yetunde','A','Olushola','ilogold5@gmail.com','09036727246','','','','','','','0000-00-00','','user','1','16','1','','','','','','','','','','','2021-12-13 13:10:00','','$2y$10$SSiIenJ8/HJEv.JJ2u4CRukWtZPwhNraEMI.TT3zv0dAuPM5hL166','','','','','','2021-12-13 13:10:00','2021-12-13 13:17:09','0');
INSERT INTO users VALUES('74','Michael','kalu','Ogba','Michael+kalu+Ogba@email.com','+2348023245812','22152455301','','block 1 flat 2 bar beach tower','bar beach','shop 1','police barracks bar beach','0000-00-00','Male','customer','','Tinubu','1','Sandra Ogba','+2348186542356','block 1 flat 2 bar beach towers','police barracks bar beach','','','','','a71895b9-3157-4c59-bda1-44f0477885022868114364691816588_out.jpg','cd357bc6-eaa7-4728-85d8-ba307ce3a6ed3993573709093123941_out.jpg','','','','','','','','','2021-12-13 12:43:52','2021-12-13 12:43:52','0');
INSERT INTO users VALUES('75','Agent2','Agent2','Agent2','agent2@mail.com','080012345678','','','','','','','0000-00-00','','user','1','13,16','1','','','','','','','','','1639606839bnb.png','','2021-12-15 23:20:39','','$2y$10$Ytq5yaIfmlk2zX8b/h8Rh.3RVfIb8dhK9/Bt8DUmzBIp9auTVTBGO','','','','','','2021-12-15 23:20:39','2021-12-15 23:20:39','0');
INSERT INTO users VALUES('77','ndu','john','keleb','ndu+john+keleb@email.com','+234455555555','','','u','u','u','u','0000-00-00','Female','customer','','16','1','yy','+234555','u','u','','','','','c1661dad-0f05-47d9-a5a3-5103dbbb9a571758199969810629181_out.jpg','d37886d1-ee2a-444d-a12d-fb088d6e6c578334322945793626798_out.jpg','','','','','','','','','2021-12-15 22:29:50','2021-12-15 22:29:50','0');



DROP TABLE IF EXISTS withdraw_methods;

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) NOT NULL,
  `minimum_amount` decimal(10,2) NOT NULL,
  `maximum_amount` decimal(10,2) NOT NULL,
  `fixed_charge` decimal(10,2) NOT NULL,
  `charge_in_percentage` decimal(10,2) NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS withdraw_requests;

CREATE TABLE `withdraw_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `method_id` bigint(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `transaction_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




