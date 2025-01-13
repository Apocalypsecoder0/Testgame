CREATE DATABASE game_db;

USE game_db;
-- Create the necessary tables for the game database

CREATE DATABASE IF NOT EXISTS game_db;
USE game_db;

UPDATE users SET name = ?, bio = ? WHERE user_id = ?;

SELECT * FROM users WHERE username = ? OR email = ?;
UPDATE users SET username = ?, email = ?, password = ? WHERE user_id = ?;
UPDATE users SET email_notifications = ?, sms_notifications = ? WHERE user_id = ?;
UPDATE users SET profile_visibility = ?, data_sharing = ? WHERE user_id = ?;
UPDATE users SET password = ? WHERE user_id = ?;

CREATE TABLE universes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE galaxies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE systems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    galaxy_id INT,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (galaxy_id) REFERENCES galaxies(id)
);

CREATE TABLE planets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    system_id INT,
    name VARCHAR(255) NOT NULL,
    metal INT NOT NULL,
    crystal INT NOT NULL,
    deuterium INT NOT NULL,
    status ENUM('Unoccupied', 'Occupied', 'Under Attack') NOT NULL,
    FOREIGN KEY (system_id) REFERENCES systems(id)
);
CREATE TABLE bug_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL, -- Assuming you have a users table
    error_message TEXT NOT NULL,
    error_file VARCHAR(255) NOT NULL,
    error_line INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('open', 'resolved') DEFAULT 'open'
);-- Create the database
CREATE DATABASE IF NOT EXISTS empires_db;

-- Use the database
-- USE empires_db;

-- Create the empires table
CREATE TABLE IF NOT EXISTS empires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    class VARCHAR(50) NOT NULL
);

-- Insert data into the empires table
INSERT INTO empires (name, class) VALUES
('Empire A', 'Class 1'),
('Empire B', 'Class 2'),
('Empire C', 'Class 3'),
('Empire D', 'Class 4');
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    ALTER TABLE users ADD COLUMN email VARCHAR(255) NOT NULL;
ALTER TABLE users ADD COLUMN abilities TEXT NOT NULL;
ALTER TABLE users ADD COLUMN role ENUM('user', 'admin', 'moderator') DEFAULT 'user';
    race VARCHAR(255) NOT NULL
);
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL
);
-- Insert roles
INSERT INTO roles (name) VALUES ('admin'), ('moderator'), ('user');

-- Insert permissions
INSERT INTO permissions (name) VALUES 
('manage_users'), 
('manage_content'), 
('view_profile'), 
('update_profile');

-- Assign permissions to roles
INSERT INTO role_permissions (role_id, permission_id) VALUES 
(1, 1), -- Admin can manage users
(1, 2), -- Admin can manage content
(1, 3), -- Admin can view profiles
(1, 4), -- Admin can update profiles
(2, 2), -- Moderator can manage content
(2, 3), -- Moderator can view profiles
(3, 3), -- User can view their own profile
(3, 4); -- User can update their own profile

CREATE TABLE role_permissions (
    role_id INT,
    permission_id INT,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id)
);
CREATE TABLE armory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    item_type VARCHAR(50) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE party_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    party_id INT,
    FOREIGN KEY (party_id) REFERENCES parties(id)
);
INSERT INTO party_members (name, party_id) VALUES ('John Doe', 1);
CREATE TABLE parties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
CREATE TABLE alliances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE alliance_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alliance_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (alliance_id) REFERENCES alliances(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    UNIQUE (alliance_id, user_id)  -- Prevent duplicate memberships
);
CREATE TABLE guilds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    leader_id INT NOT NULL,
    FOREIGN KEY (leader_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE guild_members (
    guild_id INT NOT NULL,
    member_id INT NOT NULL,
    PRIMARY KEY (guild_id, member_id),
    FOREIGN KEY (guild_id) REFERENCES guilds(id) ON DELETE CASCADE,
    FOREIGN KEY (member_id) REFERENCES users(id) ON DELETE CASCADE
);
CREATE TABLE players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    health INT NOT NULL DEFAULT 100,
    attack_power INT NOT NULL DEFAULT 10,
    defense INT NOT NULL DEFAULT 5,
    experience INT NOT NULL DEFAULT 0,
    level INT NOT NULL DEFAULT 1
);
CREATE TABLE command_centers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    level INT NOT NULL DEFAULT 1,
    resources INT NOT NULL DEFAULT 100,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE upgrades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level INT NOT NULL,
    cost INT NOT NULL,
    resource_increase INT NOT NULL
);
INSERT INTO upgrades (level, cost, resource_increase) VALUES
(1, 50, 20),
(2, 100, 50),
(3, 200, 100);
CREATE TABLE intelligence_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    report_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    report_content TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
INSERT INTO intelligence_reports (user_id, report_content) VALUES
(1, 'Enemy forces spotted near the northern border.'),
(1, 'Resource production has increased by 20%.'),
(2, 'New technology discovered: Advanced Weaponry.'),
(1, 'Scout reports indicate a weak point in enemy defenses.');

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL
);

