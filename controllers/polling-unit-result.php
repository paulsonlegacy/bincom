<?php

$page_title =  "Bincom | Polling Unit Result";
$polling_units = query_fetch("SELECT uniqueid, polling_unit_name FROM polling_unit");
$search = false; $pu_id = null; $pu_results = [];


// Handling incoming post request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $pu_id = intval(sanitize_input($_POST['pu']));

    $sql = <<<SQL
        SELECT 
            party_abbreviation, 
            party_score 
        FROM 
            announced_pu_results 
        WHERE 
            polling_unit_uniqueid = :polling_unit_id;
        SQL;
    $pu_results = query_db($sql, ['polling_unit_id'=> $pu_id]);
    $search = true;
}


// Generating CSRF Token
$csrf_token = generate_csrf_token();


$context = [
    'page_title'=> $page_title,
    'polling_units'=> $polling_units,
    'pu_id'=> $pu_id,
    'search'=> $search,
    'pu_results'=> $pu_results
];

page_view('polling-unit-result', $context);