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
    Password CHAR[255] NOT NULL
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
	PhoneNumber CHAR[50] NOT NULL,
	NScores NUMBER,
	TotalScores NUMBER,
	Price NUMBER,
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

CREATE TABLE OpenHour (
	ID NUMBER PRIMARY KEY,
	Day CHAR[50],
	OpenTime CHAR[50],
	CloseTime CHAR[50]
);

/* Association Tables */

CREATE TABLE RestaurantOpenHours(
	OpenHour_ID NUMBER,
	Restaurant_ID NUMBER,
	PRIMARY KEY(OpenHour_ID, Restaurant_ID),
	FOREIGN KEY(OpenHour_ID) REFERENCES OpenHour(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

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
INSERT INTO Category (ID, Category) VALUES (10, 'Desserts');
INSERT INTO Category (ID, Category) VALUES (11, 'Vegetarian');

INSERT INTO Restaurant (ID, Name, PhoneNumber, NScores, TotalScores, Price, Description, Address_ID) VALUES (1, 'MacDonalds', '915749273', 0, 0, 10, 'Bad Food', 1);
INSERT INTO Restaurant (ID, Name, PhoneNumber, NScores, TotalScores, Price, Description, Address_ID) VALUES (2, 'Abadia do Porto', '925728472', 0, 0, 10, 'Situado na zona histórica da cidade Invicta, o restaurante Abadia do Porto, foi fundado em 1939. Diz-se que o nome terá origem nas abadias, onde os peregrinos, que demandavam de Santiago de Compostela, repousavam algumas horas, dormindo e comendo antes de encetar mais uma etapa da longa caminhada com o objectivo religioso. Desde à muitos anos que o Abadia do Porto é conhecido pelas excelentes refeições que serve, sendo local de passagem obrigatória para inúmeras individualidades, tais como: Francisco Sá Carneiro, Aníbal Cavaco Silva, José Saramago, Sophia Loren, entre muitos outros. O Abadia do Porto serve diariamente pratos como: Cabrito Assado, Bacalhau Gomes de Sá, Tripas à moda do Porto, Pataniscas de Bacalhau, Bife à Abadia, Filetes de Pescada, entre outros e a acompanhar, o seu famoso esparregado. O Restaurante Abadia do Porto tem acesso para deficientes e WC respectivo.', 2);

INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (0, 'Mini Spring Rolls', 4.80, 1);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (1, 'King Prawn Toast', 5.20, 1);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (2, 'Vegetarian Mini Spring Rolls', 4.80, 1);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (3, 'Mixed Entree', 5.20, 1);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (4, 'Prawn Chips', 2.80, 1);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (5, 'Grilled Chicken Salad', 13.95, 2);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (6, 'Smoked Salmon Salad', 14.95, 2);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (7, 'Shrimp Louie', 14.95, 2);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (8, 'Pepsi', 1.95, 3);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (9, '7-Up', 1.95, 3);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (10, 'Ice Tea', 1.95, 3);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (11,'Lemonade', 1.95, 3);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (12, 'Orange Juice', 2.50, 3);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (13, 'Bottle Water', 1.50, 3);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (14, 'Spicy Chicken Wings /5', 2.29, 4);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (15, 'Nuggets/6', 2.99, 4);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (16, 'Chicken Breast/6', 6.99, 4);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (17, 'Carbonara', 11.00, 5);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (18, 'Bolognese', 11.00, 5);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (19, 'Marinara', 11.00, 5);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (20,'Romana', 11.00, 5);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (21, 'Mediterranean', 11.00, 5);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (22, 'Shrimp', 10.99, 6);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (23, 'Atlantic Snow Crab', 9.99, 6);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (24, 'Catfish', 3.99, 6);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (25, 'Salmon', 10.49, 6);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (26, 'Oysters', 0.75, 6);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (27, 'Regular Steak Plate', 6.00, 7);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (28, 'Large Steak Plate', 10.00, 7);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (29, 'Steak & Eggs', 6.50, 7);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (30, 'Steak with Chicken', 7.00, 7);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (31, 'Classic Beef', 10.75, 8);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (32, 'Chargrilled Chicken', 9.50, 8);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (33, 'Ridiculous Salmon', 9.50, 8);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (34, 'Mac & Cheese', 3.95, 9);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (35, 'Cheese Quesadilla', 3.95, 9);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (36, 'Fish & Chips', 4.45, 9);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (37, 'Top Sirloin Steak', 6.95, 9);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (38, 'Pineapple Cheesecake', 5.25, 10);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (39, 'Peanut Butter Pie', 6.75, 10);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (40, 'Carrot Cake', 6.25, 10);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (41, 'Chocolate Mousse', 7.25, 10);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (42, 'Veggie Bean Pattie', 8.50, 11);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (43, 'Royal Fried Rice', 10.00, 11);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (44, 'House Special Rice Claypot', 11.00, 11);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (45, 'Gourmet Fried Rice', 9.00, 11);
INSERT INTO Menu (ID, Food, Price, Category_ID) VALUES (46, 'Spicy Thai Friend Rice', 10.00, 11);

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

INSERT INTO OpenHour(ID, Day, OpenTime, CloseTime) VALUES(0, 'Monday', '09:00', '20:00');
INSERT INTO OpenHour(ID, Day, OpenTime, CloseTime) VALUES(1, 'Tuesday', '09:00', '20:00');
INSERT INTO OpenHour(ID, Day, OpenTime, CloseTime) VALUES(2, 'Wednesday', '09:00', '20:00');
INSERT INTO OpenHour(ID, Day, OpenTime, CloseTime) VALUES(3, 'Thursday', '09:00', '20:00');
INSERT INTO OpenHour(ID, Day, OpenTime, CloseTime) VALUES(4, 'Friday', '09:00', '20:00');
INSERT INTO OpenHour(ID, Day, OpenTime, CloseTime) VALUES(5, 'Saturday', '09:00', '20:00');
INSERT INTO OpenHour(ID, Day, OpenTime, CloseTime) VALUES(6, 'Sunday', '09:00', '14:00');

INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (0, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (1, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (2, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (3, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (4, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (5, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (6, 1);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (0, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (1, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (2, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (3, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (4, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (5, 2);
INSERT INTO RestaurantOpenHours(OpenHour_ID, Restaurant_ID) VALUES (6, 2);