<?php
$ip_address = $_SERVER['REMOTE_ADDR'];
$log_file = '/path/to/access.log';

// Load the access log file
$access_list = [];
if (file_exists($log_file)) {
  $access_list = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Remove log entries older than 1 minute
$access_list = array_filter($access_list, function($line) {
  return time() - intval(substr($line, 0, strpos($line, ','))) <= 60;
});

// Check if the IP address has exceeded the request limit
$requests = array_filter($access_list, function($line) use ($ip_address) {
  return strpos($line, $ip_address . ',') === 0;
});
if (count($requests) > 10) {
  http_response_code(429);
  exit('Too many requests');
}

// Add the current request to the access log
$access_list[] = time() . ',' . $ip_address . ',' . $_SERVER['REQUEST_URI'];
file_put_contents($log_file, implode("\n", $access_list) . "\n");
?>
