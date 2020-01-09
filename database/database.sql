/* Creamos la base de datos */
CREATE DATABASE IF NOT EXISTS laravel_master CHARACTER SET utf8 COLLATE utf8_general_ci;

/* Usamos la base de datos */
use laravel_master;

/* Creamos la tabla de usuarios */
CREATE TABLE IF NOT EXISTS users(

	id 							INT (255) auto_increment NOT NULL,
	role						VARCHAR (20),
	name						VARCHAR (100),
	surname					VARCHAR (200),
	nick						VARCHAR (100),
	email						VARCHAR (255),
	password				VARCHAR (255),
	image						VARCHAR (255),
	create_at				DATETIME,
	update_at				DATETIME,
	remember_token	VARCHAR(255),
	CONSTRAINT pk_users PRIMARY KEY(id)

) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDb;

/* Creamos la tabla de imagenes */
CREATE TABLE IF NOT EXISTS images(

	id						INT (255) auto_increment NOT NULL,
	user_id				INT (255),
	image_path		VARCHAR (255),
	description		TEXT,
	create_at			DATETIME,
	update_at			DATETIME,
	CONSTRAINT pk_images PRIMARY KEY(id),
	CONSTRAINT fk_images_user FOREIGN KEY(user_id) REFERENCES users(id)

) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDb;

/* Creamos la tabla de comentarios */
CREATE TABLE IF NOT EXISTS comments(

	id						INT (255) auto_increment NOT NULL,
	user_id				INT (255),
	image_id			INT (255),
	content				TEXT,
	create_at			DATETIME,
	update_at			DATETIME,
	CONSTRAINT pk_comments PRIMARY KEY(id),
	CONSTRAINT fk_comments_user FOREIGN KEY(user_id) REFERENCES users(id),
	CONSTRAINT fk_comments_image FOREIGN KEY(image_id) REFERENCES images(id)

) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDb;

/* Creamos la tabla de likes */
CREATE TABLE IF NOT EXISTS likes(

	id						INT (255) auto_increment NOT NULL,
	user_id				INT (255),
	image_id			INT (255),
	create_at			DATETIME,
	update_at			DATETIME,
	CONSTRAINT pk_likes PRIMARY KEY(id),
	CONSTRAINT fk_likes_user FOREIGN KEY(user_id) REFERENCES users(id),
	CONSTRAINT fk_likes_image FOREIGN KEY(image_id) REFERENCES images(id)

) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDb;