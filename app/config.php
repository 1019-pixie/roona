<?php
$host = $_SERVER['HTTP_HOST'];

if (strpos($host, 'localhost') !== false) {
  $base_url = 'http://' . $host;
} else {
  $base_url = 'https://' . $host . '/';
}
// ?: ternary operator (cek apakah variabel not false, null, 0, "", or an empty array)
return [
    'db_driver' => getenv('DB_DRIVER') ?: 'mysql',
    'db_host' => getenv('DB_HOST') ?: '127.0.0.1',
    'db_port' => getenv('DB_PORT') ?: 3306,
    'db_sslmode' => getenv('DB_SSLMODE') ?: 'disable', // `require` untuk supabase
    'db_name' => getenv('DB_NAME') ?: 'roona',
    'db_user' => getenv('DB_USER') ?: 'root',
    'db_pass' => getenv('DB_PASS') ?: '',
    'base_url' => $base_url ?: '/roona/public'
];