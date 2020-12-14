CREATE DATABASE tripcount;
USE tripcount;
CREATE TABLE users (
	id_user CHAR(3) NOT NULL,
	name VARCHAR(25) NOT NULL,
	last_name VARCHAR (40) NOT NULL,
	mail VARCHAR(50) NOT NULL,
	uname VARCHAR(15) NOT NULL,
	pwd VARCHAR(100) NOT NULL,
	PRIMARY KEY(id_user)
);

CREATE TABLE friends (
	id_user CHAR(3) NOT NULL,
	id_friend CHAR(3) NOT NULL,
	PRIMARY KEY(id_user, id_friend),
	FOREIGN KEY(id_user) references users(id_user),
	FOREIGN KEY(id_friend) references users(id_user)
);

CREATE TABLE invitations (
	id_invitation CHAR(3) NOT NULL,
	id_user_invitor CHAR(3) NOT NULL,
	mail VARCHAR(50) NOT NULL,
	PRIMARY KEY(id_invitation),
	FOREIGN KEY(id_user_invitor) references users(id_user)
);

CREATE TABLE travels (
	id_travel CHAR(3) NOT NULL,
	destination VARCHAR(100) NOT NULL,
	origin VARCHAR(100) NOT NULL,
	leaving_day DATE NOT NULL,
	back_day DATE NOT NULL,
	PRIMARY KEY(id_travel)
);

CREATE TABLE users_travels (
	id_travel CHAR(3) NOT NULL,
	id_user CHAR(3) NOT NULL,
	FOREIGN KEY(id_travel) references travels(id_travel),
	FOREIGN KEY(id_user) references users(id_user),
	PRIMARY KEY(id_travel, id_user)
);

CREATE TABLE expenses (
	id_expense CHAR(5) NOT NULL,
	amount CHAR(7) NOT NULL,
	expense_date DATE NOT NULL,
	id_travel CHAR(3) NOT NULL,
	FOREIGN KEY(id_travel) references travels(id_travel),
	PRIMARY KEY(id_expense)
);

CREATE TABLE user_expenses (
	id_user CHAR(3) NOT NULL,
	id_expense CHAR(5) NOT NULL,
	FOREIGN KEY(id_user) references users(id_user),
	FOREIGN KEY(id_expense) references expenses(id_expense),
	PRIMARY KEY(id_user, id_expense)
);

COMMIT;
