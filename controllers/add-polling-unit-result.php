<?php

$page_title =  "Bincom | Add Polling Unit Result";
$polling_units = query_fetch("SELECT uniqueid, polling_unit_name FROM polling_unit");


// Handling incoming post request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $data = [
        'polling_unit_uniqueid' => intval(sanitize_input($_POST['polling_unit'])),
        'party_abbreviation' => sanitize_input($_POST['party_abbreviation']),
        'party_score' => intval(sanitize_input($_POST['party_score'])),
        'entered_by_user' => sanitize_input($_POST['user']),
        'date_entered' => date('Y-m-d H:i:s'),
        'user_ip_address' => $_SERVER['REMOTE_ADDR'],
    ];

    try {
        $sql = <<<SQL
            INSERT INTO announced_pu_results
                (polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address)
            VALUES
                (:polling_unit_uniqueid, :party_abbreviation, :party_score, :entered_by_user, :date_entered, :user_ip_address)
            SQL;
        query_db($sql, $data);
        redirect("add-polling-unit-result", "Result successfully added!", "success");
    } catch (Exception $e) {
        redirect("add-polling-unit-result", "An error occured: $e", "danger");
    }
}


// Generating CSRF Token
$csrf_token = generate_csrf_token();


$context = [
    'page_title'=> $page_title,
    'polling_units'=> $polling_units,
];

page_view('add-polling-unit-result', $context);