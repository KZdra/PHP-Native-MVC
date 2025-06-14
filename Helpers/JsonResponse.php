<?php

function responseJson($data = [], $message = '', $status = 'success', $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data,
        'code' => $code
    ]);
    exit;
}
