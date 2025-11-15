-- ************************************************************
-- Antares - SQL Client
-- Version 0.7.35
-- 
-- https://antares-sql.app/
-- https://github.com/antares-sql/antares
-- 
-- Host: 127.0.0.1 (PostgreSQL 16.10)
-- Database: public
-- Generation time: 2025-11-16T02:31:53+07:00
-- ************************************************************


SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;





-- Dump of table applied_jobs
-- ------------------------------------------------------------

INSERT INTO "public"."applied_jobs" ("id", "user_candidate_id", "job_id", "status", "cover_letter", "resume", "created_at", "updated_at") VALUES ('019a838c-46ce-70ae-bf94-f6f7aa04017b', '019a82ce-4f24-72bf-8cb7-9db99ccb41f4', '019a8317-aadc-7012-9abb-cffd17dadf97', 'pending', 'eu2HnTOtc1SDbmYKi6csVxpxFM9oyvyI9ZXTMorJ.pdf', '1rWUev97FurYxzt7bUOTybCW4NJUrIddljoR8wr6.pdf', '2025-11-14 18:06:39', '2025-11-14 18:06:39');
INSERT INTO "public"."applied_jobs" ("id", "user_candidate_id", "job_id", "status", "cover_letter", "resume", "created_at", "updated_at") VALUES ('019a88ac-95d8-7156-80e2-46fb13133d30', '019a82ce-4f24-72bf-8cb7-9db99ccb41f4', '019a889a-c063-7279-96d0-143493e9a3b7', 'pending', 'Crdok2LlSmDz3rnI90oooBQ9lQ7UuGuSR1mIuEcY.pdf', 'N4u5KetAqwrFF7YblJbLPPMonxSijmcNh8zjNg6G.pdf', '2025-11-15 18:00:03', '2025-11-15 18:00:03');




-- Dump of table job_categories
-- ------------------------------------------------------------

INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('e951b264-b7b0-4880-8647-e72fc720c926', 'Teknologi Informasi dan Komunikasi', 'teknologi-informasi-dan-komunikasi', true, '2025-11-14 15:17:22', '2025-11-14 15:17:22');
INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('9f2892d4-f3d4-44b3-adc4-3f8b250b7a97', 'Pemasaran', 'pemasaran', true, '2025-11-14 15:17:22', '2025-11-14 15:17:22');
INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('a05c4830-880b-4332-83c3-0876fc4def08', 'Teknologi Informasi dan Komunikasi', 'teknologi-informasi-dan-komunikasi', true, '2025-11-15 04:48:05', '2025-11-15 04:48:05');
INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('a05c4830-8b3c-49f9-9135-4b0f27cbf9e8', 'Pemasaran', 'pemasaran', true, '2025-11-15 04:48:05', '2025-11-15 04:48:05');
INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('a05c4830-8b43-4991-b049-7390d8b3ea36', 'Akuntansi', 'akuntansi', true, '2025-11-15 04:48:05', '2025-11-15 04:48:05');




-- Dump of table job_listings
-- ------------------------------------------------------------

INSERT INTO "public"."job_listings" ("id", "title", "description", "qualifications", "location", "employment_type", "level_experience", "minimum_salary", "maximum_salary", "is_publish", "user_employer_id", "job_category_id", "created_at", "updated_at") VALUES ('019a833d-1dc3-7164-898f-1524997885c3', 'Frontend Developer', 'You are focus on build Mobile Apps and Website', 'Familiar with React.js, Vue.js, Flutter', 'Jakarta', 'Full Time', '1 - 2 years', 8500000, 10000000, true, '019a82d1-a17b-72e1-946d-c329faaf15f0', 'e951b264-b7b0-4880-8647-e72fc720c926', '2025-11-14 16:40:11', '2025-11-14 16:40:11');
INSERT INTO "public"."job_listings" ("id", "title", "description", "qualifications", "location", "employment_type", "level_experience", "minimum_salary", "maximum_salary", "is_publish", "user_employer_id", "job_category_id", "created_at", "updated_at") VALUES ('019a889a-c063-7279-96d0-143493e9a3b7', 'Fullstack Developer', 'You are focus on build Mobile Apps and Backend Development', 'Familiar with React.js, Vue.js, Flutter', 'Jakarta', 'Full Time', '1 - 4 years', 10000000, 15000000, true, '019a82d1-a17b-72e1-946d-c329faaf15f0', 'e951b264-b7b0-4880-8647-e72fc720c926', '2025-11-15 17:40:34', '2025-11-15 17:40:34');
INSERT INTO "public"."job_listings" ("id", "title", "description", "qualifications", "location", "employment_type", "level_experience", "minimum_salary", "maximum_salary", "is_publish", "user_employer_id", "job_category_id", "created_at", "updated_at") VALUES ('019a8317-aadc-7012-9abb-cffd17dadf97', 'Fullstack Developer', 'You are focus on build Mobile Apps and Backend Development', 'Familiar with React.js, Vue.js, Flutter', 'Jakarta', 'Full Time', '1 - 4 years', 10000000, 12000000, false, '019a82d1-a17b-72e1-946d-c329faaf15f0', 'e951b264-b7b0-4880-8647-e72fc720c926', '2025-11-14 15:59:17', '2025-11-15 19:00:01');