CREATE TABLE player_inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (item_id) REFERENCES items(id)
);

CREATE TABLE trades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    buyer_id INT NOT NULL,
    seller_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    trade_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer_id) REFERENCES users(id),
    FOREIGN KEY (seller_id) REFERENCES users(id),
    FOREIGN KEY (item_id) REFERENCES items(id)
);
INSERT INTO items (name, price) VALUES
('Wood', 10),
('Stone', 15),
('Iron', 25),
('Gold', 50);
CREATE TABLE research_projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    cost INT NOT NULL,
    duration INT NOT NULL,  -- Duration in seconds
    description TEXT
);

CREATE TABLE player_research (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    project_id INT NOT NULL,
    start_time DATETIME,
    status ENUM('in_progress', 'completed') DEFAULT 'in_progress',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (project_id) REFERENCES research_projects(id)
);
INSERT INTO research_projects (name, cost, duration, description) VALUES
('Basic Farming', 100, 60, 'Unlocks basic farming techniques.'),
('Advanced Mining', 200, 120, 'Unlocks advanced mining techniques.'),
('Weapon Upgrades', 300, 180, 'Unlocks upgrades for weapons.');

CREATE TABLE technologies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    prerequisites TEXT,  -- Comma-separated list of technology IDs
    is_unlocked BOOLEAN DEFAULT FALSE
);

CREATE TABLE player_technologies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    technology_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (technology_id) REFERENCES technologies(id)
);CREATE TABLE New_Technologies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50),
    technology VARCHAR(100),
    description TEXT
);

INSERT INTO New_Technologies (category, technology, description) VALUES
('Basic Research', 'Energy Technology', 'Innovations in energy storage and efficiency.'),
('Basic Research', 'Laser Technology', 'Applications in data transmission and security.'),
('Basic Research', 'Ion Technology', 'Potential for advanced propulsion systems.'),
('Basic Research', 'Hyperspace Technology', 'Theoretical frameworks for faster-than-light travel.'),
('Basic Research', 'Plasma Technology', 'Uses in energy generation and materials science.'),
('Drive Research', 'Combustion Drive', 'Traditional propulsion systems for vehicles.'),
('Drive Research', 'Impulse Drive', 'Concepts for near-light-speed travel.'),
('Drive Research', 'Hyperspace Drive', 'Theoretical technologies for interstellar travel.'),
('Advanced Research', 'Espionage Technology', 'Tools for data gathering and cybersecurity.'),
('Advanced Research', 'Computer Technology', 'Advances in processing power and AI.'),
('Advanced Research', 'Astrophysics', 'Research on celestial phenomena and their implications.'),
('Advanced Research', 'Intergalactic Research Network', 'Collaborative platforms for space research.'),
('Advanced Research', 'Graviton Technology', 'Theoretical exploration of gravity manipulation.'),
('Combat Research', 'Weapons Technology', 'Development of advanced weapon systems.'),
('Combat Research', 'Shielding Technology', 'Innovations in protective measures.'),
('Combat Research', 'Armour Technology', 'Enhancements in materials for defense.');
INSERT INTO technologies (name, description, prerequisites) VALUES
('Basic Farming', 'Unlocks basic farming techniques.', ''),
('Advanced Farming', 'Unlocks advanced farming techniques.', '1'),  -- Prerequisite: Basic Farming
('Basic Mining', 'Unlocks basic mining techniques.', ''),
('Advanced Mining', 'Unlocks advanced mining techniques.', '3');  -- Prerequisite: Basic Mining
CREATE TABLE troop_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    cost INT NOT NULL,  -- Cost in resources
    training_time INT NOT NULL  -- Training time in seconds
);

