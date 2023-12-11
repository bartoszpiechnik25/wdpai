-- CREATE SEQUENCE diettype_diet_type_id_seq;
-- CREATE SEQUENCE foodcategory_food_category_id_seq;
-- CREATE SEQUENCE images_image_id_seq;
-- CREATE SEQUENCE likedrecipes_liked_recipe_id_seq;
-- CREATE SEQUENCE recipe_recipe_id_seq;
-- CREATE SEQUENCE roles_role_id_seq;
-- CREATE SEQUENCE userprofile_user_profile_id_seq;
-- CREATE SEQUENCE users_user_id_seq;

-- CREATE TABLE "diettype" (
--   "diet_type_id" int4 NOT NULL DEFAULT nextval('diettype_diet_type_id_seq'::regclass),
--   "diet_type" varchar(60) COLLATE "pg_catalog"."default",
--   CONSTRAINT "diettype_pkey" PRIMARY KEY ("diet_type_id"),
--   CONSTRAINT "diettype_diet_type_key" UNIQUE ("diet_type")
-- );
-- ALTER TABLE "diettype" OWNER TO "postgres";

-- CREATE TABLE "foodcategory" (
--   "food_category_id" int4 NOT NULL DEFAULT nextval('foodcategory_food_category_id_seq'::regclass),
--   "category" varchar COLLATE "pg_catalog"."default",
--   CONSTRAINT "foodcategory_pkey" PRIMARY KEY ("food_category_id"),
--   CONSTRAINT "foodcategory_category_key" UNIQUE ("category")
-- );
-- ALTER TABLE "foodcategory" OWNER TO "postgres";

-- CREATE TABLE "images" (
--   "image_id" int4 NOT NULL DEFAULT nextval('images_image_id_seq'::regclass),
--   "bucket_url" varchar(100) COLLATE "pg_catalog"."default",
--   "recipe_id" int4,
--   CONSTRAINT "images_pkey" PRIMARY KEY ("image_id")
-- );
-- ALTER TABLE "images" OWNER TO "postgres";

-- CREATE TABLE "likedrecipes" (
--   "liked_recipe_id" int4 NOT NULL DEFAULT nextval('likedrecipes_liked_recipe_id_seq'::regclass),
--   "user_id" int4,
--   "recipe_id" int4,
--   CONSTRAINT "likedrecipes_pkey" PRIMARY KEY ("liked_recipe_id")
-- );
-- ALTER TABLE "likedrecipes" OWNER TO "postgres";

-- CREATE TABLE "recipe" (
--   "recipe_id" int4 NOT NULL DEFAULT nextval('recipe_recipe_id_seq'::regclass),
--   "name" varchar(255) COLLATE "pg_catalog"."default",
--   "description" text COLLATE "pg_catalog"."default",
--   "method" text COLLATE "pg_catalog"."default",
--   "author_id" int4 NOT NULL,
--   "food_category_id" int4 NOT NULL,
--   "diet_type_id" int4 NOT NULL,
--   CONSTRAINT "recipe_pkey" PRIMARY KEY ("recipe_id")
-- );
-- ALTER TABLE "recipe" OWNER TO "postgres";

-- CREATE TABLE "roles" (
--   "role_id" int4 NOT NULL DEFAULT nextval('roles_role_id_seq'::regclass),
--   "name" varchar(40) NOT NULL COLLATE "pg_catalog"."default",
--   CONSTRAINT "roles_pkey" PRIMARY KEY ("role_id"),
--   CONSTRAINT "roles_name_key" UNIQUE ("name")
-- );
-- ALTER TABLE "roles" OWNER TO "postgres";

-- CREATE TABLE "userprofile" (
--   "user_profile_id" int4 NOT NULL DEFAULT nextval('userprofile_user_profile_id_seq'::regclass),
--   "name" varchar(50) COLLATE "pg_catalog"."default",
--   "surname" varchar(50) COLLATE "pg_catalog"."default",
--   "phone_number" varchar(15) COLLATE "pg_catalog"."default",
--   "user_id" int4 NOT NULL,
--   CONSTRAINT "userprofile_pkey" PRIMARY KEY ("user_profile_id"),
--   CONSTRAINT "userprofile_user_id_key" UNIQUE ("user_id")
-- );
-- ALTER TABLE "userprofile" OWNER TO "postgres";

-- CREATE TABLE "users" (
--   "user_id" int4 NOT NULL DEFAULT nextval('users_user_id_seq'::regclass),
--   "username" varchar(40) NOT NULL COLLATE "pg_catalog"."default",
--   "email" varchar(255) NOT NULL COLLATE "pg_catalog"."default",
--   "password_hash" varchar(255) NOT NULL COLLATE "pg_catalog"."default",
--   "role_id" int4 NOT NULL,
--   CONSTRAINT "users_pkey" PRIMARY KEY ("user_id"),
--   CONSTRAINT "users_username_key" UNIQUE ("username")
-- );
-- ALTER TABLE "users" OWNER TO "postgres";

