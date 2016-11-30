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
/*                                                            Insertions                                                              */
/* ---------------------------------------------------------------------------------------------------------------------------------- */

INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (1, 'Amelia', 42, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (2, 'Olivia', 41, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (3, 'Emily', 30, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (4, 'Ava', 34, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (5, 'Isla', 38, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (6, 'Jessica', 54, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (7, 'Poppy', 28, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (8, 'Isabella', 36, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (9, 'Sophie', 48, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (10, 'Mia', 28, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (11, 'Ruby', 22, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (12, 'Lily', 54, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (13, 'Grace', 52, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (14, 'Evie', 42, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (15, 'Sophia', 50, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (16, 'Ella', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (17, 'Scarlett', 37, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (18, 'Chloe', 37, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (19, 'Isabelle', 47, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (20, 'Freya', 47, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (21, 'Charlotte', 36, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (22, 'Sienna', 37, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (23, 'Daisy', 48, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (24, 'Phoebe', 20, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (25, 'Millie', 44, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (26, 'Eva', 37, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (27, 'Alice', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (28, 'Lucy', 49, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (29, 'Florence', 35, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (30, 'Sofia', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (31, 'Layla', 37, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (32, 'Lola', 59, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (33, 'Holly', 36, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (34, 'Imogen', 49, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (35, 'Molly', 32, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (36, 'Matilda', 48, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (37, 'Lilly', 34, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (38, 'Rosie', 35, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (39, 'Elizabeth', 24, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (40, 'Erin', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (41, 'Maisie', 45, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (42, 'Lexi', 20, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (43, 'Ellie', 49, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (44, 'Hannah', 28, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (45, 'Evelyn', 36, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (46, 'Abigail', 38, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (47, 'Elsie', 31, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (48, 'Summer', 55, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (49, 'Megan', 57, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (50, 'Jasmine', 53, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (51, 'Oliver', 41, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (52, 'Jack', 25, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (53, 'Harry', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (54, 'Jacob', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (55, 'Charlie', 19, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (56, 'Thomas', 39, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (57, 'Oscar', 32, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (58, 'William', 22, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (59, 'James', 28, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (60, 'George', 49, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (61, 'Alfie', 18, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (62, 'Joshua', 39, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (63, 'Noah', 39, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (64, 'Ethan', 36, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (65, 'Muhammad', 27, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (66, 'Archie', 53, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (67, 'Leo', 59, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (68, 'Henry', 35, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (69, 'Joseph', 19, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (70, 'Samuel', 22, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (71, 'Riley', 30, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (72, 'Daniel', 39, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (73, 'Mohammed', 59, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (74, 'Alexander', 18, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (75, 'Max', 49, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (76, 'Lucas', 34, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (77, 'Mason', 38, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (78, 'Logan', 20, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (79, 'Isaac', 21, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (80, 'Benjamin', 35, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (81, 'Dylan', 47, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (82, 'Jake', 44, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (83, 'Edward', 42, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (84, 'Finley', 42, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (85, 'Freddie', 39, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (86, 'Harrison', 35, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (87, 'Tyler', 20, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (88, 'Sebastian', 53, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (89, 'Zachary', 40, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (90, 'Adam', 30, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (91, 'Theo', 33, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (92, 'Jayden', 40, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (93, 'Arthur', 43, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (94, 'Toby', 54, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (95, 'Luke', 50, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (96, 'Lewis', 44, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (97, 'Matthew', 39, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (98, 'Harvey', 48, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (99, 'Harley', 18, 0, 'Im beautiful', 0);
INSERT INTO User (User_ID, User_name, Age, Profile_picture, Bios, Address_ID) VALUES (100, 'David', 40, 0, 'Im beautiful', 0);
INSERT INTO Owner (User_ID) VALUES (90);
INSERT INTO Owner (User_ID) VALUES (49);
INSERT INTO Owner (User_ID) VALUES (61);
INSERT INTO Owner (User_ID) VALUES (7);
INSERT INTO Owner (User_ID) VALUES (2);
INSERT INTO Owner (User_ID) VALUES (45);
INSERT INTO Owner (User_ID) VALUES (89);
INSERT INTO Owner (User_ID) VALUES (92);
INSERT INTO Owner (User_ID) VALUES (41);
INSERT INTO Owner (User_ID) VALUES (63);
INSERT INTO Owner (User_ID) VALUES (71);
INSERT INTO Owner (User_ID) VALUES (75);
INSERT INTO Owner (User_ID) VALUES (81);
INSERT INTO Owner (User_ID) VALUES (10);
INSERT INTO Owner (User_ID) VALUES (42);
INSERT INTO Owner (User_ID) VALUES (47);
INSERT INTO Owner (User_ID) VALUES (36);
INSERT INTO Owner (User_ID) VALUES (20);
INSERT INTO Owner (User_ID) VALUES (100);
INSERT INTO Owner (User_ID) VALUES (5);
INSERT INTO Reviewer (User_ID) VALUES (68);
INSERT INTO Reviewer (User_ID) VALUES (74);
INSERT INTO Reviewer (User_ID) VALUES (95);
INSERT INTO Reviewer (User_ID) VALUES (18);
INSERT INTO Reviewer (User_ID) VALUES (44);
INSERT INTO Reviewer (User_ID) VALUES (72);
INSERT INTO Reviewer (User_ID) VALUES (65);
INSERT INTO Reviewer (User_ID) VALUES (78);
INSERT INTO Reviewer (User_ID) VALUES (62);
INSERT INTO Reviewer (User_ID) VALUES (14);
INSERT INTO Reviewer (User_ID) VALUES (67);
INSERT INTO Reviewer (User_ID) VALUES (86);
INSERT INTO Reviewer (User_ID) VALUES (8);
INSERT INTO Reviewer (User_ID) VALUES (26);
INSERT INTO Reviewer (User_ID) VALUES (70);
INSERT INTO Reviewer (User_ID) VALUES (80);
INSERT INTO Reviewer (User_ID) VALUES (52);
INSERT INTO Reviewer (User_ID) VALUES (3);
INSERT INTO Reviewer (User_ID) VALUES (93);
INSERT INTO Reviewer (User_ID) VALUES (25);
INSERT INTO Reviewer (User_ID) VALUES (35);
INSERT INTO Reviewer (User_ID) VALUES (46);
INSERT INTO Reviewer (User_ID) VALUES (91);
INSERT INTO Reviewer (User_ID) VALUES (54);
INSERT INTO Reviewer (User_ID) VALUES (37);
INSERT INTO Reviewer (User_ID) VALUES (23);
INSERT INTO Reviewer (User_ID) VALUES (15);
INSERT INTO Reviewer (User_ID) VALUES (88);
INSERT INTO Reviewer (User_ID) VALUES (21);
INSERT INTO Reviewer (User_ID) VALUES (53);
INSERT INTO Reviewer (User_ID) VALUES (34);
INSERT INTO Reviewer (User_ID) VALUES (19);
INSERT INTO Reviewer (User_ID) VALUES (48);
INSERT INTO Reviewer (User_ID) VALUES (29);
INSERT INTO Reviewer (User_ID) VALUES (97);
INSERT INTO Reviewer (User_ID) VALUES (60);
INSERT INTO Reviewer (User_ID) VALUES (57);
INSERT INTO Reviewer (User_ID) VALUES (43);
INSERT INTO Reviewer (User_ID) VALUES (96);
INSERT INTO Reviewer (User_ID) VALUES (40);
INSERT INTO Reviewer (User_ID) VALUES (58);
INSERT INTO Reviewer (User_ID) VALUES (79);
INSERT INTO Reviewer (User_ID) VALUES (12);
INSERT INTO Reviewer (User_ID) VALUES (39);
INSERT INTO Reviewer (User_ID) VALUES (56);
INSERT INTO Reviewer (User_ID) VALUES (13);
INSERT INTO Reviewer (User_ID) VALUES (87);
INSERT INTO Reviewer (User_ID) VALUES (22);
INSERT INTO Reviewer (User_ID) VALUES (17);
INSERT INTO Reviewer (User_ID) VALUES (32);
INSERT INTO Reviewer (User_ID) VALUES (16);
INSERT INTO Reviewer (User_ID) VALUES (51);
INSERT INTO Reviewer (User_ID) VALUES (94);
INSERT INTO Reviewer (User_ID) VALUES (98);
INSERT INTO Reviewer (User_ID) VALUES (27);
INSERT INTO Reviewer (User_ID) VALUES (55);
INSERT INTO Reviewer (User_ID) VALUES (50);
INSERT INTO Reviewer (User_ID) VALUES (66);
INSERT INTO Reviewer (User_ID) VALUES (24);
INSERT INTO Reviewer (User_ID) VALUES (69);
INSERT INTO Reviewer (User_ID) VALUES (76);
INSERT INTO Reviewer (User_ID) VALUES (38);
INSERT INTO Reviewer (User_ID) VALUES (82);
INSERT INTO Reviewer (User_ID) VALUES (59);
INSERT INTO Reviewer (User_ID) VALUES (99);
INSERT INTO Reviewer (User_ID) VALUES (11);
INSERT INTO Reviewer (User_ID) VALUES (1);
INSERT INTO Reviewer (User_ID) VALUES (9);
INSERT INTO Reviewer (User_ID) VALUES (85);
INSERT INTO Reviewer (User_ID) VALUES (84);
INSERT INTO Reviewer (User_ID) VALUES (6);
INSERT INTO Reviewer (User_ID) VALUES (77);
INSERT INTO Reviewer (User_ID) VALUES (31);
INSERT INTO Reviewer (User_ID) VALUES (73);
INSERT INTO Reviewer (User_ID) VALUES (83);
INSERT INTO Reviewer (User_ID) VALUES (30);
INSERT INTO Reviewer (User_ID) VALUES (33);
INSERT INTO Reviewer (User_ID) VALUES (4);
INSERT INTO Reviewer (User_ID) VALUES (28);
INSERT INTO Reviewer (User_ID) VALUES (64);