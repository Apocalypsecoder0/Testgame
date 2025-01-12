CREATE TABLE armory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    item_type VARCHAR(50) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id)
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