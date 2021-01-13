CREATE DATABASE tripcount;
USE tripcount;
CREATE TABLE users (
	id_user MEDIUMINT NOT NULL AUTO_INCREMENT,
	name VARCHAR(25) NOT NULL,
	last_name VARCHAR (40) NOT NULL,
	mail VARCHAR(50) NOT NULL,
	uname VARCHAR(15) NOT NULL,
	pwd VARCHAR(100) NOT NULL,
	PRIMARY KEY(id_user)
);

CREATE TABLE friends (
	id_user MEDIUMINT NOT NULL,
	id_friend MEDIUMINT NOT NULL,
	PRIMARY KEY(id_user, id_friend),
	FOREIGN KEY(id_user) references users(id_user),
	FOREIGN KEY(id_friend) references users(id_user)
);

CREATE TABLE invitations (
	id_invitation MEDIUMINT NOT NULL AUTO_INCREMENT,
	id_user_invitor MEDIUMINT NOT NULL,
	mail VARCHAR(50) NOT NULL,
	PRIMARY KEY(id_invitation),
	FOREIGN KEY(id_user_invitor) references users(id_user)
);

CREATE TABLE currency (
	id_currency MEDIUMINT NOT NULL AUTO_INCREMENT,
	country VARCHAR(100),
	currency VARCHAR(100),
	code VARCHAR(100),
	symbol VARCHAR(100),
	PRIMARY KEY(id_currency)
);

CREATE TABLE travels (
	id_travel MEDIUMINT NOT NULL AUTO_INCREMENT,
	t_name VARCHAR(100) NOT NULL,
	t_description VARCHAR(500) NOT NULL,
	t_creation DATE NOT NULL,
	t_update DATE NOT NULL,
	id_currency MEDIUMINT,
	FOREIGN KEY(id_currency) references currency(id_currency),
	PRIMARY KEY(id_travel)
);

CREATE TABLE users_travels (
	id_travel MEDIUMINT NOT NULL AUTO_INCREMENT,
	id_user MEDIUMINT NOT NULL,
	FOREIGN KEY(id_travel) references travels(id_travel),
	FOREIGN KEY(id_user) references users(id_user),
	PRIMARY KEY(id_travel, id_user)
);

CREATE TABLE expenses (
	id_expense MEDIUMINT NOT NULL AUTO_INCREMENT,
	amount MEDIUMINT NOT NULL,
	expense_date DATE NOT NULL,
	id_travel MEDIUMINT NOT NULL,
	FOREIGN KEY(id_travel) references travels(id_travel),
	PRIMARY KEY(id_expense)
);

CREATE TABLE user_expenses (
	id_user MEDIUMINT NOT NULL,
	id_expense MEDIUMINT NOT NULL,
	FOREIGN KEY(id_user) references users(id_user),
	FOREIGN KEY(id_expense) references expenses(id_expense),
	PRIMARY KEY(id_user, id_expense)
);

/*Insert users*/
INSERT INTO users (name, last_name, mail, uname, pwd) VALUES ('Check', 'Correct', 'mail@mail.com', 'Manolo', 'b03ddf3ca2e714a6548e7495e2a03f5e824eaac9837cd7f159c67b90fb4b7342'); /*P@ssw0rd*/
INSERT INTO users (name, last_name, mail, uname, pwd) VALUES ('Another', 'User', 'example@mail.com', 'Anon', '1a4d8f9dabdf67491921cd1f528b27fcca35cc1e76afdb26ea1c4c237bf7e27b'); /*AsDf 1243*/
INSERT INTO users (name, last_name, mail, uname, pwd) VALUES ('Anon', 'Imous', 'something@dunno.com', 'Mlem', '90395d452a308fcb26c44a7a5fb70916b2aaf592fccdd187ac7c6e1192b217c1'); /*Anon*/
/*Insert friends*/
INSERT INTO friends (id_user, id_friend) VALUES (1, 2); /*User 1 added user 2 as a friend*/
INSERT INTO friends (id_user, id_friend) VALUES (2, 1); /*User 2 added user 1 as a friend*/

/*Insert Invitations*/
INSERT INTO invitations (id_user_invitor, mail) VALUES (1, 'example@mail.com');
INSERT INTO invitations (id_user_invitor, mail) VALUES (1, 'anotheruser@mail.com');

