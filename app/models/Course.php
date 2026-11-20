<?php

class Course
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    // No ORDER BY: no new ascending/descending sorting is imposed.
    public function getAll(): array
    {
        $sql = "SELECT courses.*, lecturers.name AS lecturer_name
                FROM courses
                INNER JOIN lecturers ON courses.lecturer_id = lecturers.id";
        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function create(int $lecturerId, string $code, string $name, int $credits, string $semester): bool
    {
        $stmt = $this->db->prepare("INSERT INTO courses (lecturer_id, course_code, course_name, credits, semester) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $lecturerId, $code, $name, $credits, $semester);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(int $id, int $lecturerId, string $code, string $name, int $credits, string $semester): bool
    {
        $stmt = $this->db->prepare("UPDATE courses SET lecturer_id = ?, course_code = ?, course_name = ?, credits = ?, semester = ? WHERE id = ?");
        $stmt->bind_param("issisi", $lecturerId, $code, $name, $credits, $semester, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM courses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
