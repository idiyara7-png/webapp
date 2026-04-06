<?php
// api/get_dashboard_data.php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}

$userId = $_SESSION['user_id'];

// Получение статистики
$stmt = $pdo->prepare("SELECT COUNT(*) as total_users FROM users");
$stmt->execute();
$totalUsers = $stmt->fetch()['total_users'];

// Получение проектов пользователя
$stmt = $pdo->prepare("SELECT * FROM user_projects WHERE user_id = ? ORDER BY created_at DESC LIMIT 6");
$stmt->execute([$userId]);
$projects = $stmt->fetchAll();

// Если нет проектов, добавляем демо-данные
if (empty($projects)) {
    $projects = [
        ['name' => 'E-commerce Platform', 'description' => 'Full-stack online store with payment integration', 'status' => 'completed', 'created_at' => '2024-01-15'],
        ['name' => 'Portfolio Dashboard', 'description' => 'Interactive dashboard with analytics', 'status' => 'completed', 'created_at' => '2024-02-01'],
        ['name' => 'Mobile Banking App', 'description' => 'UI/UX design for fintech application', 'status' => 'in_progress', 'created_at' => '2024-03-10'],
        ['name' => 'CRM System', 'description' => 'Customer relationship management platform', 'status' => 'in_progress', 'created_at' => '2024-03-20'],
        ['name' => 'AI Chatbot', 'description' => 'Machine learning powered customer support', 'status' => 'completed', 'created_at' => '2024-02-28']
    ];
}

// Получение активности пользователя
$stmt = $pdo->prepare("SELECT * FROM user_activity WHERE user_id = ? ORDER BY created_at DESC LIMIT 6");
$stmt->execute([$userId]);
$activities = $stmt->fetchAll();

if (empty($activities)) {
    $activities = [
        ['icon' => 'fa-code', 'action' => 'Completed project', 'detail' => 'E-commerce Platform', 'time' => '2 days ago'],
        ['icon' => 'fa-certificate', 'action' => 'Earned certificate', 'detail' => 'Advanced React Development', 'time' => '5 days ago'],
        ['icon' => 'fa-users', 'action' => 'New client', 'detail' => 'TechCorp Solutions', 'time' => '1 week ago']
    ];
}

echo json_encode([
    'success' => true,
    'stats' => [
        'total_users' => $totalUsers,
        'total_projects' => 52,
        'happy_clients' => 28,
        'certificates' => 12,
        'awards' => 8
    ],
    'projects' => $projects,
    'activities' => $activities
]);
?>
