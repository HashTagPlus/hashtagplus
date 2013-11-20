CREATE DATABASE hashtagplus;

USE hashtagplus;

CREATE TABLE Entrytype(
  id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  entrytype VARCHAR(100)
);

CREATE TABLE Entry(
  id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  url VARCHAR(255),
  entrytype INT(10),
  FOREIGN KEY (Entrytype) REFERENCES Entrytype(id)
);


INSERT INTO Entrytype (entrytype) VALUES ("Web page");
INSERT INTO Entrytype (entrytype) VALUES ("Video");

INSERT INTO Entry (url, entrytype) VALUES ("http://www.google.com", "1");
INSERT INTO Entry (url, entrytype) VALUES ("http://www.myvid.com/video1", "2");

