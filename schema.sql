/* 
* Hyperdir: Sistema de Directorio con PHP y MySQL
* @autor: @evilnapsis
* @updated: 2026-05-04
 */

create database hyperdir;
use hyperdir;

create table kind(
	id int not null auto_increment primary key,
	name varchar(50) not null,
	description varchar(255) not null
);

insert into kind(name,description) values("Administrador","Puede administrar todo"),("Autor","Solo puede administrar sus posts"),("Lector","Solo puede leer los posts");

create table user(
	id int not null auto_increment primary key,
	name varchar(50) ,
	lastname varchar(50) ,
	username varchar(50),
	email varchar(255) ,
	password varchar(60) ,
	image varchar(255),
	is_active boolean not null default 1,
	kind_id int default 1,
	foreign key(kind_id) references kind(id),
	created_at datetime not null
);

insert into user(name,username,password,is_active,kind_id,created_at) value ("Admin","admin",sha1(md5("admin")),1,1,NOW());

create table album (
	id int not null auto_increment primary key,
	title varchar(200) ,
	description text ,
	created_at datetime ,
	user_id int ,
	foreign key(user_id) references user(id)
);


create table image (
	id int not null auto_increment primary key,
	src varchar(200) ,
	title varchar(200) ,
	description text ,
	created_at datetime ,
	user_id int ,
	album_id int,
	foreign key(album_id) references album(id),
	foreign key(user_id) references user(id)
);

/*
Kind of post
1.- post
2.- page
*/

create table post (
	id int not null auto_increment primary key,
	image_id int ,
	title varchar(200) not null,
	content text not null,
	address varchar(200),
	phone varchar(200),
	email varchar(200),
	lat varchar(200),
	lng varchar(200),
	is_public boolean not null default 0,
	use_map boolean not null default 0,
	accept_comments boolean not null default 1,
	show_image boolean not null default 1,
	created_at datetime ,
	user_id int ,
	kind int default 1,
	foreign key(image_id) references image(id),
	foreign key(user_id) references user(id)
);


create table category(
	id int not null auto_increment primary key,
	name varchar(50),
	created_at datetime,
	category_id int ,
	foreign key(category_id) references category(id)
	);

create table post_category(
	post_id int not null,
	category_id int ,
	foreign key(category_id) references category(id),
	foreign key(post_id) references post(id)
);

/*
Kind of comment
1.- comment
2.- feedback
*/
create table comment (
	id int not null auto_increment primary key,
	name varchar(200),
	email varchar(200),
	content text,
	is_public boolean not null default 0,
	is_read boolean not null default 0,
	created_at datetime not null,
	kind int default 1,
	user_id int,
	comment_id int,
	foreign key(comment_id) references comment(id),
	post_id int,
	foreign key(post_id) references post(id),
	foreign key(user_id) references user(id)
);

create table post_view(
	id int not null auto_increment primary key,
	viewer_id int,
	post_id int null,
	created_at datetime not null,
	realip varchar(16) not null,
	foreign key (viewer_id) references user(id),
	foreign key (post_id) references post(id)
);


/*
Kind of config
1.- input text
2.- textarea
3.- number
4.- check
*/

create table config(
	id int not null auto_increment primary key,
	slug varchar(100) ,
	name varchar(100) ,
	kind varchar(100) not null default 1,
	description text ,
	advice text
);

insert into config(slug,name,description) value ("navbar_text","Texto del Navbar ","HYPERDIR");
insert into config(slug,name,description) value ("site_title","Titulo del sitio","HYPERDIR");
insert into config(slug,name,description) value ("site_description","Descripcion del Sitio","Sistema de Directorio Basico");

/***/
ALTER TABLE category ADD COLUMN color VARCHAR(255) DEFAULT '#6366f1' AFTER name;
