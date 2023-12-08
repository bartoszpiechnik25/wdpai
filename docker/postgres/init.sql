CREATE SEQUENCE diettype_diet_type_id_seq;
CREATE SEQUENCE foodcategory_food_category_id_seq;
CREATE SEQUENCE images_image_id_seq;
CREATE SEQUENCE likedrecipes_liked_recipe_id_seq;
CREATE SEQUENCE recipe_recipe_id_seq;
CREATE SEQUENCE roles_role_id_seq;
CREATE SEQUENCE userprofile_user_profile_id_seq;
CREATE SEQUENCE users_user_id_seq;

CREATE TABLE "diettype" (
  "diet_type_id" int4 NOT NULL DEFAULT nextval('diettype_diet_type_id_seq'::regclass),
  "diet_type" varchar(60) COLLATE "pg_catalog"."default",
  CONSTRAINT "diettype_pkey" PRIMARY KEY ("diet_type_id"),
  CONSTRAINT "diettype_diet_type_key" UNIQUE ("diet_type")
);
ALTER TABLE "diettype" OWNER TO "postgres";

CREATE TABLE "foodcategory" (
  "food_category_id" int4 NOT NULL DEFAULT nextval('foodcategory_food_category_id_seq'::regclass),
  "category" varchar COLLATE "pg_catalog"."default",
  CONSTRAINT "foodcategory_pkey" PRIMARY KEY ("food_category_id"),
  CONSTRAINT "foodcategory_category_key" UNIQUE ("category")
);
ALTER TABLE "foodcategory" OWNER TO "postgres";

CREATE TABLE "images" (
  "image_id" int4 NOT NULL DEFAULT nextval('images_image_id_seq'::regclass),
  "bucket_url" varchar(100) COLLATE "pg_catalog"."default",
  "recipe_id" int4,
  CONSTRAINT "images_pkey" PRIMARY KEY ("image_id")
);
ALTER TABLE "images" OWNER TO "postgres";

CREATE TABLE "likedrecipes" (
  "liked_recipe_id" int4 NOT NULL DEFAULT nextval('likedrecipes_liked_recipe_id_seq'::regclass),
  "user_id" int4,
  "recipe_id" int4,
  CONSTRAINT "likedrecipes_pkey" PRIMARY KEY ("liked_recipe_id")
);
ALTER TABLE "likedrecipes" OWNER TO "postgres";

CREATE TABLE "recipe" (
  "recipe_id" int4 NOT NULL DEFAULT nextval('recipe_recipe_id_seq'::regclass),
  "name" varchar(255) COLLATE "pg_catalog"."default",
  "description" text COLLATE "pg_catalog"."default",
  "method" text COLLATE "pg_catalog"."default",
  "author_id" int4 NOT NULL,
  "food_category_id" int4 NOT NULL,
  "diet_type_id" int4 NOT NULL,
  CONSTRAINT "recipe_pkey" PRIMARY KEY ("recipe_id")
);
ALTER TABLE "recipe" OWNER TO "postgres";

CREATE TABLE "roles" (
  "role_id" int4 NOT NULL DEFAULT nextval('roles_role_id_seq'::regclass),
  "name" varchar(40) NOT NULL COLLATE "pg_catalog"."default",
  CONSTRAINT "roles_pkey" PRIMARY KEY ("role_id"),
  CONSTRAINT "roles_name_key" UNIQUE ("name")
);
ALTER TABLE "roles" OWNER TO "postgres";

CREATE TABLE "userprofile" (
  "user_profile_id" int4 NOT NULL DEFAULT nextval('userprofile_user_profile_id_seq'::regclass),
  "name" varchar(50) COLLATE "pg_catalog"."default",
  "surname" varchar(50) COLLATE "pg_catalog"."default",
  "phone_number" varchar(15) COLLATE "pg_catalog"."default",
  "user_id" int4 NOT NULL,
  CONSTRAINT "userprofile_pkey" PRIMARY KEY ("user_profile_id"),
  CONSTRAINT "userprofile_user_id_key" UNIQUE ("user_id")
);
ALTER TABLE "userprofile" OWNER TO "postgres";

CREATE TABLE "users" (
  "user_id" int4 NOT NULL DEFAULT nextval('users_user_id_seq'::regclass),
  "username" varchar(40) NOT NULL COLLATE "pg_catalog"."default",
  "email" varchar(255) NOT NULL COLLATE "pg_catalog"."default",
  "password_hash" varchar(255) NOT NULL COLLATE "pg_catalog"."default",
  "role_id" int4 NOT NULL,
  CONSTRAINT "users_pkey" PRIMARY KEY ("user_id"),
  CONSTRAINT "users_username_key" UNIQUE ("username")
);
ALTER TABLE "users" OWNER TO "postgres";

ALTER TABLE "images" ADD CONSTRAINT "images_recipe_id_fkey" FOREIGN KEY ("recipe_id") REFERENCES "recipe" ("recipe_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "likedrecipes" ADD CONSTRAINT "likedrecipes_recipe_id_fkey" FOREIGN KEY ("recipe_id") REFERENCES "recipe" ("recipe_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "likedrecipes" ADD CONSTRAINT "likedrecipes_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "recipe" ADD CONSTRAINT "recipe_author_id_fkey" FOREIGN KEY ("author_id") REFERENCES "users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "recipe" ADD CONSTRAINT "recipe_diet_type_id_fkey" FOREIGN KEY ("diet_type_id") REFERENCES "diettype" ("diet_type_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "recipe" ADD CONSTRAINT "recipe_food_category_id_fkey" FOREIGN KEY ("food_category_id") REFERENCES "foodcategory" ("food_category_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "userprofile" ADD CONSTRAINT "userprofile_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "users" ADD CONSTRAINT "users_role_id_fkey" FOREIGN KEY ("role_id") REFERENCES "roles" ("role_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

INSERT INTO foodcategory (category)
VALUES
  ('Asian'),
  ('Italian'),
  ('African'),
  ('Middle Eastern'),
  ('North American'),
  ('South American'),
  ('European'),
  ('Oceanian'),
  ('Caribbean'),
  ('Mediterranean'),
  ('Scandinavian'),
  ('Latin American'),
  ('Indian'),
  ('Southeast Asian'),
  ('East Asian'),
  ('Central Asian'),
  ('Pacific Islander'),
  ('Arctic'),
  ('Antarctic'),
  ('Other');

INSERT INTO roles (name)
VALUES
  ('user'),
  ('admin');
insert into diettype (diet_type) values
    ('Vegan'),
    ('Vegetarian'),
    ('Pescatarian'),
    ('Flexitarian'),
    ('Low-Carb'),
    ('Gluten-Free'),
    ('Low-Fat'),
    ('Low-Calorie'),
    ('Dairy-Free');
