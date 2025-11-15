-- ************************************************************
-- Antares - SQL Client
-- Version 0.7.35
-- 
-- https://antares-sql.app/
-- https://github.com/antares-sql/antares
-- 
-- Host: 127.0.0.1 (PostgreSQL 16.10)
-- Database: public
-- Generation time: 2025-11-16T02:20:10+07:00
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

DROP TABLE IF EXISTS "public"."applied_jobs";

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




-- Dump of table job_categories
-- ------------------------------------------------------------

DROP TABLE IF EXISTS "public"."job_categories";

CREATE TABLE "public"."job_categories"(
   "id" character(36) NOT NULL,
   "name" character varying(255) NOT NULL,
   "slug" character varying(255) NOT NULL,
   "is_active" boolean DEFAULT true NOT NULL,
   "created_at" timestamp without time zone,
   "updated_at" timestamp without time zone,
   CONSTRAINT "job_categories_pkey" PRIMARY KEY ("id")
);





-- Dump of table job_listings
-- ------------------------------------------------------------

DROP TABLE IF EXISTS "public"."job_listings";

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




-- Dump of table job_listings_tag
-- ------------------------------------------------------------

DROP TABLE IF EXISTS "public"."job_listings_tag";

CREATE TABLE "public"."job_listings_tag"(
   "id" character(36) NOT NULL,
   "job_listing_id" character(36) NOT NULL,
   "name" character varying(255) NOT NULL,
   "sort" integer DEFAULT 1 NOT NULL,
   CONSTRAINT "job_listings_tag_pkey" PRIMARY KEY ("id")
);

CREATE INDEX "job_listings_tag_job_listing_id_index" ON "public"."job_listings_tag" ("job_listing_id");




-- Dump of table migrations
-- ------------------------------------------------------------

DROP TABLE IF EXISTS "public"."migrations";

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





-- Dump of table user_candidate
-- ------------------------------------------------------------

DROP TABLE IF EXISTS "public"."user_candidate";

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




-- Dump of table user_employer
-- ------------------------------------------------------------

DROP TABLE IF EXISTS "public"."user_employer";

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




-- Dump of table user_session
-- ------------------------------------------------------------

DROP TABLE IF EXISTS "public"."user_session";

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





-- Dump completed on 2025-11-16T02:20:10+07:00