CREATE TABLE training_queue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    troop_type_id INT NOT NULL,
    quantity INT NOT NULL,
    start_time DATETIME,
    status ENUM('in_progress', 'completed') DEFAULT 'in_progress',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (troop_type_id) REFERENCES troop_types(id)
);
CREATE TABLE fleets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_id INT,
    ship_type VARCHAR(50),
    quantity INT,
    attack_power INT,
    defense_points INT
);
CREATE TABLE player_resources (
    user_id INT PRIMARY KEY,
    resources INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
INSERT INTO troop_types (name, cost, training_time) VALUES
('Infantry', 50, 30),  -- 50 resources, 30 seconds training time
('Archers', 70, 45),   -- 70 resources, 45 seconds training time
('Cavalry', 100, 60);  -- 100 resources, 60 seconds training time
CREATE TABLE game_updates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO game_updates (title, content) VALUES
('Version 1.1 Released', 'We are excited to announce the release of version 1.1, which includes new features and bug fixes.'),
('New Event: Winter Festival', 'Join us for the Winter Festival event starting next week! Earn exclusive rewards!'),
('Bug Fixes', 'We have fixed several bugs reported by players. Thank you for your feedback!');

ALTER TABLE users ADD COLUMN reset_token VARCHAR(255) DEFAULT NULL;
ALTER TABLE users ADD COLUMN token_expires DATETIME DEFAULT NULL;

CREATE TABLE password_reset_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    attempt_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('success', 'failure') NOT NULL
);

-- Users table
CREATE TABLE IF NOT EXISTS users (
    uid INT AUTO_INCREMENT PRIMARY KEY,
    uname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    onHand DECIMAL(10, 2) DEFAULT 0,
    inBank DECIMAL(10, 2) DEFAULT 0,
    capacity DECIMAL(10, 2) DEFAULT 1000
);

-- Training costs table
CREATE TABLE IF NOT EXISTS training_costs (
    attackCost DECIMAL(10, 2),
    superAttackCost DECIMAL(10, 2),
    defenseCost DECIMAL(10, 2),
    superDefenseCost DECIMAL(10, 2),
    covertCost DECIMAL(10, 2),
    superCovertCost DECIMAL(10, 2),
    anticovertCost DECIMAL(10, 2),
    superAnticovertCost DECIMAL(10, 2)
);

-- Weapons table
CREATE TABLE IF NOT EXISTS weapons (
    wid INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    strength INT,
    quantity INT,
    FOREIGN KEY (uid) REFERENCES users(uid)
);

-- Armory table
CREATE TABLE IF NOT EXISTS armory (
    wid INT PRIMARY KEY,
    weaponName VARCHAR(255),
    weaponPower INT,
    cash_cost DECIMAL(10, 2),
    isDefense BOOLEAN
);
CREATE TABLE troops (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    experience INT DEFAULT 0
);
SET @training_hours = 5;

UPDATE troops
SET experience = experience + (@training_hours * 10)
WHERE id IN (SELECT troop_id FROM training_sessions WHERE hours = @training_hours);

INSERT INTO training_sessions (troop_id, hours, experience_gained)
SELECT id, @training_hours, (@training_hours * 10) FROM troops;
CREATE TABLE training_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    troop_id INT,
    hours INT,
    experience_gained INT,
    FOREIGN KEY (troop_id) REFERENCES troops(id)
);
INSERT INTO troops (name) VALUES ('Alpha'), ('Bravo');
SELECT name, experience FROM troops;
-- Bank table
CREATE TABLE IF NOT EXISTS bank (
    uid INT PRIMARY KEY,
    onHand DECIMAL(10, 2),
    FOREIGN KEY (uid) REFERENCES users(uid)
);

-- Game actions table
CREATE TABLE IF NOT EXISTS game_actions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action_type ENUM('attack', 'raid', 'spy') NOT NULL,
    target_id INT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Action logs table
CREATE TABLE IF NOT EXISTS action_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action_type ENUM('attack', 'raid', 'spy', 'sab') NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(uid)
);

-- Military effectiveness table
CREATE TABLE IF NOT EXISTS military_effectiveness (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    mil_atk INT NOT NULL,
    mil_atk_rank INT NOT NULL,
    mil_def INT NOT NULL,
    mil_def_rank INT NOT NULL,
    mil_cov INT NOT NULL,
    mil_cov_rank INT NOT NULL,
    mil_anti INT NOT NULL,
    mil_anti_rank INT NOT NULL,
    mil_total INT NOT NULL,
    mil_rank INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(uid)
);

