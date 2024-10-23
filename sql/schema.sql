CREATE TABLE IF NOT EXISTS toy_resellers (
    toy_reseller_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    gender VARCHAR(50),
    age VARCHAR(50),
    date_of_birth VARCHAR(50),
    location TEXT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS toys (
    toy_id INT AUTO_INCREMENT PRIMARY KEY,
    toy_name VARCHAR(50),
    toy_type TEXT,
    toy_reseller_id INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (toy_reseller_id) REFERENCES toy_resellers(toy_reseller_id)
);