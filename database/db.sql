CREATE DATABASE exam_sharing_db;

USE exam_sharing_db;

CREATE TABLE roles(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(10) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

/* set default roles */
INSERT INTO
    roles (name)
VALUES
    ('admin'),
    ('teacher'),
    ('student');

CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role_id INT NOT NULL,
    password VARCHAR(255) NOT NULL,
    registered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE RESTRICT ON UPDATE CASCADE
);

/* set default admin account */
INSERT INTO
    users (firstname, lastname, email, role_id, password)
VALUES
    (
        'Admin',
        'Administrator',
        'admin@examsharing.com',
        1,
        sha1('adminexam123')
    );

CREATE TABLE schools(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    school_index VARCHAR(20) NOT NULL UNIQUE,
    school_name VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE classes(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(40) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

/* set dafault classes */
INSERT INTO
    classes (class_name)
VALUES
    ('Form I'),
    ('Form II'),
    ('Form III'),
    ('Form IV'),
    ('Form V'),
    ('Form VI');

CREATE TABLE teachers(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    school_id INT NOT NULL,
    class_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (school_id) REFERENCES schools (id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes (id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE subjects(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(30) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE exams(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    exam_name TEXT NOT NULL,
    exam_doc VARCHAR(300) NOT NULL,
    marking_scheme VARCHAR(300) NULL,
    subject_id INT NOT NULL,
    uploaded_by INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);