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
	t_creation DATE NOT NULL,
	t_update DATE NOT NULL,
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

INSERT INTO users (id_user, name, last_name, mail, uname, pwd) VALUES (1, 'Check', 'Correct', 'mail@mail.com', 'Manolo', 'P@ssw0rd');
INSERT INTO users (id_user, name, last_name, mail, uname, pwd) VALUES (2, 'Another', 'User', 'example@mail.com', 'Anon', 'AsDf 1243');
INSERT INTO friends (id_user, id_friend) VALUES (1, 2); /*User 1 added user 2 as a friend*/
INSERT INTO friends (id_user, id_friend) VALUES (2, 1); /*User 2 added user 1 as a friend*/
INSERT INTO invitations (id_invitation, id_user_invitor, mail) VALUES (1, 1, 'example@mail.com');
INSERT INTO invitations (id_invitation, id_user_invitor, mail) VALUES (2, 1, 'anotheruser@mail.com');
INSERT INTO travels (id_travel, destination, origin, leaving_day, back_day, t_creation, t_update) VALUES (1, 'Toronto', 'Madrid', STR_TO_DATE('21-12-2020', '%d-%m-%Y'), STR_TO_DATE('02-01-2021', '%d-%m-%Y'), STR_TO_DATE('28-11-2020', '%d-%m-%Y'), STR_TO_DATE('30-11-2020', '%d-%m-%Y'));
INSERT INTO travels (id_travel, destination, origin, leaving_day, back_day, t_creation, t_update) VALUES (2, 'Buenos Aires', 'Toronto', STR_TO_DATE('02-01-2021', '%d-%m-%Y'), STR_TO_DATE('15-01-2021', '%d-%m-%Y'), STR_TO_DATE('29-11-2020', '%d-%m-%Y'), STR_TO_DATE('1-12-2020', '%d-%m-%Y'));
INSERT INTO travels (id_travel, destination, origin, leaving_day, back_day, t_creation, t_update) VALUES (3, 'Paris', 'Buenos Aires', STR_TO_DATE('15-01-2021', '%d-%m-%Y'), STR_TO_DATE('27-01-2021', '%d-%m-%Y'), STR_TO_DATE('30-11-2020', '%d-%m-%Y'), STR_TO_DATE('10-12-2020', '%d-%m-%Y'));
INSERT INTO users_travels (id_travel, id_user) VALUES (1, 1);
INSERT INTO users_travels (id_travel, id_user) VALUES (1, 2);
INSERT INTO users_travels (id_travel, id_user) VALUES (2, 1);
INSERT INTO users_travels (id_travel, id_user) VALUES (2, 2);
INSERT INTO users_travels (id_travel, id_user) VALUES (3, 1);
INSERT INTO expenses (id_expense, amount, expense_date, id_travel) VALUES (1, 150, STR_TO_DATE('14-12-2020', '%d-%m-%Y'), 1);
INSERT INTO expenses (id_expense, amount, expense_date, id_travel) VALUES (2, 130, STR_TO_DATE('14-12-2020', '%d-%m-%Y'), 1);
INSERT INTO user_expenses (id_user, id_expense) VALUES (1, 1);
INSERT INTO user_expenses (id_user, id_expense) VALUES (2, 1);

COMMIT;
