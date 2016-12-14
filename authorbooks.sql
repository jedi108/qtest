
// Так как у книги может быть несколько авторов, то значит у одного автора может быть несколько книг



CREATE TABLE Authors
(
	idAuthor INTEGER UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    SecondName VARCHAR(255) DEFAULT NULL
);

CREATE TABLE Books
(
	idBook INTEGER UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Title VARCHAR(255) NOT NULL
);
SET FOREIGN_KEY_CHECKS=0;
CREATE TABLE Authors_Books
(
	id_Author INTEGER UNSIGNED NOT NULL,
    id_Book INTEGER UNSIGNED NOT NULL,
    PRIMARY KEY (id_Author, id_Book),
    FOREIGN KEY (id_Author) REFERENCES Authrors(idAuthor) ,
    FOREIGN KEY (id_Book) REFERENCES Books(idBook)
);
