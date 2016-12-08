/* ---------------------------------------------------------------------------------------------------------------------------------- */
/*                                                          Tables Creation                                                           */
/* ---------------------------------------------------------------------------------------------------------------------------------- */

.mode column
.headers on

CREATE TABLE User (
	Username CHAR[50] PRIMARY KEY,
	FirstName CHAR[20] NOT NULL,
	LastName CHAR[20] NOT NULL,
    Email CHAR[50] NOT NULL,
    Password CHAR[255] NOT NULL,
	Profile_picture NUMBER
);

CREATE TABLE Owner (
	Username CHAR[50] PRIMARY KEY,
	FOREIGN KEY(Username) REFERENCES User(Username)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Reviewer (
	Username CHAR[50] PRIMARY KEY,
	FOREIGN KEY(Username) REFERENCES User(Username)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Address (
	ID NUMBER PRIMARY KEY,
	StreetName CHAR[200],
	Latitude NUMBER,
	Longitude NUMBER 
);

CREATE TABLE Picture (
	ID NUMBER PRIMARY KEY,
	Restaurant_ID NUMBER,
	Username CHAR[50],
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Username) REFERENCES User(Username)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Review (
	ID NUMBER PRIMARY KEY,
	Username CHAR[50],
	Score NUMBER,
	DateReview Date,
	Restaurant_ID NUMBER,
	FOREIGN KEY(Username) REFERENCES Reviewer(Username)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Comment (
	ID NUMBER PRIMARY KEY,
	Username CHAR[50],
	Review_ID NUMBER,
	Content CHAR[1000],
	CommentDate Date,
	FOREIGN KEY(Username) REFERENCES Owner(Username)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Review_ID) REFERENCES Review(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Restaurant (
	ID NUMBER PRIMARY KEY,
	Name CHAR[20] NOT NULL,
	NScores NUMBER,
	TotalScores NUMBER,
	Price NUMBER,
	OpenHours CHAR[500],
	Description CHAR[5000],
	Address_ID NUMBER,
	FOREIGN KEY(Address_ID) REFERENCES Address(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Menu (
	ID NUMBER PRIMARY KEY,
	Food CHAR[50],
	Price NUMBER,
	Category_ID NUMBER,
	FOREIGN KEY(Category_ID) REFERENCES Category(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Category (
	ID NUMBER PRIMARY KEY,
	Category CHAR[50]
);

/* Association Tables */

CREATE TABLE OwnerRestaurant(
	Username CHAR[50],
	Restaurant_ID NUMBER,
	PRIMARY KEY(Username, Restaurant_ID),
	FOREIGN KEY(Username) REFERENCES Owner(Username)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE MenuRestaurant (
	Restaurant_ID NUMBER,
	Menu_ID NUMBER,
	PRIMARY KEY(Restaurant_ID, Menu_ID),
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Menu_ID) REFERENCES Menu(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE RestaurantCategory (
	Restaurant_ID NUMBER,
	Category_ID NUMBER,
	PRIMARY KEY(Restaurant_ID, Category_ID),
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Category_ID) REFERENCES Category(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE

);

/* ---------------------------------------------------------------------------------------------------------------------------------- */
/*                                                             Triggers                                                               */
/* ---------------------------------------------------------------------------------------------------------------------------------- */
create trigger updateScore 
	after insert on Review 
	for each row 
	begin 
		update Restaurant 
			set NScores = NScores + 1,
				TotalScores = TotalScores + new.Score
		where ID = new.Restaurant_ID;
	end;

/* ---------------------------------------------------------------------------------------------------------------------------------- */
/*                                                            Insertions                                                              */
/* ---------------------------------------------------------------------------------------------------------------------------------- */

PRAGMA FOREIGN_KEYS = ON;

INSERT INTO Address (ID, StreetName, Latitude, Longitude) VALUES (0, 'NULL', 0, 0);
INSERT INTO Address (ID, StreetName, Latitude, Longitude) VALUES (1, 'Praça da Liberdade 126, 4000 Porto', 41.1467, -8.61084);
INSERT INTO Address (ID, StreetName, Latitude, Longitude) VALUES (2, 'Rua Ateneu Comercial do Porto , 22/24', 41.148, -8.60782);

INSERT INTO Category (ID, Category) VALUES (1, 'Appetizers');
INSERT INTO Category (ID, Category) VALUES (2, 'Salads');
INSERT INTO Category (ID, Category) VALUES (3, 'Beverages');
INSERT INTO Category (ID, Category) VALUES (4, 'Chicken');
INSERT INTO Category (ID, Category) VALUES (5, 'Pasta');
INSERT INTO Category (ID, Category) VALUES (6, 'Seafood');
INSERT INTO Category (ID, Category) VALUES (7, 'Rib/Steaks');
INSERT INTO Category (ID, Category) VALUES (8, 'Burger/Sandwiches');
INSERT INTO Category (ID, Category) VALUES (9, 'Kids Menu');
INSERT INTO Category (ID, Category) VALUES (10, 'Healthy Options');
INSERT INTO Category (ID, Category) VALUES (11, 'Desserts');

INSERT INTO Restaurant (ID, Name, NScores, TotalScores, Price, OpenHours, Description, Address_ID) VALUES (1, 'MacDonalds', 0, 0, 10, 'Por descobrir', 'Bad Food', 1);
INSERT INTO Restaurant (ID, Name, NScores, TotalScores, Price, OpenHours, Description, Address_ID) VALUES (2, 'Abadia do Porto', 0, 0, 10, 'Por descobrir', 'Situado na zona histórica da cidade Invicta, o restaurante Abadia do Porto, foi fundado em 1939. Diz-se que o nome terá origem nas abadias, onde os peregrinos, que demandavam de Santiago de Compostela, repousavam algumas horas, dormindo e comendo antes de encetar mais uma etapa da longa caminhada com o objectivo religioso. Desde à muitos anos que o Abadia do Porto é conhecido pelas excelentes refeições que serve, sendo local de passagem obrigatória para inúmeras individualidades, tais como: Francisco Sá Carneiro, Aníbal Cavaco Silva, José Saramago, Sophia Loren, entre muitos outros. O Abadia do Porto serve diariamente pratos como: Cabrito Assado, Bacalhau Gomes de Sá, Tripas à moda do Porto, Pataniscas de Bacalhau, Bife à Abadia, Filetes de Pescada, entre outros e a acompanhar, o seu famoso esparregado. O Restaurante Abadia do Porto tem acesso para deficientes e WC respectivo.', 2);
