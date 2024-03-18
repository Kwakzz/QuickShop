# CREATE DB
CREATE DATABASE QuickShop;
USE Quickshop;

# CREATE TABLES
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    UserName VARCHAR(255),
    Email VARCHAR(255) UNIQUE,
    Passwd VARCHAR(255),
    UserRole VARCHAR(255),
    CHECK (UserRole IN ('Administrator', 'Sales Personnel', 'Customer', 'Inventory Manager')),
    IsVerified TINYINT
);


CREATE TABLE Products (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(255) UNIQUE,
    ProductDescription TEXT,
    Price DOUBLE,
    StockQuantity INT
);

CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    OrderDate DATE,
    UserID INT,
    TotalAmount DOUBLE,
    FOREIGN KEY (UserID) REFERENCES Users (UserID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE OrderDetails (
    OrderDetailID INT AUTO_INCREMENT PRIMARY KEY,
    OrderID INT,
    ProductID INT,
    Quantity INT,
    Price DOUBLE,
    FOREIGN KEY (OrderID) REFERENCES Orders (OrderID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Products (ProductID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);