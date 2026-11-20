<?php

class Lecturer
{
    public function __construct(private mysqli $db) {}

    // No ORDER BY is used to preserve the original query/display order.
    public function getAll(): array
    {
        $result = $this->db->query('SELECT * FROM lecturers');
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM lecturers WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function create(string $name, string $nidn, string $phone, string $joinDate): bool
    {
        $stmt = $this->db->prepare('INSERT INTO lecturers (name, nidn, phone, join_date) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $name, $nidn, $phone, $joinDate);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(int $id, string $name, string $nidn, string $phone, string $joinDate): bool
    {
        $stmt = $this->db->prepare('UPDATE lecturers SET name = ?, nidn = ?, phone = ?, join_date = ? WHERE id = ?');
        $stmt->bind_param('ssssi', $name, $nidn, $phone, $joinDate, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM lecturers WHERE id = ?');
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
