<?php

// Custom POST types
include_once (__DIR__ . '/backend/posttypes.php');

// Base app functions
include_once (__DIR__ . '/backend/functions.php');

// Website front & modules
include_once (__DIR__ . '/backend/website.php');

// Admin panel
if (is_admin()) {
    include_once (__DIR__ . '/backend/admin.php');
} 