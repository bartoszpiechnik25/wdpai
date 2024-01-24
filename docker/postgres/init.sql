create extension pg_trgm;
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

create sequence dislikedrecipes_disliked_recipe_id_seq;

alter sequence dislikedrecipes_disliked_recipe_id_seq owner to postgres;

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

create index recipe_method_idx on recipes using gin (method gin_trgm_ops);
create index recipe_description_idx on recipes using gin (description gin_trgm_ops);
create index recipe_ingedients_idx on recipes using gin (ingredients gin_trgm_ops);


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

create table dislikedrecipes
(
  disliked_recipe_id integer default nextval('dislikedrecipes_disliked_recipe_id_seq'::regclass) not null
    primary key,
  user_id integer 
    references users,
  recipe_id integer
    references recipes
);

alter table dislikedrecipes owner to postgres;

create table userprofile
(
	user_profile_id integer default nextval('userprofile_user_profile_id_seq'::regclass) not null
		primary key,
	name varchar(50),
	surname varchar(50),
	phone_number varchar(15),
	user_id integer not null
		unique
		references users on delete cascade
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

insert into users (username, email, password_hash, role_id) values 
('stachu_jones', 'stachu@gmali.com', '1234', 1),
('john_doe', 'john@example.com', '1234', 1),
('jane_smith', 'jane@example.com', '1234', 1),
('admin', 'admin@example.com', 'admin', 2);

insert into userprofile (name, surname, phone_number, user_id) 
values 
  ('John', 'Doe', '123-456-7890', 2),
  ('Jane', 'Smith', '987-654-3210', 3);

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
),
(
  'Spaghetti Bolognese',
  'Classic Italian pasta dish with rich meat sauce.',
  'Spaghetti, ground beef, onion, garlic, tomato sauce, salt, pepper, olive oil, Parmesan cheese',
  '1. Cook spaghetti according to package instructions.\n2. In a pan, sauté chopped onion and garlic in olive oil.\n3. Add ground beef and cook until browned.\n4. Pour in tomato sauce and simmer for 20 minutes.\n5. Season with salt and pepper.\n6. Serve over cooked spaghetti and sprinkle with Parmesan cheese.',
  1,
  2,
  6
),
(
  'Chicken Stir-Fry',
  'Quick and easy Asian-inspired stir-fry with chicken and vegetables.',
  'Chicken breast, broccoli, bell peppers, soy sauce, ginger, garlic, sesame oil, rice',
  '1. Cut chicken into bite-sized pieces.\n2. Stir-fry chicken in sesame oil until cooked.\n3. Add chopped vegetables and cook until tender.\n4. Mix in soy sauce, ginger, and garlic.\n5. Serve over cooked rice.',
  2,
  1,
  3
),
(
  'Vegetarian Buddha Bowl',
  'Healthy and colorful bowl with a variety of vegetables and grains.',
  'Quinoa, roasted sweet potatoes, cherry tomatoes, avocado, kale, hummus, tahini dressing',
  '1. Cook quinoa according to package instructions.\n2. Roast sweet potatoes in the oven.\n3. Assemble the bowl with quinoa, sweet potatoes, tomatoes, sliced avocado, kale, and a dollop of hummus.\n4. Drizzle with tahini dressing.',
  3,
  6,
  1
);

insert into images (recipe_id, image_url) values (
	1, 'pizza.jpg'
),
(
	2, 'sushi.jpg'
),
(
	3, 'ramen.jpg'
),
(
	4, 'spaghetti_bolognese.jpg'
),
(
	5, 'chicken_stir_fry.jpg'
),
(
	6, 'vegetarian_buddha_bowl.jpg'
);

create view most_liked_recipes as
select r.name, count(lr.recipe_id) as "num_likes"
from likedrecipes lr
         join public.recipes r on lr.recipe_id = r.recipe_id
group by lr.recipe_id, r.name
order by count(lr.recipe_id) desc;

create procedure like_recipe(IN p_recipe_id integer, IN p_user_id integer)
	language plpgsql
as $$
    declare
        already_liked int;
    begin
        select user_id into already_liked from likedrecipes where recipe_id=p_recipe_id and user_id=p_user_id;
        if already_liked is null then
            insert into likedrecipes (user_id, recipe_id) values (p_user_id, p_recipe_id);
        end if;
end;
    $$;

alter procedure like_recipe(integer, integer) owner to postgres;

create function move_from_disliked_to_liked() returns trigger
	language plpgsql
as $$
begin
    if exists(select 1 from dislikedrecipes where recipe_id=NEW.recipe_id and user_id=NEW.user_id) then
        delete from dislikedrecipes where user_id=NEW.user_id and recipe_id=NEW.recipe_id;
    end if;
    return new;
end;
$$;

alter function move_from_disliked_to_liked() owner to postgres;

create trigger before_insert_likedrecipes
	before insert
	on likedrecipes
	for each row
	execute procedure move_from_disliked_to_liked();

create function move_from_liked_to_disliked() returns trigger
	language plpgsql
as $$
begin
    if exists(select 1 from likedrecipes where recipe_id=NEW.recipe_id and user_id=NEW.user_id) then
        delete from likedrecipes where user_id=NEW.user_id and recipe_id=NEW.recipe_id;
    end if;
    return new;
end;
$$;

alter function move_from_liked_to_disliked() owner to postgres;

create trigger before_insert_dislikedrecipes
	before insert
	on dislikedrecipes
	for each row
	execute procedure move_from_liked_to_disliked();

create procedure dislike_recipe(IN p_recipe_id integer, IN p_user_id integer)
	language plpgsql
as $$
    declare
        already_disliked int;
    begin
        select user_id into already_disliked from dislikedrecipes where recipe_id=p_recipe_id and user_id=p_user_id;
        if already_disliked is null then
            insert into dislikedrecipes (user_id, recipe_id) values (p_user_id, p_recipe_id);
        end if;
end;
    $$;