/*Insert currency records*/
INSERT INTO currency (country, currency, code, symbol) VALUES ('Albania', 'Leke', 'ALL', 'Lek');
INSERT INTO currency (country, currency, code, symbol) VALUES ('America', 'Dollars', 'USD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Afghanistan', 'Afghanis', 'AFN', '؋');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Argentina', 'Pesos', 'ARS', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Aruba', 'Guilders', 'AWG', 'ƒ');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Australia', 'Dollars', 'AUD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Azerbaijan', 'New Manats', 'AZN', 'ман');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Bahamas', 'Dollars', 'BSD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Barbados', 'Dollars', 'BBD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Belarus', 'Rubles', 'BYR', 'p.');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Belgium', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Beliz', 'Dollars', 'BZD', 'BZ$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Bermuda', 'Dollars', 'BMD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Bolivia', 'Bolivianos', 'BOB', '$b');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Botswana', 'Pula', 'BWP', 'P');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Bulgaria', 'Leva', 'BGN', 'лв');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Brazil', 'Reais', 'BRL', 'R$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Britain (United Kingdom)', 'Pounds', 'GBP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Brunei Darussalam', 'Dollars', 'BND', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Cambodia', 'Riels', 'KHR', '៛');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Canada', 'Dollars', 'CAD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Cayman Islands', 'Dollars', 'KYD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Chile', 'Pesos', 'CLP', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('China', 'Yuan Renminbi', 'CNY', '¥');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Colombia', 'Pesos', 'COP', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Costa Rica', 'Colón', 'CRC', '₡');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Croatia', 'Kuna', 'HRK', 'kn');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Cuba', 'Pesos', 'CUP', '₱');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Cyprus', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Czech Republic', 'Koruny', 'CZK', 'Kč');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Denmark', 'Kroner', 'DKK', 'kr');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Dominican Republic', 'Pesos', 'DOP ', 'RD$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('East Caribbean', 'Dollars', 'XCD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Egypt', 'Pounds', 'EGP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('El Salvador', 'Colones', 'SVC', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('England (United Kingdom)', 'Pounds', 'GBP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Euro', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Falkland Islands', 'Pounds', 'FKP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Fiji', 'Dollars', 'FJD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('France', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Ghana', 'Cedis', 'GHC', '¢');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Gibraltar', 'Pounds', 'GIP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Greece', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Guatemala', 'Quetzales', 'GTQ', 'Q');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Guernsey', 'Pounds', 'GGP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Guyana', 'Dollars', 'GYD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Holland (Netherlands)', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Honduras', 'Lempiras', 'HNL', 'L');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Hong Kong', 'Dollars', 'HKD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Hungary', 'Forint', 'HUF', 'Ft');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Iceland', 'Kronur', 'ISK', 'kr');
INSERT INTO currency (country, currency, code, symbol) VALUES ('India', 'Rupees', 'INR', 'Rp');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Indonesia', 'Rupiahs', 'IDR', 'Rp');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Iran', 'Rials', 'IRR', '﷼');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Ireland', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Isle of Man', 'Pounds', 'IMP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Israel', 'New Shekels', 'ILS', '₪');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Italy', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Jamaica', 'Dollars', 'JMD', 'J$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Japan', 'Yen', 'JPY', '¥');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Jersey', 'Pounds', 'JEP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Kazakhstan', 'Tenge', 'KZT', 'лв');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Korea (North)', 'Won', 'KPW', '₩');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Korea (South)', 'Won', 'KRW', '₩');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Kyrgyzstan', 'Soms', 'KGS', 'лв');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Laos', 'Kips', 'LAK', '₭');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Latvia', 'Lati', 'LVL', 'Ls');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Lebanon', 'Pounds', 'LBP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Liberia', 'Dollars', 'LRD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Lithuania', 'Litai', 'LTL', 'Lt');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Luxembourg', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Macedonia', 'Denars', 'MKD', 'ден');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Malaysia', 'Ringgits', 'MYR', 'RM');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Malta', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Mauritius', 'Rupees', 'MUR', '₨');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Mexico', 'Pesos', 'MXN', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Mongolia', 'Tugriks', 'MNT', '₮');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Mozambique', 'Meticais', 'MZN', 'MT');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Namibia', 'Dollars', 'NAD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Nepal', 'Rupees', 'NPR', '₨');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Netherlands Antilles', 'Guilders', 'ANG', 'ƒ');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Netherlands', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('New Zealand', 'Dollars', 'NZD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Nicaragua', 'Cordobas', 'NIO', 'C$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Nigeria', 'Nairas', 'NGN', '₦');
INSERT INTO currency (country, currency, code, symbol) VALUES ('North Korea', 'Won', 'KPW', '₩');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Norway', 'Krone', 'NOK', 'kr');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Oman', 'Rials', 'OMR', '﷼');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Pakistan', 'Rupees', 'PKR', '₨');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Panama', 'Balboa', 'PAB', 'B/.');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Paraguay', 'Guarani', 'PYG', 'Gs');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Peru', 'Nuevos Soles', 'PEN', 'S/.');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Philippines', 'Pesos', 'PHP', 'Php');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Poland', 'Zlotych', 'PLN', 'zł');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Qatar', 'Rials', 'QAR', '﷼');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Romania', 'New Lei', 'RON', 'lei');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Russia', 'Rubles', 'RUB', 'руб');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Saint Helena', 'Pounds', 'SHP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Saudi Arabia', 'Riyals', 'SAR', '﷼');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Serbia', 'Dinars', 'RSD', 'Дин.');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Seychelles', 'Rupees', 'SCR', '₨');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Singapore', 'Dollars', 'SGD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Slovenia', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Solomon Islands', 'Dollars', 'SBD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Somalia', 'Shillings', 'SOS', 'S');
INSERT INTO currency (country, currency, code, symbol) VALUES ('South Africa', 'Rand', 'ZAR', 'R');
INSERT INTO currency (country, currency, code, symbol) VALUES ('South Korea', 'Won', 'KRW', '₩');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Spain', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Sri Lanka', 'Rupees', 'LKR', '₨');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Sweden', 'Kronor', 'SEK', 'kr');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Switzerland', 'Francs', 'CHF', 'CHF');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Suriname', 'Dollars', 'SRD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Syria', 'Pounds', 'SYP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Taiwan', 'New Dollars', 'TWD', 'NT$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Thailand', 'Baht', 'THB', '฿');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Trinidad and Tobago', 'Dollars', 'TTD', 'TT$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Turkey', 'Lira', 'TRY', 'TL');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Turkey', 'Liras', 'TRL', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Tuvalu', 'Dollars', 'TVD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Ukraine', 'Hryvnia', 'UAH', '₴');
INSERT INTO currency (country, currency, code, symbol) VALUES ('United Kingdom', 'Pounds', 'GBP', '£');
INSERT INTO currency (country, currency, code, symbol) VALUES ('United States of America', 'Dollars', 'USD', '$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Uruguay', 'Pesos', 'UYU', '$U');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Uzbekistan', 'Sums', 'UZS', 'лв');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Vatican City', 'Euro', 'EUR', '€');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Vietnam', 'Dong', 'VND', '₫');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Yemen', 'Rials', 'YER', '﷼');
INSERT INTO currency (country, currency, code, symbol) VALUES ('Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$');
INSERT INTO currency (country, currency, code, symbol) VALUES ('India', 'Rupees', 'INR', '₹');

