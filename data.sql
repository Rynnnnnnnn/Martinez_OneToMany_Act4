CREATE TABLE customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR (50),
    last_name VARCHAR (50),
    email VARCHAR (50),
    purpose TEXT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE virtual_pc (
    pc_id INT AUTO_INCREMENT PRIMARY KEY,
    pc_name VARCHAR (50),
    pc_specs TEXT,
    customer_id INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
