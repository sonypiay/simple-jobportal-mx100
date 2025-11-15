-- ************************************************************
-- Antares - SQL Client
-- Version 0.7.35
-- 
-- https://antares-sql.app/
-- https://github.com/antares-sql/antares
-- 
-- Host: 127.0.0.1 (PostgreSQL 16.10)
-- Database: public
-- Generation time: 2025-11-15T11:49:47+07:00
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

CREATE TABLE "public"."applied_jobs"(
   "id" character(36) NOT NULL,
   "user_candidate_id" character(36),
   "job_id" character(36) NOT NULL,
   "status" character varying(20) NOT NULL,
   "cover_letter" character varying(255),
   "resume" character varying(255),
   "created_at" timestamp without time zone,
   "updated_at" timestamp without time zone,
   CONSTRAINT "applied_jobs_pkey" PRIMARY KEY ("id")
);

CREATE INDEX "applied_jobs_user_candidate_id_index" ON "public"."applied_jobs" ("user_candidate_id");
CREATE INDEX "applied_jobs_job_id_index" ON "public"."applied_jobs" ("job_id");


INSERT INTO "public"."applied_jobs" ("id", "user_candidate_id", "job_id", "status", "cover_letter", "resume", "created_at", "updated_at") VALUES ('019a838c-46ce-70ae-bf94-f6f7aa04017b', '019a82ce-4f24-72bf-8cb7-9db99ccb41f4', '019a8317-aadc-7012-9abb-cffd17dadf97', 'pending', 'eu2HnTOtc1SDbmYKi6csVxpxFM9oyvyI9ZXTMorJ.pdf', '1rWUev97FurYxzt7bUOTybCW4NJUrIddljoR8wr6.pdf', '2025-11-14 18:06:39', '2025-11-14 18:06:39');




-- Dump of table job_categories
-- ------------------------------------------------------------

CREATE TABLE "public"."job_categories"(
   "id" character(36) NOT NULL,
   "name" character varying(255) NOT NULL,
   "slug" character varying(255) NOT NULL,
   "is_active" boolean DEFAULT true NOT NULL,
   "created_at" timestamp without time zone,
   "updated_at" timestamp without time zone,
   CONSTRAINT "job_categories_pkey" PRIMARY KEY ("id")
);



INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('e951b264-b7b0-4880-8647-e72fc720c926', 'Teknologi Informasi dan Komunikasi', 'teknologi-informasi-dan-komunikasi', true, '2025-11-14 15:17:22', '2025-11-14 15:17:22');
INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('9f2892d4-f3d4-44b3-adc4-3f8b250b7a97', 'Pemasaran', 'pemasaran', true, '2025-11-14 15:17:22', '2025-11-14 15:17:22');
INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('a05c4830-880b-4332-83c3-0876fc4def08', 'Teknologi Informasi dan Komunikasi', 'teknologi-informasi-dan-komunikasi', true, '2025-11-15 04:48:05', '2025-11-15 04:48:05');
INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('a05c4830-8b3c-49f9-9135-4b0f27cbf9e8', 'Pemasaran', 'pemasaran', true, '2025-11-15 04:48:05', '2025-11-15 04:48:05');
INSERT INTO "public"."job_categories" ("id", "name", "slug", "is_active", "created_at", "updated_at") VALUES ('a05c4830-8b43-4991-b049-7390d8b3ea36', 'Akuntansi', 'akuntansi', true, '2025-11-15 04:48:05', '2025-11-15 04:48:05');




-- Dump of table job_listings
-- ------------------------------------------------------------

CREATE TABLE "public"."job_listings"(
   "id" character(36) NOT NULL,
   "title" character varying(255) NOT NULL,
   "description" text NOT NULL,
   "qualifications" text NOT NULL,
   "location" character varying(255) NOT NULL,
   "employment_type" character varying(30) NOT NULL,
   "level_experience" character varying(255) NOT NULL,
   "minimum_salary" bigint,
   "maximum_salary" bigint,
   "is_publish" boolean DEFAULT true NOT NULL,
   "user_employer_id" character(36),
   "job_category_id" character(36),
   "created_at" timestamp without time zone,
   "updated_at" timestamp without time zone,
   CONSTRAINT "job_listings_pkey" PRIMARY KEY ("id")
);

