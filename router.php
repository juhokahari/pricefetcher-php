<?php
// This file will act as a router
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|html)$/', $_SERVER["REQUEST_URI"])) {
    return false; // Serve the requested resource as-is.
} else {
    // Redirect to index.html if the root URL is accessed
    include __DIR__ . '/index.html';
}
