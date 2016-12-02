/* ---------------------------------------------------------------------------------------------------------------------------------- */
/*                                                          Tables Creation                                                           */
/* ---------------------------------------------------------------------------------------------------------------------------------- */

.mode column
.headers on

CREATE TABLE User (
	User_ID NUMBER PRIMARY KEY,
	User_name CHAR[50] NOT NULL,
	Age NUMBER NOT NULL 
		CHECK(Age > 0),
	Profile_picture NUMBER,
	Bios CHAR[200],
	Address_ID NUMBER,
	FOREIGN KEY(Address_ID) REFERENCES Address(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Owner (
	User_ID NUMBER PRIMARY KEY,
	FOREIGN KEY(User_ID) REFERENCES User(User_ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Reviewer (
	User_ID NUMBER PRIMARY KEY,
	FOREIGN KEY(User_ID) REFERENCES User(User_ID)
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
	User_ID NUMBER,
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(User_ID) REFERENCES User(User_ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Review (
	ID NUMBER PRIMARY KEY,
	User_ID NUMBER,
	Score NUMBER,
	DateReview Date,
	Restaurant_ID NUMBER,
	FOREIGN KEY(User_ID) REFERENCES Reviewer(Use_ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE,
	FOREIGN KEY(Restaurant_ID) REFERENCES Restaurant(ID)
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

CREATE TABLE Comment (
	ID NUMBER PRIMARY KEY,
	User_ID NUMBER,
	Review_ID NUMBER,
	Content CHAR[1000],
	CommentDate Date,
	FOREIGN KEY(User_ID) REFERENCES Owner(User_ID)
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
	Owner_ID NUMBER,
	Restaurant_ID NUMBER,
	PRIMARY KEY(Owner_ID, Restaurant_ID),
	FOREIGN KEY(Owner_ID) REFERENCES Owner(User_ID)
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

INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (1, 'Amelia', 28, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (2, 'Olivia', 46, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (3, 'Emily', 60, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (4, 'Ava', 48, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (5, 'Isla', 18, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (6, 'Jessica', 52, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (7, 'Poppy', 18, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (8, 'Isabella', 57, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (9, 'Sophie', 46, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (10, 'Mia', 57, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (11, 'Ruby', 33, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (12, 'Lily', 56, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (13, 'Grace', 25, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (14, 'Evie', 28, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (15, 'Sophia', 23, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (16, 'Ella', 57, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (17, 'Scarlett', 36, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (18, 'Chloe', 40, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (19, 'Isabelle', 32, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (20, 'Freya', 53, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (21, 'Charlotte', 49, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (22, 'Sienna', 32, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (23, 'Daisy', 37, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (24, 'Phoebe', 41, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (25, 'Millie', 51, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (26, 'Eva', 58, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (27, 'Alice', 45, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (28, 'Lucy', 32, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (29, 'Florence', 28, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (30, 'Sofia', 59, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (31, 'Layla', 40, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (32, 'Lola', 38, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (33, 'Holly', 44, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (34, 'Imogen', 39, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (35, 'Molly', 60, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (36, 'Matilda', 45, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (37, 'Lilly', 22, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (38, 'Rosie', 53, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (39, 'Elizabeth', 33, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (40, 'Erin', 51, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (41, 'Maisie', 49, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (42, 'Lexi', 48, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (43, 'Ellie', 38, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (44, 'Hannah', 57, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (45, 'Evelyn', 50, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (46, 'Abigail', 35, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (47, 'Elsie', 45, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (48, 'Summer', 18, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (49, 'Megan', 49, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (50, 'Jasmine', 60, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (51, 'Oliver', 45, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (52, 'Jack', 30, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (53, 'Harry', 31, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (54, 'Jacob', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (55, 'Charlie', 53, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (56, 'Thomas', 56, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (57, 'Oscar', 19, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (58, 'William', 37, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (59, 'James', 27, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (60, 'George', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (61, 'Alfie', 35, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (62, 'Joshua', 41, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (63, 'Noah', 33, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (64, 'Ethan', 53, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (65, 'Muhammad', 19, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (66, 'Archie', 33, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (67, 'Leo', 29, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (68, 'Henry', 58, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (69, 'Joseph', 60, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (70, 'Samuel', 44, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (71, 'Riley', 40, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (72, 'Daniel', 40, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (73, 'Mohammed', 23, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (74, 'Alexander', 60, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (75, 'Max', 28, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (76, 'Lucas', 56, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (77, 'Mason', 26, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (78, 'Logan', 56, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (79, 'Isaac', 56, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (80, 'Benjamin', 50, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (81, 'Dylan', 55, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (82, 'Jake', 40, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (83, 'Edward', 19, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (84, 'Finley', 60, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (85, 'Freddie', 36, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (86, 'Harrison', 54, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (87, 'Tyler', 55, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (88, 'Sebastian', 37, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (89, 'Zachary', 30, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (90, 'Adam', 56, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (91, 'Theo', 40, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (92, 'Jayden', 39, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (93, 'Arthur', 36, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (94, 'Toby', 55, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (95, 'Luke', 31, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (96, 'Lewis', 29, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (97, 'Matthew', 19, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (98, 'Harvey', 43, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (99, 'Harley', 26, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (100, 'David', 18, 0, 'Im beautiful', 0);

INSERT INTO Owner (User_ID) VALUES (26);
INSERT INTO Owner (User_ID) VALUES (92);
INSERT INTO Owner (User_ID) VALUES (90);
INSERT INTO Owner (User_ID) VALUES (74);
INSERT INTO Owner (User_ID) VALUES (82);
INSERT INTO Owner (User_ID) VALUES (62);
INSERT INTO Owner (User_ID) VALUES (75);
INSERT INTO Owner (User_ID) VALUES (70);
INSERT INTO Owner (User_ID) VALUES (73);
INSERT INTO Owner (User_ID) VALUES (65);
INSERT INTO Owner (User_ID) VALUES (94);
INSERT INTO Owner (User_ID) VALUES (97);
INSERT INTO Owner (User_ID) VALUES (57);
INSERT INTO Owner (User_ID) VALUES (9);
INSERT INTO Owner (User_ID) VALUES (39);
INSERT INTO Owner (User_ID) VALUES (95);
INSERT INTO Owner (User_ID) VALUES (67);
INSERT INTO Owner (User_ID) VALUES (19);
INSERT INTO Owner (User_ID) VALUES (25);
INSERT INTO Owner (User_ID) VALUES (35);

INSERT INTO Reviewer (User_ID) VALUES (32);
INSERT INTO Reviewer (User_ID) VALUES (24);
INSERT INTO Reviewer (User_ID) VALUES (72);
INSERT INTO Reviewer (User_ID) VALUES (4);
INSERT INTO Reviewer (User_ID) VALUES (37);
INSERT INTO Reviewer (User_ID) VALUES (8);
INSERT INTO Reviewer (User_ID) VALUES (78);
INSERT INTO Reviewer (User_ID) VALUES (34);
INSERT INTO Reviewer (User_ID) VALUES (21);
INSERT INTO Reviewer (User_ID) VALUES (76);
INSERT INTO Reviewer (User_ID) VALUES (7);
INSERT INTO Reviewer (User_ID) VALUES (54);
INSERT INTO Reviewer (User_ID) VALUES (89);
INSERT INTO Reviewer (User_ID) VALUES (81);
INSERT INTO Reviewer (User_ID) VALUES (59);
INSERT INTO Reviewer (User_ID) VALUES (5);
INSERT INTO Reviewer (User_ID) VALUES (51);
INSERT INTO Reviewer (User_ID) VALUES (1);
INSERT INTO Reviewer (User_ID) VALUES (13);
INSERT INTO Reviewer (User_ID) VALUES (27);
INSERT INTO Reviewer (User_ID) VALUES (38);
INSERT INTO Reviewer (User_ID) VALUES (15);
INSERT INTO Reviewer (User_ID) VALUES (50);
INSERT INTO Reviewer (User_ID) VALUES (49);
INSERT INTO Reviewer (User_ID) VALUES (88);
INSERT INTO Reviewer (User_ID) VALUES (44);
INSERT INTO Reviewer (User_ID) VALUES (61);
INSERT INTO Reviewer (User_ID) VALUES (28);
INSERT INTO Reviewer (User_ID) VALUES (93);
INSERT INTO Reviewer (User_ID) VALUES (22);
INSERT INTO Reviewer (User_ID) VALUES (46);
INSERT INTO Reviewer (User_ID) VALUES (11);
INSERT INTO Reviewer (User_ID) VALUES (99);
INSERT INTO Reviewer (User_ID) VALUES (33);
INSERT INTO Reviewer (User_ID) VALUES (3);
INSERT INTO Reviewer (User_ID) VALUES (83);
INSERT INTO Reviewer (User_ID) VALUES (42);
INSERT INTO Reviewer (User_ID) VALUES (6);
INSERT INTO Reviewer (User_ID) VALUES (55);
INSERT INTO Reviewer (User_ID) VALUES (53);
INSERT INTO Reviewer (User_ID) VALUES (64);
INSERT INTO Reviewer (User_ID) VALUES (40);
INSERT INTO Reviewer (User_ID) VALUES (36);
INSERT INTO Reviewer (User_ID) VALUES (18);
INSERT INTO Reviewer (User_ID) VALUES (30);
INSERT INTO Reviewer (User_ID) VALUES (85);
INSERT INTO Reviewer (User_ID) VALUES (23);
INSERT INTO Reviewer (User_ID) VALUES (79);
INSERT INTO Reviewer (User_ID) VALUES (31);
INSERT INTO Reviewer (User_ID) VALUES (47);
INSERT INTO Reviewer (User_ID) VALUES (56);
INSERT INTO Reviewer (User_ID) VALUES (20);
INSERT INTO Reviewer (User_ID) VALUES (43);
INSERT INTO Reviewer (User_ID) VALUES (60);
INSERT INTO Reviewer (User_ID) VALUES (17);
INSERT INTO Reviewer (User_ID) VALUES (16);
INSERT INTO Reviewer (User_ID) VALUES (80);
INSERT INTO Reviewer (User_ID) VALUES (48);
INSERT INTO Reviewer (User_ID) VALUES (100);
INSERT INTO Reviewer (User_ID) VALUES (77);
INSERT INTO Reviewer (User_ID) VALUES (10);
INSERT INTO Reviewer (User_ID) VALUES (84);
INSERT INTO Reviewer (User_ID) VALUES (71);
INSERT INTO Reviewer (User_ID) VALUES (58);
INSERT INTO Reviewer (User_ID) VALUES (98);
INSERT INTO Reviewer (User_ID) VALUES (12);
INSERT INTO Reviewer (User_ID) VALUES (69);
INSERT INTO Reviewer (User_ID) VALUES (29);
INSERT INTO Reviewer (User_ID) VALUES (91);
INSERT INTO Reviewer (User_ID) VALUES (63);
INSERT INTO Reviewer (User_ID) VALUES (2);
INSERT INTO Reviewer (User_ID) VALUES (87);
INSERT INTO Reviewer (User_ID) VALUES (68);
INSERT INTO Reviewer (User_ID) VALUES (45);
INSERT INTO Reviewer (User_ID) VALUES (14);
INSERT INTO Reviewer (User_ID) VALUES (96);
INSERT INTO Reviewer (User_ID) VALUES (52);
INSERT INTO Reviewer (User_ID) VALUES (86);
INSERT INTO Reviewer (User_ID) VALUES (66);
INSERT INTO Reviewer (User_ID) VALUES (41);

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

INSERT INTO Picture (ID, Restaurant_ID, User_ID) VALUES (1, 1, 68);
INSERT INTO Picture (ID, Restaurant_ID, User_ID) VALUES (2, 1, 91);
INSERT INTO Picture (ID, Restaurant_ID, User_ID) VALUES (3, 1, 59);
INSERT INTO Picture (ID, Restaurant_ID, User_ID) VALUES (4, 2, 75);
INSERT INTO Picture (ID, Restaurant_ID, User_ID) VALUES (5, 2, 100);
INSERT INTO Picture (ID, Restaurant_ID, User_ID) VALUES (6, 2, 21);
