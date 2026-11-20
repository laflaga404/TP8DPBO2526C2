<?php

class SchoolClass
{
    public function __construct(private mysqli $db) {}

    // No ORDER BY is used; rows follow the database's default result order.
    public function getAll(): array
    {
        $sql = 'SELECT classes.*, lecturers.name AS lecturer_name FROM classes INNER JOIN lecturers ON classes.lecturer_id = lecturers.id';
        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM classes WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function create(int $lecturerId, string $code, string $name, int $credits, string $semester): bool
    {
        $stmt = $this->db->prepare('INSERT INTO classes (lecturer_id, class_code, class_name, credits, semester) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('issis', $lecturerId, $code, $name, $credits, $semester);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(int $id, int $lecturerId, string $code, string $name, int $credits, string $semester): bool
    {
        $stmt = $this->db->prepare('UPDATE classes SET lecturer_id = ?, class_code = ?, class_name = ?, credits = ?, semester = ? WHERE id = ?');
        $stmt->bind_param('issisi', $lecturerId, $code, $name, $credits, $semester, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM classes WHERE id = ?');
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
