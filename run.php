<?php
// Connect to the SQLite database
$conn = new PDO('sqlite:file:secret.db?mode=rwc');
$table = "CREATE TABLE IF NOT EXISTS `whitelist` (
    `email` text NOT NULL,
    `link` longtext NOT NULL
) ";
$conn->exec($table);

// Fetch all data from the whitelist table
$SQL = "SELECT * FROM whitelist";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set the headers for the Excel file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="whitelist.csv"');

// Output the data as CSV directly to the browser
$fp = fopen('php://output', 'w');
fputcsv($fp, array('Email', 'Link'), ';');

foreach ($result as $item) {
    fputcsv($fp, array($item['email'], $item['link']), ';');
}

fclose($fp);
?>
