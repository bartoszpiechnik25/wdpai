
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
	image_url varchar(100),
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
		Place the dough back into the bowl and cover tightly.', 1, 2, 5
),
(
        'Sushi',
        'Delicious Japanese sushi rolls with fresh ingredients.',
        'Sushi rice, nori, fresh fish (such as salmon or tuna), avocado, cucumber, soy sauce, wasabi, pickled ginger',
        '1. Cook sushi rice and let it cool.\n2. Place a sheet of nori on a bamboo sushi mat.\n3. Spread a thin layer of rice on the nori.\n4. Add slices of fresh fish, avocado, and cucumber.\n5. Roll the sushi tightly using the bamboo mat.\n6. Slice the roll into bite-sized pieces.\n7. Serve with soy sauce, wasabi, and pickled ginger.',
        1,
        1,
        2
),
(
        'Ramen',
        'Comforting bowl of Japanese ramen with savory broth and noodles.',
        'Ramen noodles, chicken or pork broth, soy sauce, miso paste, green onions, sliced pork belly, soft-boiled egg, seaweed',
        '1. Boil ramen noodles according to package instructions.\n2. In a separate pot, heat the broth and add soy sauce and miso paste to taste.\n3. Cook sliced pork belly until browned.\n4. Assemble ramen bowls with noodles, broth, sliced pork, green onions, a soft-boiled egg, and seaweed.\n5. Serve hot and enjoy!',
        1,
        1,
        2
);

insert into images (recipe_id, image_url) values (
	1, 'pizza.jpg'
),
(
	2, 'sushi.jpg'
),
(
	3, 'ramen.jpg'
);
