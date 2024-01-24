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

-- Unknown how to generate base type type

alter type gtrgm owner to postgres;

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

create index recipe_method_idx
	on recipes using gin (method gin_trgm_ops);

create index recipe_description_idx
	on recipes using gin (description gin_trgm_ops);

create index recipe_ingedients_idx
	on recipes using gin (ingredients gin_trgm_ops);

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
		references users
			on delete cascade
);

alter table userprofile owner to postgres;

create view most_liked_recipes(name, num_likes) as
	SELECT r.name,
       count(lr.recipe_id) AS num_likes
FROM likedrecipes lr
         JOIN recipes r ON lr.recipe_id = r.recipe_id
GROUP BY lr.recipe_id, r.name
ORDER BY (count(lr.recipe_id)) DESC;

alter table most_liked_recipes owner to postgres;

create function set_limit(real) returns real
	strict
	language c
as $$
begin
-- missing source code
end;
$$;

alter function set_limit(real) owner to postgres;

create function show_limit() returns real
	stable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function show_limit() owner to postgres;

create function show_trgm(text) returns text[]
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function show_trgm(text) owner to postgres;

create function similarity(text, text) returns real
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function similarity(text, text) owner to postgres;

create function similarity_op(text, text) returns boolean
	stable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function similarity_op(text, text) owner to postgres;

create function word_similarity(text, text) returns real
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function word_similarity(text, text) owner to postgres;

create function word_similarity_op(text, text) returns boolean
	stable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function word_similarity_op(text, text) owner to postgres;

create function word_similarity_commutator_op(text, text) returns boolean
	stable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function word_similarity_commutator_op(text, text) owner to postgres;

create function similarity_dist(text, text) returns real
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function similarity_dist(text, text) owner to postgres;

create function word_similarity_dist_op(text, text) returns real
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function word_similarity_dist_op(text, text) owner to postgres;

create function word_similarity_dist_commutator_op(text, text) returns real
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function word_similarity_dist_commutator_op(text, text) owner to postgres;

create function gtrgm_in(cstring) returns gtrgm
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_in(cstring) owner to postgres;

create function gtrgm_out(gtrgm) returns cstring
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_out(gtrgm) owner to postgres;

create function gtrgm_consistent(internal, text, smallint, oid, internal) returns boolean
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_consistent(internal, text, smallint, oid, internal) owner to postgres;

create function gtrgm_distance(internal, text, smallint, oid, internal) returns double precision
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_distance(internal, text, smallint, oid, internal) owner to postgres;

create function gtrgm_compress(internal) returns internal
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_compress(internal) owner to postgres;

create function gtrgm_decompress(internal) returns internal
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_decompress(internal) owner to postgres;

create function gtrgm_penalty(internal, internal, internal) returns internal
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_penalty(internal, internal, internal) owner to postgres;

create function gtrgm_picksplit(internal, internal) returns internal
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_picksplit(internal, internal) owner to postgres;

create function gtrgm_union(internal, internal) returns gtrgm
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_union(internal, internal) owner to postgres;

create function gtrgm_same(gtrgm, gtrgm, internal) returns internal
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_same(gtrgm, gtrgm, internal) owner to postgres;

create function gin_extract_value_trgm(text, internal) returns internal
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gin_extract_value_trgm(text, internal) owner to postgres;

create function gin_extract_query_trgm(text, internal, smallint, internal, internal, internal, internal) returns internal
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gin_extract_query_trgm(text, internal, smallint, internal, internal, internal, internal) owner to postgres;

create function gin_trgm_consistent(internal, smallint, text, integer, internal, internal, internal, internal) returns boolean
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gin_trgm_consistent(internal, smallint, text, integer, internal, internal, internal, internal) owner to postgres;

create function gin_trgm_triconsistent(internal, smallint, text, integer, internal, internal, internal) returns "char"
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gin_trgm_triconsistent(internal, smallint, text, integer, internal, internal, internal) owner to postgres;

create function strict_word_similarity(text, text) returns real
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function strict_word_similarity(text, text) owner to postgres;

create function strict_word_similarity_op(text, text) returns boolean
	stable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function strict_word_similarity_op(text, text) owner to postgres;

create function strict_word_similarity_commutator_op(text, text) returns boolean
	stable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function strict_word_similarity_commutator_op(text, text) owner to postgres;

create function strict_word_similarity_dist_op(text, text) returns real
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function strict_word_similarity_dist_op(text, text) owner to postgres;

create function strict_word_similarity_dist_commutator_op(text, text) returns real
	immutable
	strict
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function strict_word_similarity_dist_commutator_op(text, text) owner to postgres;

create function gtrgm_options(internal) returns void
	immutable
	parallel safe
	language c
as $$
begin
-- missing source code
end;
$$;

alter function gtrgm_options(internal) owner to postgres;

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

alter procedure dislike_recipe(integer, integer) owner to postgres;

