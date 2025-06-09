
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS avis;
DROP TABLE IF EXISTS search_history;
DROP TABLE IF EXISTS quiz_results;
DROP TABLE IF EXISTS propose;
DROP TABLE IF EXISTS fields;
DROP TABLE IF EXISTS universities;
DROP TABLE IF EXISTS users;


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE universities (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150),
    description TEXT,
    history TEXT,
    location VARCHAR(100),
    tuition_fee DECIMAL(10,2),
    note FLOAT DEFAULT 0,
    media_url VARCHAR(255),
    application_link VARCHAR(255),
    pdf_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE fields (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE propose (
    university_id INT,
    field_id INT,
    PRIMARY KEY (university_id, field_id),
    FOREIGN KEY (university_id) REFERENCES universities(id) ON DELETE CASCADE,
    FOREIGN KEY (field_id) REFERENCES fields(id) ON DELETE CASCADE
);


-- CREATE TABLE quiz_results (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     user_id INT,
--     recommended_field TEXT,
--     recommended_university TEXT,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
-- );


-- CREATE TABLE search_history (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     user_id INT,
--     rating INT,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
-- );


CREATE TABLE avis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    university_id INT,
    commentaire TEXT,
    note FLOAT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (university_id) REFERENCES universities(id) ON DELETE CASCADE
);


CREATE TABLE favorites (
    user_id INT,
    university_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, university_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (university_id) REFERENCES universities(id) ON DELETE CASCADE
);