CREATE INDEX "job_listings_user_employer_id_index" ON "public"."job_listings" ("user_employer_id");
CREATE INDEX "job_listings_job_category_id_index" ON "public"."job_listings" ("job_category_id");


INSERT INTO "public"."job_listings" ("id", "title", "description", "qualifications", "location", "employment_type", "level_experience", "minimum_salary", "maximum_salary", "is_publish", "user_employer_id", "job_category_id", "created_at", "updated_at") VALUES ('019a8317-aadc-7012-9abb-cffd17dadf97', 'Backend Developer', 'You are focus on build REST API for backend systems', 'Familiar with PHP, Node.js or Golang', 'Jakarta', 'Full Time', '1 - 3 years', 7000000, 10000000, true, '019a82d1-a17b-72e1-946d-c329faaf15f0', 'e951b264-b7b0-4880-8647-e72fc720c926', '2025-11-14 15:59:17', '2025-11-14 15:59:17');
INSERT INTO "public"."job_listings" ("id", "title", "description", "qualifications", "location", "employment_type", "level_experience", "minimum_salary", "maximum_salary", "is_publish", "user_employer_id", "job_category_id", "created_at", "updated_at") VALUES ('019a833d-1dc3-7164-898f-1524997885c3', 'Frontend Developer', 'You are focus on build Mobile Apps and Website', 'Familiar with React.js, Vue.js, Flutter', 'Jakarta', 'Full Time', '1 - 2 years', 8500000, 10000000, true, '019a82d1-a17b-72e1-946d-c329faaf15f0', 'e951b264-b7b0-4880-8647-e72fc720c926', '2025-11-14 16:40:11', '2025-11-14 16:40:11');




-- Dump of table job_listings_tag
-- ------------------------------------------------------------

CREATE TABLE "public"."job_listings_tag"(
   "id" character(36) NOT NULL,
   "job_listing_id" character(36) NOT NULL,
   "name" character varying(255) NOT NULL,
   "sort" integer DEFAULT 1 NOT NULL,
   CONSTRAINT "job_listings_tag_pkey" PRIMARY KEY ("id")
);

CREATE INDEX "job_listings_tag_job_listing_id_index" ON "public"."job_listings_tag" ("job_listing_id");


INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b353e-c65d-4013-bc08-01a4d054f6be', '019a8317-aadc-7012-9abb-cffd17dadf97', 'php', 1);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b353e-cb6e-4115-a96a-63dee5019833', '019a8317-aadc-7012-9abb-cffd17dadf97', 'javascript', 2);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b353e-cb84-4b00-a17b-2ab6edf92b75', '019a8317-aadc-7012-9abb-cffd17dadf97', 'golang', 3);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b353e-cb90-4195-a924-06068e72ab6c', '019a8317-aadc-7012-9abb-cffd17dadf97', 'backend development', 4);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b353e-cb98-435a-b9ee-77942e9f0847', '019a8317-aadc-7012-9abb-cffd17dadf97', 'api', 5);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-a9de-421f-abff-5800745146b1', '019a833d-1dc3-7164-898f-1524997885c3', 'node.js', 1);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae65-4455-953e-848669d40b7d', '019a833d-1dc3-7164-898f-1524997885c3', 'reactjs', 2);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae6e-44de-8601-4e664f3ecc99', '019a833d-1dc3-7164-898f-1524997885c3', 'vuejs', 3);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae74-437b-81ff-b8d58ea779b9', '019a833d-1dc3-7164-898f-1524997885c3', 'javascript', 4);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae79-4a0e-988c-db150d3ac87d', '019a833d-1dc3-7164-898f-1524997885c3', 'html', 5);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae7e-4287-a255-e5be21727673', '019a833d-1dc3-7164-898f-1524997885c3', 'css', 6);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae83-464f-bba4-950e8492efee', '019a833d-1dc3-7164-898f-1524997885c3', 'sass', 7);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae88-4af6-8e24-80f7e3ab32b9', '019a833d-1dc3-7164-898f-1524997885c3', 'mobile apps', 8);
INSERT INTO "public"."job_listings_tag" ("id", "job_listing_id", "name", "sort") VALUES ('a05b43df-ae8d-4626-b063-b332e90db2c5', '019a833d-1dc3-7164-898f-1524997885c3', 'uiux', 9);




