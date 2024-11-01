CREATE TABLE coachTable (
    coach_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    coach_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    experience INT NOT NULL,
    specialization VARCHAR(100) NOT NULL,
    website_url VARCHAR(100),
    date_added DATE NOT NULL
);

CREATE TABLE playerTable (
    player_id INT PRIMARY KEY AUTO_INCREMENT,
    player_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    preferred_game VARCHAR(100) NOT NULL,
    coach_id INT,
    date_added DATE NOT NULL,
    FOREIGN KEY (coach_id) REFERENCES coachTable(coach_id)
);