/*Insert travels*/
INSERT INTO travels (t_name, t_description, t_creation, t_update, id_currency) VALUES ('Viaje a Torontontero', 'Vamos al país que todo estadounidense envídia por ser mejor que ellos.', STR_TO_DATE('28-11-2020', '%d-%m-%Y'), STR_TO_DATE('30-12-2020', '%d-%m-%Y'), 37);
INSERT INTO travels (t_name, t_description, t_creation, t_update, id_currency) VALUES ('¡A la Argentina!', 'Al país que no es del sol naciente pero igual tiene un sol en la bandera.', STR_TO_DATE('29-11-2020', '%d-%m-%Y'), STR_TO_DATE('1-12-2020', '%d-%m-%Y'), 37);
INSERT INTO travels (t_name, t_description, t_creation, t_update, id_currency) VALUES ('París', 'La ciudad del desamor.', STR_TO_DATE('30-11-2020', '%d-%m-%Y'), STR_TO_DATE('10-12-2020', '%d-%m-%Y'), 37);

/*Insert Users-travels relations*/
INSERT INTO users_travels (id_travel, id_user) VALUES (1, 1);
INSERT INTO users_travels (id_travel, id_user) VALUES (1, 2);
INSERT INTO users_travels (id_travel, id_user) VALUES (2, 1);
INSERT INTO users_travels (id_travel, id_user) VALUES (2, 2);
INSERT INTO users_travels (id_travel, id_user) VALUES (3, 1);

/*Insert expenses data*/
INSERT INTO expenses (amount, expense_date, id_travel) VALUES (150, STR_TO_DATE('14-12-2020', '%d-%m-%Y'), 1);
INSERT INTO expenses (amount, expense_date, id_travel) VALUES (130, STR_TO_DATE('14-12-2020', '%d-%m-%Y'), 1);

/*Insert user-expenses relations*/
INSERT INTO user_expenses (id_user, id_expense) VALUES (1, 1);
INSERT INTO user_expenses (id_user, id_expense) VALUES (2, 1);

COMMIT;
