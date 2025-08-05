<?php

$page_title =  "Bincom | LGA Total Result";
$lgas = query_fetch("SELECT uniqueid, lga_name FROM lga WHERE state_id = 25");
$search = false; $lga_id = null; $party_results = [];


// Handling incoming post request
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $lga_id = intval(sanitize_input($_POST['lga']));

    $sql = <<<SQL
        SELECT 
            apr.party_abbreviation, 
            SUM(apr.party_score) AS total_score
        FROM 
            polling_unit pu
        JOIN 
            announced_pu_results apr 
            ON pu.uniqueid = apr.polling_unit_uniqueid
        WHERE 
            pu.lga_id = :lga_id
        GROUP BY 
            apr.party_abbreviation;
        SQL;
    $party_results = query_db($sql, ['lga_id'=> $lga_id]);
    $search = true;
}


// Generating CSRF Token
$csrf_token = generate_csrf_token();


$context = [
    'page_title'=> $page_title,
    'lgas'=> $lgas,
    'lga_id'=> $lga_id,
    'search'=> $search,
    'party_results'=> $party_results
];

page_view('lga-total-result', $context);