-- Dump of table job_listings_tag
-- ------------------------------------------------------------

INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-a9de-421f-abff-5800745146b1', '019a833d-1dc3-7164-898f-1524997885c3', 'node.js', 1);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae65-4455-953e-848669d40b7d', '019a833d-1dc3-7164-898f-1524997885c3', 'reactjs', 2);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae6e-44de-8601-4e664f3ecc99', '019a833d-1dc3-7164-898f-1524997885c3', 'vuejs', 3);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae74-437b-81ff-b8d58ea779b9', '019a833d-1dc3-7164-898f-1524997885c3', 'javascript', 4);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae79-4a0e-988c-db150d3ac87d', '019a833d-1dc3-7164-898f-1524997885c3', 'html', 5);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae7e-4287-a255-e5be21727673', '019a833d-1dc3-7164-898f-1524997885c3', 'css', 6);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae83-464f-bba4-950e8492efee', '019a833d-1dc3-7164-898f-1524997885c3', 'sass', 7);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae88-4af6-8e24-80f7e3ab32b9', '019a833d-1dc3-7164-898f-1524997885c3', 'mobile apps', 8);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae8d-4626-b063-b332e90db2c5', '019a833d-1dc3-7164-898f-1524997885c3', 'uiux', 9);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-4819-4ae2-ac00-a6be9587eb16', '019a889a-c063-7279-96d0-143493e9a3b7', 'node.js', 1);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-ec48-4d6a-a5b0-388f7e43d46f', '019a889a-c063-7279-96d0-143493e9a3b7', 'reactjs', 2);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-ec4f-4df8-a190-f86ebd6632bd', '019a889a-c063-7279-96d0-143493e9a3b7', 'vuejs', 3);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-ec53-47f9-999c-a8ebcd9ec6ef', '019a889a-c063-7279-96d0-143493e9a3b7', 'javascript', 4);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-ec58-46eb-894a-e3cfd6530e55', '019a889a-c063-7279-96d0-143493e9a3b7', 'html', 5);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-ec5d-44ea-95fb-e0c7ecf158a8', '019a889a-c063-7279-96d0-143493e9a3b7', 'css', 6);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-ec62-4d7a-99e2-7cbd3c047b65', '019a889a-c063-7279-96d0-143493e9a3b7', 'sass', 7);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-ec65-4060-ae9d-4d129fb46424', '019a889a-c063-7279-96d0-143493e9a3b7', 'mobile apps', 8);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d5c73-ec69-40c7-841d-b293c12ef082', '019a889a-c063-7279-96d0-143493e9a3b7', 'dbms', 9);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-bd8b-48b6-bd3c-8032cff5e30a', '019a8317-aadc-7012-9abb-cffd17dadf97', 'node.js', 1);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-befd-4bd3-ba37-b30eac734889', '019a8317-aadc-7012-9abb-cffd17dadf97', 'reactjs', 2);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-bf04-4a7b-aeb7-ffbcbe46846f', '019a8317-aadc-7012-9abb-cffd17dadf97', 'vuejs', 3);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-bf08-4198-bfe5-9018fca0ea47', '019a8317-aadc-7012-9abb-cffd17dadf97', 'javascript', 4);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-bf0b-4bf3-80b1-c96ffe9fbb51', '019a8317-aadc-7012-9abb-cffd17dadf97', 'html', 5);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-bf0f-4c67-b471-61cf6868bdf0', '019a8317-aadc-7012-9abb-cffd17dadf97', 'css', 6);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-bf13-49b0-b7b5-8b464c73a295', '019a8317-aadc-7012-9abb-cffd17dadf97', 'sass', 7);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-bf16-430a-9281-e9143b9656a6', '019a8317-aadc-7012-9abb-cffd17dadf97', 'mobile apps', 8);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05d78dc-bf19-4d37-8deb-34b9599eef97', '019a8317-aadc-7012-9abb-cffd17dadf97', 'dbms', 9);




-- Dump of table migrations
-- ------------------------------------------------------------

INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (18, '2025_11_14_085444_create_users_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (19, '2025_11_14_091110_create_job_categories_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (20, '2025_11_14_091136_create_job_listings_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (21, '2025_11_14_093723_create_job_listings_tag_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (22, '2025_11_14_100725_create_applied_jobs_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (23, '2025_11_14_105039_create_user_sessions_table', 1);




-- Dump of table user_candidate
-- ------------------------------------------------------------

INSERT INTO "public"."user_candidate" ("id", "name", "email", "password", "phone", "address", "description", "is_active", "created_at", "updated_at") VALUES ('019a85d7-87dc-72ba-8686-ef06949bc905', 'John Doe', 'john.doe@example.com', '$2y$12$MqLtDDcMDUJtyrM96MB4Y.2rbYFVZKdLYRii1POjcYG//D3jpJdvO', '085981733', 'Korea Selatan', 'Software Engineer', true, '2025-11-15 04:48:06', '2025-11-15 04:48:06');
INSERT INTO "public"."user_candidate" ("id", "name", "email", "password", "phone", "address", "description", "is_active", "created_at", "updated_at") VALUES ('019a82ce-4f24-72bf-8cb7-9db99ccb41f4', 'Nam Do San - EDITED', 'nam.dosan@example.com', '$2y$12$1SL5aTH9khFgZH6425I/SuIq5./g0JGZmU9GP5m9s83hK0A4qrl06', '085981733', 'Korea Selatan', 'Software Engineer', true, '2025-11-14 14:39:10', '2025-11-15 17:38:15');
INSERT INTO "public"."user_candidate" ("id", "name", "email", "password", "phone", "address", "description", "is_active", "created_at", "updated_at") VALUES ('019a88a3-b758-7245-a182-13f616120b94', 'Jane Doe', 'jane.doe@example.com', '$2y$12$CEjlpGv4wd25wr9zRFsPRO59FI3.s/rhLCy5SqXuPv05r/XtUw8k2', NULL, NULL, NULL, true, '2025-11-15 17:50:22', '2025-11-15 17:50:22');




-- Dump of table user_employer
-- ------------------------------------------------------------

INSERT INTO "public"."user_employer" ("id", "name", "email", "password", "address", "description", "industry", "company_size", "website", "specialization", "is_active", "created_at", "updated_at") VALUES ('019a83e3-83b2-73c7-be2d-621261ac46f2', 'Samsan Tech', 'samsan.tech@example.com', '$2y$12$bn4DV2yQTD1OFvxZtVa5WuZWpoNHxACsJSn7RPrbKTLvrjzD0tvI6', 'Korea Selatan', 'Perusahaan Artificial Intelligence di Korea', NULL, '< 10', 'https://www.example.com', 'Software Development, Artificial Intelligence, Image Recognition', true, '2025-11-14 19:41:57', '2025-11-14 19:41:57');
INSERT INTO "public"."user_employer" ("id", "name", "email", "password", "address", "description", "industry", "company_size", "website", "specialization", "is_active", "created_at", "updated_at") VALUES ('019a85d7-88ad-7080-86c6-7b143ae70d01', 'XYZ Company', 'xyz.company@example.com', '$2y$12$vz2lri/ANCsz2TYvTqJCpO1.7n.n4LJZcf0x39Kn7y56M.ZhMc6Qy', 'Korea Selatan', 'Perusahaan Artificial Intelligence di Korea', NULL, '< 10', 'https://www.example.com', 'Software Development, Artificial Intelligence, Image Recognition', true, '2025-11-15 04:48:06', '2025-11-15 04:48:06');
INSERT INTO "public"."user_employer" ("id", "name", "email", "password", "address", "description", "industry", "company_size", "website", "specialization", "is_active", "created_at", "updated_at") VALUES ('019a82d1-a17b-72e1-946d-c329faaf15f0', 'Injae Company', 'injae.company@example.com', '$2y$12$3BYGOdv1zF3iYUuK4xaNJubUvYSTgTYYgB83hCOg2.MfLg8qM3/cy', 'Korea Selatan', 'Perusahaan Artificial Intelligence di Korea', NULL, '< 10', 'https://www.example.com', 'Software Development, Artificial Intelligence, Image Recognition', true, '2025-11-14 14:42:47', '2025-11-15 17:49:11');
INSERT INTO "public"."user_employer" ("id", "name", "email", "password", "address", "description", "industry", "company_size", "website", "specialization", "is_active", "created_at", "updated_at") VALUES ('019a88a8-f19d-7034-a5b5-950b9e2bf4ba', 'Kino Indonesia', 'kino.indonesia@example.com', '$2y$12$uuaL39eExDEq5nJl2GBbR.JbgiwZyR2AS7SDKykrQgjJPIu42Zso6', 'Indonesia', 'Perusahaan bidang Food Manufacture Commercial Goods', NULL, '> 1000', 'https://www.example.com', 'Makanan, Minuman, Sabun dan lain lain.', true, '2025-11-15 17:56:04', '2025-11-15 17:56:04');




-- Dump of table user_session
-- ------------------------------------------------------------





-- Dump completed on 2025-11-16T02:31:54+07:00