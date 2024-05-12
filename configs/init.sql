CREATE DATABASE sensors;

\c sensors;

CREATE TABLE sensor_data (
    id SERIAL PRIMARY KEY,
    sensor_name VARCHAR(50) NOT NULL,
    value NUMERIC NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);
