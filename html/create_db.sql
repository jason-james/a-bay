DROP DATABASE Abay;
CREATE DATABASE Abay
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;
GRANT SELECT, UPDATE, INSERT, DELETE
    ON Abay.*
    TO 'root'@'localhost'
    IDENTIFIED BY '';
USE Abay;

CREATE TABLE Account
(
    user_id INTEGER AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(40) NOT NULL,
    password VARCHAR(40) NOT NULL
);
CREATE TABLE Addresses
(
    id INTEGER NOT NULL PRIMARY KEY,
    address1 VARCHAR(120) NOT NULL,
    address2 VARCHAR(120),
    city VARCHAR(100) NOT NULL,
    country CHAR(2) NOT NULL,
    postcode VARCHAR(12) NOT NULL
);
CREATE TABLE User
(
    user_id INTEGER REFERENCES Account(user_id),
    username VARCHAR(40) REFERENCES Account(username),
    first_name VARCHAR(40) NOT NULL,
    surname VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    date_of_birth DATE NOT NULL,
    address REFERENCES Addresses(id) NOT NULL
);
CREATE TABLE Buyer
(
    user_id INTEGER REFERENCES Account(user_id),
    username VARCHAR(40) REFERENCES Account(username),
    first_name VARCHAR(40) NOT NULL,
    surname VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    date_of_birth DATE NOT NULL,
    address INTEGER REFERENCES Addresses(id) NOT NULL #look into
);
CREATE TABLE Seller
(
    user_id INTEGER REFERENCES Account(user_id),
    # selling_history, correspondence. Do they need their own tables?
);
CREATE TABLE Bid
(
    bid_id INTEGER NOT NULL PRIMARY KEY,
    bid_amount FLOAT NOT NULL CHECK( bid_amount > 0 ),
    bid_time INTEGER NOT NULL
);
CREATE TABLE Item
(
    item_id INTEGER NOT NULL PRIMARY KEY,
    description VARCHAR(4000) NOT NULL,
    size VARCHAR(10) NOT NULL,
    # category : Need a list of categories to choose from and set as constraint
    # recent_sales?
    location INTEGER NOT NULL REFERENCES Addresses(country)
);
CREATE TABLE Listings
(
    listing_id INTEGER NOT NULL REFERENCES Item(item_id),
    end_time INTEGER NOT NULL,
    start_time INTEGER NOT NULL,
    number_of_bids INTEGER CHECK( number_of_bids >= 0 ), # derived data
    latest_bid_amount FLOAT CHECK(latest_bid_amount >= 0), # derived data
    number_watching INTEGER,
    bids INTEGER REFERENCES Bid(bid_id),
    buy_now_price FLOAT,
    starting_price FLOAT NOT NULL CHECK(starting_price > 0)
);
CREATE TABLE Recommendation
(
    category_represented VARCHAR(?) REFERENCES Item(category), # somehow
    listing_id INTEGER NOT NULL REFERENCES Item(item_id)
)
    ENGINE = InnoDB;

