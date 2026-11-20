<?php
/**
 * Helper functions shared by the application.
 */

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function url(string $page = 'lecturers', string $action = 'index', array $params = []): string
{
    $query = array_merge(['page' => $page, 'action' => $action], $params);
    return BASE_URL . '/index.php?' . http_build_query($query);
}

function redirect(string $destination): void
{
    header('Location: ' . $destination);
    exit;
}

function set_flash(string $key, string $message): void
{
    $_SESSION['_flash'][$key] = $message;
}

function get_flash(string $key): ?string
{
    if (!isset($_SESSION['_flash'][$key])) {
        return null;
    }

    $message = $_SESSION['_flash'][$key];
    unset($_SESSION['_flash'][$key]);
    return $message;
}

function csrf_token(): string
{
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_is_valid(): bool
{
    $submitted = $_POST['_csrf_token'] ?? '';
    return is_string($submitted)
        && isset($_SESSION['_csrf_token'])
        && hash_equals($_SESSION['_csrf_token'], $submitted);
}

function valid_date(string $date): bool
{
    $parsed = DateTime::createFromFormat('!Y-m-d', $date);
    return $parsed !== false && $parsed->format('Y-m-d') === $date;
}

function render_view(string $view, array $data = []): void
{
    $viewFile = __DIR__ . '/views/' . $view . '.php';

    if (!is_file($viewFile)) {
        http_response_code(500);
        echo 'View tidak ditemukan.';
        return;
    }

    extract($data, EXTR_SKIP);
    $page = $data['page'] ?? 'lecturers';
    $title = $data['title'] ?? 'Lecturer Management System';

    require __DIR__ . '/views/layouts/header.php';
    require $viewFile;
    require __DIR__ . '/views/layouts/footer.php';
}

function render_not_found(): void
{
    http_response_code(404);
    render_view('errors/404', [
        'page' => 'lecturers',
        'title' => 'Halaman Tidak Ditemukan',
    ]);
}