-- Personnel table
CREATE TABLE IF NOT EXISTS personnel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    attackName VARCHAR(255),
    attackCount INT DEFAULT 0,
    superAttackName VARCHAR(255),
    superAttackCount INT DEFAULT 0,
    attackMercName VARCHAR(255),
    attackMercCount INT DEFAULT 0,
    defenseName VARCHAR(255),
    defenseCount INT DEFAULT 0,
    superDefenseName VARCHAR(255),
    superDefenseCount INT DEFAULT 0,
    defenseMercName VARCHAR(255),
    defenseMercCount INT DEFAULT 0,
    uuCount INT DEFAULT 0,
    minerCount INT DEFAULT 0,
    liferCount INT DEFAULT 0,
    covertName VARCHAR(255),
    covertCount INT DEFAULT 0,
    superCovertName VARCHAR(255),
    superCovertCount INT DEFAULT 0,
    anticovertName VARCHAR(255),
    anticovertCount INT DEFAULT 0,
    superAnticovertName VARCHAR(255),
    superAnticovertCount INT DEFAULT 0,
    ttlarmysize INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(uid)
);

-- Progress table
CREATE TABLE IF NOT EXISTS progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    done INT NOT NULL,
    total INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Alliances table
CREATE TABLE IF NOT EXISTS alliances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    url VARCHAR(255),
    allow_new_members TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(uid) ON DELETE CASCADE
);
CREATE TABLE buildings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    level INT NOT NULL,
    cost JSON NOT NULL,
    build_time INT NOT NULL
);

INSERT INTO buildings (name, level, cost, build_time) VALUES
('Quantum Reactor', 1, '{"resource": 1000, "energy": 500}', 60),
('Stellar Forge', 1, '{"resource": 1500, "energy": 700}', 120),
('Galactic Observatory', 1, '{"resource": 2000, "energy": 900}', 180),
('Warp Drive Facility', 1, '{"resource": 2500, "energy": 1100}', 240),
('Terraforming Station', 1, '{"resource": 3000, "energy": 1300}', 300),
('Defense Matrix', 1, '{"resource": 3500, "energy": 1500}', 360),
('Resource Synthesizer', 1, '{"resource": 4000, "energy": 1700}', 420),
('Cryo Storage', 1, '{"resource": 4500, "energy": 1900}', 480),
('Interstellar Dock', 1, '{"resource": 5000, "energy": 2100}', 540),
('Nano Assembly Plant', 1, '{"resource": 5500, "energy": 2300}', 600);

CREATE TABLE buildings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    level INT NOT NULL,
    cost JSON NOT NULL,
    build_time INT NOT NULL
);

INSERT INTO buildings (name, level, cost, build_time) VALUES
('Quantum Reactor', 1, '{"resource": 1000, "energy": 500}', 60),
('Stellar Forge', 1, '{"resource": 1500, "energy": 700}', 120),
('Galactic Observatory', 1, '{"resource": 2000, "energy": 900}', 180),
('Warp Drive Facility', 1, '{"resource": 2500, "energy": 1100}', 240),
('Terraforming Station', 1, '{"resource": 3000, "energy": 1300}', 300),
('Defense Matrix', 1, '{"resource": 3500, "energy": 1500}', 360),
('Resource Synthesizer', 1, '{"resource": 4000, "energy": 1700}', 420),
('Cryo Storage', 1, '{"resource": 4500, "energy": 1900}', 480),
('Interstellar Dock', 1, '{"resource": 5000, "energy": 2100}', 540),
('Nano Assembly Plant', 1, '{"resource": 5500, "energy": 2300}', 600);CREATE TABLE upgrades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    station_name VARCHAR(255) NOT NULL,
    level INT NOT NULL,
    cost JSON NOT NULL,
    build_time INT NOT NULL
);

INSERT INTO upgrades (station_name, level, cost, build_time) VALUES
('Terraforming Station', ?, ?, ?),
('Defense Matrix', ?, ?, ?),
('Resource Synthesizer', ?, ?, ?),
('Cryo Storage', ?, ?, ?),
('Interstellar Dock', ?, ?, ?),
('Nano Assembly Plan', ?, ?, ?);
};