create operator % (procedure = similarity_op, leftarg = text, rightarg = text, commutator = %, join = matchingjoinsel, restrict = matchingsel);

alter operator %(text, text) owner to postgres;

create operator <-> (procedure = similarity_dist, leftarg = text, rightarg = text, commutator = <->);

alter operator <->(text, text) owner to postgres;

create operator family gist_trgm_ops using gist;

alter operator family gist_trgm_ops using gist add
	operator 1 %(text, text),
	operator 2 <->(text, text) for order by float_ops,
	operator 3 ~~(text,text),
	operator 4 ~~*(text,text),
	operator 5 ~(text,text),
	operator 6 ~*(text,text),
	operator 7 %>(text, text),
	operator 8 <->>(text, text) for order by float_ops,
	operator 9 %>>(text, text),
	operator 10 <->>>(text, text) for order by float_ops,
	operator 11 =(text,text),
	function 6(text, text) gtrgm_picksplit(internal, internal),
	function 7(text, text) gtrgm_same(gtrgm, gtrgm, internal),
	function 8(text, text) gtrgm_distance(internal, text, smallint, oid, internal),
	function 10(text, text) gtrgm_options(internal),
	function 2(text, text) gtrgm_union(internal, internal),
	function 3(text, text) gtrgm_compress(internal),
	function 4(text, text) gtrgm_decompress(internal),
	function 5(text, text) gtrgm_penalty(internal, internal, internal),
	function 1(text, text) gtrgm_consistent(internal, text, smallint, oid, internal);

alter operator family gist_trgm_ops using gist owner to postgres;

create operator class gist_trgm_ops for type text using gist as storage gtrgm
	function 6(text, text) gtrgm_picksplit(internal, internal),
	function 1(text, text) gtrgm_consistent(internal, text, smallint, oid, internal),
	function 7(text, text) gtrgm_same(gtrgm, gtrgm, internal),
	function 5(text, text) gtrgm_penalty(internal, internal, internal),
	function 2(text, text) gtrgm_union(internal, internal);

alter operator class gist_trgm_ops using gist owner to postgres;

create operator family gin_trgm_ops using gin;

alter operator family gin_trgm_ops using gin add
	operator 6 ~*(text,text),
	operator 7 %>(text, text),
	operator 11 =(text,text),
	operator 9 %>>(text, text),
	operator 1 %(text, text),
	operator 3 ~~(text,text),
	operator 4 ~~*(text,text),
	operator 5 ~(text,text),
	function 1(text, text) btint4cmp(integer,integer),
	function 4(text, text) gin_trgm_consistent(internal, smallint, text, integer, internal, internal, internal, internal),
	function 6(text, text) gin_trgm_triconsistent(internal, smallint, text, integer, internal, internal, internal),
	function 2(text, text) gin_extract_value_trgm(text, internal),
	function 3(text, text) gin_extract_query_trgm(text, internal, smallint, internal, internal, internal, internal);

alter operator family gin_trgm_ops using gin owner to postgres;

create operator class gin_trgm_ops for type text using gin as storage integer
	function 3(text, text) gin_extract_query_trgm(text, internal, smallint, internal, internal, internal, internal),
	function 2(text, text) gin_extract_value_trgm(text, internal);

alter operator class gin_trgm_ops using gin owner to postgres;

-- Cyclic dependencies found

create operator %> (procedure = word_similarity_commutator_op, leftarg = text, rightarg = text, commutator = <%, join = matchingjoinsel, restrict = matchingsel);

alter operator %>(text, text) owner to postgres;

create operator <% (procedure = word_similarity_op, leftarg = text, rightarg = text, commutator = %>, join = matchingjoinsel, restrict = matchingsel);

alter operator <%(text, text) owner to postgres;

-- Cyclic dependencies found

create operator %>> (procedure = strict_word_similarity_commutator_op, leftarg = text, rightarg = text, commutator = <<%, join = matchingjoinsel, restrict = matchingsel);

alter operator %>>(text, text) owner to postgres;

create operator <<% (procedure = strict_word_similarity_op, leftarg = text, rightarg = text, commutator = %>>, join = matchingjoinsel, restrict = matchingsel);

alter operator <<%(text, text) owner to postgres;

-- Cyclic dependencies found

create operator <->> (procedure = word_similarity_dist_commutator_op, leftarg = text, rightarg = text, commutator = <<->);

alter operator <->>(text, text) owner to postgres;

create operator <<-> (procedure = word_similarity_dist_op, leftarg = text, rightarg = text, commutator = <->>);

alter operator <<->(text, text) owner to postgres;

-- Cyclic dependencies found

create operator <->>> (procedure = strict_word_similarity_dist_commutator_op, leftarg = text, rightarg = text, commutator = <<<->);

alter operator <->>>(text, text) owner to postgres;

create operator <<<-> (procedure = strict_word_similarity_dist_op, leftarg = text, rightarg = text, commutator = <->>>);

alter operator <<<->(text, text) owner to postgres;