-- ALTER TABLE "images" ADD CONSTRAINT "images_recipe_id_fkey" FOREIGN KEY ("recipe_id") REFERENCES "recipe" ("recipe_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ALTER TABLE "likedrecipes" ADD CONSTRAINT "likedrecipes_recipe_id_fkey" FOREIGN KEY ("recipe_id") REFERENCES "recipe" ("recipe_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ALTER TABLE "likedrecipes" ADD CONSTRAINT "likedrecipes_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ALTER TABLE "recipe" ADD CONSTRAINT "recipe_author_id_fkey" FOREIGN KEY ("author_id") REFERENCES "users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ALTER TABLE "recipe" ADD CONSTRAINT "recipe_diet_type_id_fkey" FOREIGN KEY ("diet_type_id") REFERENCES "diettype" ("diet_type_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ALTER TABLE "recipe" ADD CONSTRAINT "recipe_food_category_id_fkey" FOREIGN KEY ("food_category_id") REFERENCES "foodcategory" ("food_category_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ALTER TABLE "userprofile" ADD CONSTRAINT "userprofile_user_id_fkey" FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ALTER TABLE "users" ADD CONSTRAINT "users_role_id_fkey" FOREIGN KEY ("role_id") REFERENCES "roles" ("role_id") ON DELETE NO ACTION ON UPDATE NO ACTION;

create sequence diettype_diet_type_id_seq;

alter sequence diettype_diet_type_id_seq owner to postgres;

create sequence foodcategory_food_category_id_seq;

alter sequence foodcategory_food_category_id_seq owner to postgres;

create sequence images_image_id_seq;

alter sequence images_image_id_seq owner to postgres;

create sequence likedrecipes_liked_recipe_id_seq;

alter sequence likedrecipes_liked_recipe_id_seq owner to postgres;

create sequence recipe_recipe_id_seq;

alter sequence recipe_recipe_id_seq owner to postgres;

create sequence roles_role_id_seq;

alter sequence roles_role_id_seq owner to postgres;

create sequence userprofile_user_profile_id_seq;

alter sequence userprofile_user_profile_id_seq owner to postgres;

create sequence users_user_id_seq;

alter sequence users_user_id_seq owner to postgres;

create table diettype
(
	diet_type_id integer default nextval('diettype_diet_type_id_seq'::regclass) not null
		primary key,
	diet_type varchar(60)
		unique
);

alter table diettype owner to postgres;

create table foodcategory
(
	food_category_id integer default nextval('foodcategory_food_category_id_seq'::regclass) not null
		primary key,
	category varchar
		unique
);

alter table foodcategory owner to postgres;

create table roles
(
	role_id integer default nextval('roles_role_id_seq'::regclass) not null
		primary key,
	name varchar(40) not null
		unique
);

alter table roles owner to postgres;

create table users
(
	user_id integer default nextval('users_user_id_seq'::regclass) not null
		primary key,
	username varchar(40) not null
		unique,
	email varchar(255) not null,
	password_hash varchar(255) not null,
	role_id integer not null
		references roles
);

alter table users owner to postgres;

create table recipes
(
	recipe_id integer default nextval('recipe_recipe_id_seq'::regclass) not null
		constraint recipe_pkey
			primary key,
	name varchar(255),
	description text,
	ingredients text not null,
	method text,
	author_id integer not null
		constraint recipe_author_id_fkey
			references users,
	food_category_id integer not null
		constraint recipe_food_category_id_fkey
			references foodcategory,
	diet_type_id integer not null
		constraint recipe_diet_type_id_fkey
			references diettype
);

alter table recipes owner to postgres;

create table images
(
	image_id integer default nextval('images_image_id_seq'::regclass) not null
		primary key,
	bucket_url varchar(100),
	recipe_id integer
		references recipes
);

alter table images owner to postgres;

create table likedrecipes
(
	liked_recipe_id integer default nextval('likedrecipes_liked_recipe_id_seq'::regclass) not null
		primary key,
	user_id integer
		references users,
	recipe_id integer
		references recipes
);

alter table likedrecipes owner to postgres;

create table userprofile
(
	user_profile_id integer default nextval('userprofile_user_profile_id_seq'::regclass) not null
		primary key,
	name varchar(50),
	surname varchar(50),
	phone_number varchar(15),
	user_id integer not null
		unique
		references users
);

alter table userprofile owner to postgres;


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

insert into users (username, email, password_hash, role_id) values ('stachu_jones', 'stachu@gmali.com', '1234', 1);

insert into recipes (name, description, ingredients, method, author_id, food_category_id, diet_type_id)
values (
        'Pizza Neapolitana',
        'Delicious pizza with enormous edges, tastes like real neapolitan pizza simply follow my steps and enjoy :)',
        '
flour type 00 (639g)
yeast (0.4g)
salt (11g)
water (400 ml)',
        'Mix all the ingredients into a shaggy mass.
Cover the bowl with cling film
Leave the dough to rest for around 1 hour.
Turn the dough out onto the counter and knead for around 5 minutes.
Place the dough back into the bowl and cover tightly.', 1, 2, 5);