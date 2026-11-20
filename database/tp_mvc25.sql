CREATE DATABASE IF NOT EXISTS tp_mvc25 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tp_mvc25;

CREATE TABLE IF NOT EXISTS lecturers (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nidn VARCHAR(30) NOT NULL UNIQUE,
    phone VARCHAR(25) NOT NULL,
    join_date DATE NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS classes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lecturer_id INT UNSIGNED NOT NULL,
    class_code VARCHAR(20) NOT NULL UNIQUE,
    class_name VARCHAR(100) NOT NULL,
    credits TINYINT UNSIGNED NOT NULL,
    semester VARCHAR(40) NOT NULL,
    CONSTRAINT fk_classes_lecturers FOREIGN KEY (lecturer_id)
      REFERENCES lecturers(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Optional sample data. Remove these INSERT statements if importing into a database
-- that already contains the same records.
INSERT IGNORE INTO lecturers (name, nidn, phone, join_date) VALUES
('Ilya Petrov, M.Kom', '0011223344', '081234567890', '2020-08-01'),
('Ahmad Khalish, M.Kom', '0022334455', '081298765432', '2021-02-15');

INSERT IGNORE INTO classes (lecturer_id, class_code, class_name, credits, semester) VALUES
(1, 'IF101', 'Algoritma dan Pemrograman', 3, 'Ganjil 2026/2027'),
(1, 'IF102', 'Struktur Data', 3, 'Genap 2026/2027'),
(2, 'IF103', 'DPBO', 3, 'Ganjil 2026/2027');
