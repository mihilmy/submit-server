/*CLEAR THE DATABASE*/
DROP TABLE IF EXISTS submissions;
DROP TABLE IF EXISTS tests;
DROP TABLE IF EXISTS assignments;
DROP TABLE IF EXISTS student_classes;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS classes;
DROP TABLE IF EXISTS teachers;

/*BUILD THE DATABASE*/
CREATE TABLE students (
directory_ID INT(9) PRIMARY KEY, 
name varchar(255) NOT NULL,
email varchar(255) NOT NULL,
password varchar(255) NOT NULL);

CREATE TABLE teachers ( 
directory_ID INT(9) PRIMARY KEY,
name varchar(255) NOT NULL,
email varchar(255) NOT NULL,
password varchar(255) NOT NULL);

CREATE TABLE classes ( 
name varchar(255) NOT NULL PRIMARY KEY,
teacher_ID INT NOT NULL,
FOREIGN KEY(teacher_ID)	REFERENCES teachers(directory_ID));

CREATE TABLE assignments ( 
assignment_ID INT AUTO_INCREMENT PRIMARY KEY,
name varchar(255) NOT NULL,
class_name varchar(255),
due_date DATETIME NOT NULL,
max_score INT NOT NULL,
FOREIGN KEY(class_name) REFERENCES classes(name));

CREATE TABLE student_classes ( 
directory_ID INT NOT NULL,
class_name varchar(255) NOT NULL,
FOREIGN KEY(directory_ID) REFERENCES students(directory_ID),
FOREIGN KEY(class_name) REFERENCES classes(name));

CREATE TABLE tests ( 
test_id INT AUTO_INCREMENT PRIMARY KEY,
test_file_name varchar(255) NOT NULL,
test_file BLOB,
number_of_test_cases INT NOT NULL,
assignment_ID INT NOT NULL,
FOREIGN KEY(assignment_ID) REFERENCES assignments(assignment_ID));

CREATE TABLE submissions (
assignment_ID INT NOT NULL,
directory_ID INT NOT NULL,
score INT,
submission_file BLOB,
FOREIGN KEY(assignment_ID) REFERENCES assignments(assignment_ID),
FOREIGN KEY(directory_ID) REFERENCES students(directory_ID));

/*POPULATING THE DATABASE*/
INSERT INTO STUDENTS VALUES(253754205,"Jerry Sowa","jsowa@umd.edu","amazos2017");
INSERT INTO STUDENTS VALUES(455206187,"Patsy Maggi","pmaggi@umd.edu","amazos2017");
INSERT INTO STUDENTS VALUES(814737379,"Ervin Backer","ebacker@umd.edu","amazos2017");
INSERT INTO STUDENTS VALUES(838595822,"Keesha Faulkner","kfaulkner@umd.edu","amazos2017");
INSERT INTO STUDENTS VALUES(390413872,"Jimmy Downs","jdowns@umd.edu","amazos2017");


INSERT INTO TEACHERS VALUES(244784545,"Wilson Gudino","wgudino@umd.edu","amazos2017");
INSERT INTO TEACHERS VALUES(735808579,"Danae Puls","dpuls@umd.edu","amazos2017");
INSERT INTO TEACHERS VALUES(323692887,"Lydia Stahl","lstahl@umd.edu","amazos2017");
INSERT INTO TEACHERS VALUES(121295124,"Benjamin Briner","bbriner@umd.edu","amazos2017");
INSERT INTO TEACHERS VALUES(736531741,"Cody Hem","chem@umd.edu","amazos2017");


INSERT INTO CLASSES VALUES ("CMSC330", 244784545);
INSERT INTO CLASSES VALUES ("CMSC451", 121295124);
INSERT INTO CLASSES VALUES ("CMSC427", 323692887);
INSERT INTO CLASSES VALUES ("CMSC430", 735808579);
INSERT INTO CLASSES VALUES ("CMSC420", 736531741);


INSERT INTO STUDENT_CLASSES VALUES (253754205,"CMSC330");
INSERT INTO STUDENT_CLASSES VALUES (253754205,"CMSC420");
INSERT INTO STUDENT_CLASSES VALUES (253754205,"CMSC430");
INSERT INTO STUDENT_CLASSES VALUES (455206187,"CMSC330");
INSERT INTO STUDENT_CLASSES VALUES (455206187,"CMSC420");
INSERT INTO STUDENT_CLASSES VALUES (814737379,"CMSC330");
INSERT INTO STUDENT_CLASSES VALUES (814737379,"CMSC427");
INSERT INTO STUDENT_CLASSES VALUES (838595822,"CMSC330");
INSERT INTO STUDENT_CLASSES VALUES (390413872,"CMSC330");
INSERT INTO STUDENT_CLASSES VALUES (390413872,"CMSC420");
INSERT INTO STUDENT_CLASSES VALUES (390413872,"CMSC451");