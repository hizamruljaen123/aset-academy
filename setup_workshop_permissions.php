<?php
// Script untuk menambahkan permission workshop guests ke database
// Jalankan script ini untuk menambahkan permission yang diperlukan

$conn = new mysqli('localhost', 'root', '', 'academy_lite');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

echo "Menambahkan permission untuk Workshop Guests...\n";

// Permission data
$permissions = [
    // Super Admin (level 1)
    ['super_admin', '1', 'admin_workshop_guests', 'view', 1],
    ['super_admin', '1', 'admin_workshop_guests', 'create', 1],
    ['super_admin', '1', 'admin_workshop_guests', 'edit', 1],
    ['super_admin', '1', 'admin_workshop_guests', 'delete', 1],
    ['super_admin', '1', 'admin_workshop_guests', 'export', 1],

    // Admin (level 2)
    ['admin', '2', 'admin_workshop_guests', 'view', 1],
    ['admin', '2', 'admin_workshop_guests', 'create', 1],
    ['admin', '2', 'admin_workshop_guests', 'edit', 1],
    ['admin', '2', 'admin_workshop_guests', 'delete', 1],
    ['admin', '2', 'admin_workshop_guests', 'export', 1],

    // Guru (level 3)
    ['guru', '3', 'admin_workshop_guests', 'view', 1],
    ['guru', '3', 'admin_workshop_guests', 'create', 1],
    ['guru', '3', 'admin_workshop_guests', 'edit', 1],
    ['guru', '3', 'admin_workshop_guests', 'delete', 1],
    ['guru', '3', 'admin_workshop_guests', 'export', 1],
];

$success_count = 0;
$error_count = 0;

foreach ($permissions as $perm) {
    $stmt = $conn->prepare("INSERT INTO user_permissions (role, level, module, action, allowed) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE allowed = VALUES(allowed)");
    $stmt->bind_param("sssss", $perm[0], $perm[1], $perm[2], $perm[3], $perm[4]);

    if ($stmt->execute()) {
        $success_count++;
    } else {
        $error_count++;
        echo "Error adding permission: " . $stmt->error . "\n";
    }
    $stmt->close();
}

echo "\nPermission Summary:\n";
echo "- Success: $success_count permissions added/updated\n";
echo "- Errors: $error_count\n";

if ($success_count > 0) {
    echo "\n✅ Permission untuk Workshop Guests berhasil ditambahkan!\n";
    echo "Sekarang admin dan guru dapat mengakses halaman workshop guests tanpa masalah permission.\n";
}

$conn->close();
?>