-- Dump of table migrations
-- ------------------------------------------------------------

CREATE SEQUENCE "public"."migrations_id_seq"
   START WITH 1
   INCREMENT BY 1
   MINVALUE 1
   MAXVALUE 2147483647
   CACHE 1;

CREATE TABLE "public"."migrations"(
   "id" integer DEFAULT nextval('public.migrations_id_seq'::regclass) NOT NULL,
   "migration" character varying(255) NOT NULL,
   "batch" integer NOT NULL,
   CONSTRAINT "migrations_pkey" PRIMARY KEY ("id")
);



INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (18, '2025_11_14_085444_create_users_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (19, '2025_11_14_091110_create_job_categories_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (20, '2025_11_14_091136_create_job_listings_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (21, '2025_11_14_093723_create_job_listings_tag_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (22, '2025_11_14_100725_create_applied_jobs_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES (23, '2025_11_14_105039_create_user_sessions_table', 1);




-- Dump of table user_candidate
-- ------------------------------------------------------------

CREATE TABLE "public"."user_candidate"(
   "id" character(36) NOT NULL,
   "name" character varying(255) NOT NULL,
   "email" character varying(255) NOT NULL,
   "password" character varying(255) NOT NULL,
   "phone" character varying(255),
   "address" character varying(255),
   "description" text,
   "is_active" boolean DEFAULT true NOT NULL,
   "created_at" timestamp without time zone,
   "updated_at" timestamp without time zone,
   CONSTRAINT "user_candidate_pkey" PRIMARY KEY ("id")
);

CREATE UNIQUE INDEX "user_candidate_email_unique" ON "public"."user_candidate" ("email");


INSERT INTO "public"."user_candidate" ("id", "name", "email", "password", "phone", "address", "description", "is_active", "created_at", "updated_at") VALUES ('019a82ce-4f24-72bf-8cb7-9db99ccb41f4', 'Nam Do San', 'nam.dosan@example.com', '$2y$12$631.6sXoAi7Xqlvqq62qCu2CccgxbH4xD1PLXcLMyxtBWMwYgnfeq', '085981733', 'Korea Selatan', 'Software Engineer', true, '2025-11-14 14:39:10', '2025-11-14 20:26:02');
INSERT INTO "public"."user_candidate" ("id", "name", "email", "password", "phone", "address", "description", "is_active", "created_at", "updated_at") VALUES ('019a85d7-87dc-72ba-8686-ef06949bc905', 'John Doe', 'john.doe@example.com', '$2y$12$MqLtDDcMDUJtyrM96MB4Y.2rbYFVZKdLYRii1POjcYG//D3jpJdvO', '085981733', 'Korea Selatan', 'Software Engineer', true, '2025-11-15 04:48:06', '2025-11-15 04:48:06');




-- Dump of table user_employer
-- ------------------------------------------------------------

CREATE TABLE "public"."user_employer"(
   "id" character(36) NOT NULL,
   "name" character varying(255) NOT NULL,
   "email" character varying(255) NOT NULL,
   "password" character varying(255) NOT NULL,
   "address" character varying(255) NOT NULL,
   "description" text NOT NULL,
   "industry" character varying(255),
   "company_size" character varying(255),
   "website" character varying(255),
   "specialization" character varying(255),
   "is_active" boolean DEFAULT true NOT NULL,
   "created_at" timestamp without time zone,
   "updated_at" timestamp without time zone,
   CONSTRAINT "user_employer_pkey" PRIMARY KEY ("id")
);

CREATE UNIQUE INDEX "user_employer_email_unique" ON "public"."user_employer" ("email");


INSERT INTO "public"."user_employer" ("id", "name", "email", "password", "address", "description", "industry", "company_size", "website", "specialization", "is_active", "created_at", "updated_at") VALUES ('019a83e3-83b2-73c7-be2d-621261ac46f2', 'Samsan Tech', 'samsan.tech@example.com', '$2y$12$bn4DV2yQTD1OFvxZtVa5WuZWpoNHxACsJSn7RPrbKTLvrjzD0tvI6', 'Korea Selatan', 'Perusahaan Artificial Intelligence di Korea', NULL, '< 10', 'https://www.example.com', 'Software Development, Artificial Intelligence, Image Recognition', true, '2025-11-14 19:41:57', '2025-11-14 19:41:57');
INSERT INTO "public"."user_employer" ("id", "name", "email", "password", "address", "description", "industry", "company_size", "website", "specialization", "is_active", "created_at", "updated_at") VALUES ('019a82d1-a17b-72e1-946d-c329faaf15f0', 'Injae Company', 'injae.company@example.com', '$2y$12$Y0ND2bqmgObBK9veWgie6.dG5Eo8GUHR0rP0JOnaKHNkeKwYc8dny', 'Korea Selatan', 'Perusahaan Artificial Intelligence di Korea', NULL, '< 10', 'https://www.example.com', 'Software Development, Artificial Intelligence, Image Recognition', true, '2025-11-14 14:42:47', '2025-11-14 20:14:02');
INSERT INTO "public"."user_employer" ("id", "name", "email", "password", "address", "description", "industry", "company_size", "website", "specialization", "is_active", "created_at", "updated_at") VALUES ('019a85d7-88ad-7080-86c6-7b143ae70d01', 'XYZ Company', 'xyz.company@example.com', '$2y$12$vz2lri/ANCsz2TYvTqJCpO1.7n.n4LJZcf0x39Kn7y56M.ZhMc6Qy', 'Korea Selatan', 'Perusahaan Artificial Intelligence di Korea', NULL, '< 10', 'https://www.example.com', 'Software Development, Artificial Intelligence, Image Recognition', true, '2025-11-15 04:48:06', '2025-11-15 04:48:06');




-- Dump of table user_session
-- ------------------------------------------------------------

CREATE TABLE "public"."user_session"(
   "session_id" character(36) NOT NULL,
   "api_token" character varying(128) NOT NULL,
   "user_id" character(36) NOT NULL,
   "user_type" character varying(20) NOT NULL,
   "created_at" timestamp without time zone,
   "updated_at" timestamp without time zone,
   CONSTRAINT "user_session_pkey" PRIMARY KEY ("session_id")
);

CREATE INDEX "user_session_user_id_index" ON "public"."user_session" ("user_id");


INSERT INTO "public"."user_session" ("session_id", "api_token", "user_id", "user_type", "created_at", "updated_at") VALUES ('019a840f-912b-7311-8c29-0b18b222575f', 'X7PEyA3NqwhLfspM7UhIjTY4h5AUzBqGMwo5wiXVoq7pYblH7vYNCCAHdkzYqkc9Rqz5qiCwTmM2vi8sgDYO1GrC9T2mY2FcItYi3wiURibkON1wYKtQ0rtmaUoGZk4s', '019a82ce-4f24-72bf-8cb7-9db99ccb41f4', 'candidate', '2025-11-14 20:30:04', '2025-11-14 20:30:04');
INSERT INTO "public"."user_session" ("session_id", "api_token", "user_id", "user_type", "created_at", "updated_at") VALUES ('019a8410-d308-7131-b9ad-a1a6710848bd', 'PpNCHDNPl3Bc3lu4Ci6dFUT2Y4Jp8Nq2JxEtfzXagmjSjeHGpGFiQP3NaTavVFr7DdpT3hC6ShQ9K8hYiLAPsXCW8U7bH59JUc2x0AhandHjEayAe0WEYWDDZ09hLIuu', '019a82d1-a17b-72e1-946d-c329faaf15f0', 'employer', '2025-11-14 20:31:26', '2025-11-14 20:31:26');





ALTER TABLE ONLY "public"."applied_jobs"
   ADD CONSTRAINT "applied_jobs_user_candidate_id_foreign" FOREIGN KEY ("user_candidate_id") REFERENCES "public"."user_candidate" ("id") ON UPDATE NO ACTION ON DELETE SET NULL;

ALTER TABLE ONLY "public"."applied_jobs"
   ADD CONSTRAINT "applied_jobs_job_id_foreign" FOREIGN KEY ("job_id") REFERENCES "public"."job_listings" ("id") ON UPDATE NO ACTION ON DELETE CASCADE;

ALTER TABLE ONLY "public"."job_listings"
   ADD CONSTRAINT "job_listings_user_employer_id_foreign" FOREIGN KEY ("user_employer_id") REFERENCES "public"."user_employer" ("id") ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE ONLY "public"."job_listings"
   ADD CONSTRAINT "job_listings_job_category_id_foreign" FOREIGN KEY ("job_category_id") REFERENCES "public"."job_categories" ("id") ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE ONLY "public"."job_listings_tag"
   ADD CONSTRAINT "job_listings_tag_job_listing_id_foreign" FOREIGN KEY ("job_listing_id") REFERENCES "public"."job_listings" ("id") ON UPDATE NO ACTION ON DELETE CASCADE;


-- Dump of functions
-- ------------------------------------------------------------


CREATE OR REPLACE FUNCTION public.uuid_generate_v1()
 RETURNS uuid
 LANGUAGE c
 PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_generate_v1$function$
;

CREATE OR REPLACE FUNCTION public.uuid_generate_v1mc()
 RETURNS uuid
 LANGUAGE c
 PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_generate_v1mc$function$
;

CREATE OR REPLACE FUNCTION public.uuid_generate_v3(namespace uuid, name text)
 RETURNS uuid
 LANGUAGE c
 IMMUTABLE PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_generate_v3$function$
;

CREATE OR REPLACE FUNCTION public.uuid_generate_v4()
 RETURNS uuid
 LANGUAGE c
 PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_generate_v4$function$
;

CREATE OR REPLACE FUNCTION public.uuid_generate_v5(namespace uuid, name text)
 RETURNS uuid
 LANGUAGE c
 IMMUTABLE PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_generate_v5$function$
;

CREATE OR REPLACE FUNCTION public.uuid_nil()
 RETURNS uuid
 LANGUAGE c
 IMMUTABLE PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_nil$function$
;

CREATE OR REPLACE FUNCTION public.uuid_ns_dns()
 RETURNS uuid
 LANGUAGE c
 IMMUTABLE PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_ns_dns$function$
;

CREATE OR REPLACE FUNCTION public.uuid_ns_oid()
 RETURNS uuid
 LANGUAGE c
 IMMUTABLE PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_ns_oid$function$
;

CREATE OR REPLACE FUNCTION public.uuid_ns_url()
 RETURNS uuid
 LANGUAGE c
 IMMUTABLE PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_ns_url$function$
;

CREATE OR REPLACE FUNCTION public.uuid_ns_x500()
 RETURNS uuid
 LANGUAGE c
 IMMUTABLE PARALLEL SAFE STRICT
AS '$libdir/uuid-ossp', $function$uuid_ns_x500$function$
;





-- Dump completed on 2025-11-15T11:49:48+07:00