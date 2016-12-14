/* ---------------------------------------------------------------------------------------------------------------------------------- */
/*                                                          Tables Creation                                                           */
/* ---------------------------------------------------------------------------------------------------------------------------------- */
.mode column
.headers on

CREATE TABLE User (
	Username CHAR[50] PRIMARY KEY,
	FirstName CHAR[20] NOT NULL,
	LastName CHAR[20] NOT NULL,
    Email CHAR[200] NOT NULL,
    Password CHAR[255] NOT NULL,
    ProfilePicture CHAR[60]
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
	ID INTEGER PRIMARY KEY AUTOINCREMENT,
	StreetName CHAR[200],
	Latitude NUMBER,
	Longitude NUMBER
);

CREATE TABLE Picture (
	ID INTEGER PRIMARY KEY AUTOINCREMENT,
	Name CHAR[50] NOT NULL,
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
	ID INTEGER PRIMARY KEY AUTOINCREMENT,
	Username CHAR[50],
	Content CHAR[1000],
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

CREATE TABLE Reply (
	ID INTEGER PRIMARY KEY AUTOINCREMENT,
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
	ID INTEGER PRIMARY KEY AUTOINCREMENT,
	Name CHAR[20] NOT NULL,
	PhoneNumber CHAR[50] NOT NULL,
	NScores NUMBER,
	TotalScores NUMBER,
	Price NUMBER,
	Description CHAR[5000],
    ProfilePicture CHAR[60],
	Address_ID NUMBER,
	Owner_Username CHAR[50] NOT NULL,
	FOREIGN KEY(Address_ID) REFERENCES Address(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Owner_Username) REFERENCES Owner(Username)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Menu (
	ID INTEGER PRIMARY KEY AUTOINCREMENT,
	Food CHAR[50],
	Price NUMBER,
	Category_ID NUMBER,
	FOREIGN KEY(Category_ID) REFERENCES Category(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Category (
	ID INTEGER PRIMARY KEY AUTOINCREMENT,
	Category CHAR[50]
);

CREATE TABLE OpenHour (
	ID INTEGER PRIMARY KEY AUTOINCREMENT,
	Day CHAR[50],
	OpenTime CHAR[50],
	CloseTime CHAR[50]
);

/* Association Tables */

CREATE TABLE RestaurantOpenHours(
	OpenHour_ID INTEGER,
	Restaurant_ID INTEGER,
	PRIMARY KEY(OpenHour_ID, Restaurant_ID),
	FOREIGN KEY(OpenHour_ID) REFERENCES OpenHour(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE MenuRestaurant (
	Restaurant_ID INTEGER,
	Menu_ID INTEGER,
	PRIMARY KEY(Restaurant_ID, Menu_ID),
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Menu_ID) REFERENCES Menu(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE RestaurantCategory (
	Restaurant_ID INTEGER,
	Category_ID INTEGER,
	PRIMARY KEY(Restaurant_ID, Category_ID),
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Category_ID) REFERENCES Category(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE

);

CREATE TABLE Favourite (
  Restaurant_ID INTEGER,
	Username CHAR[50],
	PRIMARY KEY(Restaurant_ID, Username),
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Username) REFERENCES User(Username)
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

INSERT INTO User (Username, FirstName, LastName, Email, Password, ProfilePicture) VALUES ('VascoP', 'Vasco', 'Pereira', 'vascop.aluno.c.n@gmail.com', '$2y$12$U2ADM233zzMawdbvH8hKTOriD4voeC8I3OtxL17jOvtN2DKJmGY/2', 'NULL');
INSERT INTO User (Username, FirstName, LastName, Email, Password, ProfilePicture) VALUES ('tiagobalm', 'Tiago', 'Almeida', 'tiagoalmeida.95@hotmail.com', '$2y$12$x22coDYGb9ZIl.OFUGyUq.kP146DFaFf15IrIq0/lEhO5nflFeWpK', 'tiagobalm.jpg');
INSERT INTO User (Username, FirstName, LastName, Email, Password, ProfilePicture) VALUES ('tiago', 'Tiago', 'Almeida', 'tiagoalmeida.95@hotmail.com', '$2y$12$x22coDYGb9ZIl.OFUGyUq.kP146DFaFf15IrIq0/lEhO5nflFeWpK', 'tiagobalm.jpg');

INSERT INTO Reviewer(Username) VALUES('tiago');
INSERT INTO Owner(Username) VALUES ('tiagobalm');
INSERT INTO Owner(Username) VALUES ('VascoP');

INSERT INTO Address (StreetName, Latitude, Longitude) VALUES ('NULL', 0, 0);
INSERT INTO Address (StreetName, Latitude, Longitude) VALUES ('Praca da Liberdade 126, 4000 Porto', 41.1467, -8.61084);
INSERT INTO Address (StreetName, Latitude, Longitude) VALUES ('Rua Ateneu Comercial do Porto , 22/24', 41.148, -8.60782);

INSERT INTO Category (Category) VALUES ('Appetizers');
INSERT INTO Category (Category) VALUES ('Salads');
INSERT INTO Category (Category) VALUES ('Beverages');
INSERT INTO Category (Category) VALUES ('Chicken');
INSERT INTO Category (Category) VALUES ('Pasta');
INSERT INTO Category (Category) VALUES ('Seafood');
INSERT INTO Category (Category) VALUES ('Rib/Steaks');
INSERT INTO Category (Category) VALUES ('Burger/Sandwiches');
INSERT INTO Category (Category) VALUES ('Kids Menu');
INSERT INTO Category (Category) VALUES ('Desserts');
INSERT INTO Category (Category) VALUES ('Vegetarian');

INSERT INTO Restaurant (Name, PhoneNumber, NScores, TotalScores, Price, Description, Address_ID, Owner_Username, ProfilePicture) VALUES ('MacDonalds', '915749273', 0, 0, 10, 'Bad Food', 2, 'VascoP', 'NULL');
INSERT INTO Restaurant (Name, PhoneNumber, NScores, TotalScores, Price, Description, Address_ID, Owner_Username, ProfilePicture) VALUES ('Abadia do Porto', '925728472', 0, 0, 10, 'Situado na zona histórica da cidade Invicta, o restaurante Abadia do Porto, foi fundado em 1939. Diz-se que o nome terá origem nas abadias, onde os peregrinos, que demandavam de Santiago de Compostela, repousavam algumas horas, dormindo e comendo antes de encetar mais uma etapa da longa caminhada com o objectivo religioso. Desde à muitos anos que o Abadia do Porto é conhecido pelas excelentes refeições que serve, sendo local de passagem obrigatória para inúmeras individualidades, tais como: Francisco Sá Carneiro, Aníbal Cavaco Silva, José Saramago, Sophia Loren, entre muitos outros. O Abadia do Porto serve diariamente pratos como: Cabrito Assado, Bacalhau Gomes de Sá, Tripas à moda do Porto, Pataniscas de Bacalhau, Bife à Abadia, Filetes de Pescada, entre outros e a acompanhar, o seu famoso esparregado. O Restaurante Abadia do Porto tem acesso para deficientes e WC respectivo.', 3, 'tiagobalm', 'NULL');

INSERT INTO Picture (Name, Restaurant_ID, Username) VALUES ('1.jpg', 1, 'VascoP');
INSERT INTO Picture (Name, Restaurant_ID, Username) VALUES ('2.jpg', 1, 'VascoP');
INSERT INTO Picture (Name, Restaurant_ID, Username) VALUES ('3.jpg', 1, 'VascoP');

INSERT INTO Picture (Name, Restaurant_ID, Username) VALUES ('4.jpg', 2, 'tiagobalm');
INSERT INTO Picture (Name, Restaurant_ID, Username) VALUES ('5.jpg', 2, 'tiagobalm');
INSERT INTO Picture (Name, Restaurant_ID, Username) VALUES ('6.jpg', 2, 'tiagobalm');

INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Mini Spring Rolls', 4.80, 1);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('King Prawn Toast', 5.20, 1);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Vegetarian Mini Spring Rolls', 4.80, 1);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Mixed Entree', 5.20, 1);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Prawn Chips', 2.80, 1);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Grilled Chicken Salad', 13.95, 2);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Smoked Salmon Salad', 14.95, 2);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Shrimp Louie', 14.95, 2);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Pepsi', 1.95, 3);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('7-Up', 1.95, 3);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Ice Tea', 1.95, 3);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Lemonade', 1.95, 3);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Orange Juice', 2.50, 3);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Bottle Water', 1.50, 3);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Spicy Chicken Wings /5', 2.29, 4);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Nuggets/6', 2.99, 4);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Chicken Breast/6', 6.99, 4);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Carbonara', 11.00, 5);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Bolognese', 11.00, 5);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Marinara', 11.00, 5);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Romana', 11.00, 5);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Mediterranean', 11.00, 5);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Shrimp', 10.99, 6);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Atlantic Snow Crab', 9.99, 6);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Catfish', 3.99, 6);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Salmon', 10.49, 6);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Oysters', 0.75, 6);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Regular Steak Plate', 6.00, 7);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Large Steak Plate', 10.00, 7);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Steak & Eggs', 6.50, 7);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Steak with Chicken', 7.00, 7);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Classic Beef', 10.75, 8);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Chargrilled Chicken', 9.50, 8);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Ridiculous Salmon', 9.50, 8);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Mac & Cheese', 3.95, 9);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Cheese Quesadilla', 3.95, 9);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Fish & Chips', 4.45, 9);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Top Sirloin Steak', 6.95, 9);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Pineapple Cheesecake', 5.25, 10);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Peanut Butter Pie', 6.75, 10);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Carrot Cake', 6.25, 10);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Chocolate Mousse', 7.25, 10);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Veggie Bean Pattie', 8.50, 11);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Royal Fried Rice', 10.00, 11);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('House Special Rice Claypot', 11.00, 11);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Gourmet Fried Rice', 9.00, 11);
INSERT INTO Menu (Food, Price, Category_ID) VALUES ('Spicy Thai Friend Rice', 10.00, 11);

INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 7);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 25);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 21);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 8);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 35);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 9);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 11);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 1);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 32);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 10);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 31);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 16);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 13);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 28);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 23);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 43);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 18);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 38);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 41);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (1, 3);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 29);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 9);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 30);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 22);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 45);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 38);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 27);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 19);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 25);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 15);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 28);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 2);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 32);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 4);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 44);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 12);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 14);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 8);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 24);
INSERT INTO MenuRestaurant(Restaurant_ID, Menu_ID) VALUES (2, 21);

INSERT INTO OpenHour(Day, OpenTime, CloseTime) VALUES('Monday', '09:00', '20:00');
INSERT INTO OpenHour(Day, OpenTime, CloseTime) VALUES('Tuesday', '09:00', '20:00');
INSERT INTO OpenHour(Day, OpenTime, CloseTime) VALUES('Wednesday', '09:00', '20:00');
INSERT INTO OpenHour(Day, OpenTime, CloseTime) VALUES('Thursday', '09:00', '20:00');
INSERT INTO OpenHour(Day, OpenTime, CloseTime) VALUES('Friday', '09:00', '20:00');
INSERT INTO OpenHour(Day, OpenTime, CloseTime) VALUES('Saturday', '09:00', '20:00');
INSERT INTO OpenHour(Day, OpenTime, CloseTime) VALUES('Sunday', '09:00', '14:00');

INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (1, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (2, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (3, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (4, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (5, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (6, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (7, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (1, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (2, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (3, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (4, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (5, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (6, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (7, 2);

INSERT INTO RestaurantCategory (Restaurant_ID, Category_ID) VALUES (1, 8);
INSERT INTO RestaurantCategory (Restaurant_ID, Category_ID) VALUES (1, 10);
INSERT INTO RestaurantCategory (Restaurant_ID, Category_ID) VALUES (1, 9);
INSERT INTO RestaurantCategory (Restaurant_ID, Category_ID) VALUES (2, 1);
INSERT INTO RestaurantCategory (Restaurant_ID, Category_ID) VALUES (2, 3);
INSERT INTO RestaurantCategory (Restaurant_ID, Category_ID) VALUES (2, 4);

INSERT INTO Review (Username, Content, Score, DateReview, Restaurant_ID) VALUES ('tiago', 'Very tasty!!!', 5, '2016-12-13', 1);
INSERT INTO Review (Username, Content, Score, DateReview, Restaurant_ID) VALUES ('tiago', 'Very tas!!!', 5, '2016-12-13', 1);
INSERT INTO Review (Username, Content, Score, DateReview, Restaurant_ID) VALUES ('tiago', 'Very!!!', 5, '2016-12-13', 1);

INSERT INTO Review (Username, Content, Score, DateReview, Restaurant_ID) VALUES ('tiago', 'Very tasty!!!', 5, '2016-12-13', 2);
INSERT INTO Review (Username, Content, Score, DateReview, Restaurant_ID) VALUES ('tiago', 'Very tas!!!', 5, '2016-12-13', 2);
INSERT INTO Review (Username, Content, Score, DateReview, Restaurant_ID) VALUES ('tiago', 'Very!!!', 5, '2016-12-13', 2);

INSERT INTO Reply (Username, Review_ID, Content, CommentDate) VALUES ('VascoP', 1, 'Thank you very much.', '2016-12-13');
INSERT INTO Reply (Username, Review_ID, Content, CommentDate) VALUES ('VascoP', 2, 'Oh, thanks I guess...', '2016-12-13');
INSERT INTO Reply (Username, Review_ID, Content, CommentDate) VALUES ('VascoP', 3, 'Do you need help?', '2016-12-13');

INSERT INTO Favourite (Restaurant_ID, Username) VALUES (1, 'tiago');
INSERT INTO Favourite (Restaurant_ID, Username) VALUES (2, 'tiago');
