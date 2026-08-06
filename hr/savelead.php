<?php

    $api_endpoint = "https://qamarhire.com/api/leads/store";

    // Get POST Request

    $cand_name = $_POST['fullname'];
    $mob_no = $_POST['mobile_no'];
    $msgBody = $_POST['msgBody'] ? $_POST['msgBody']: null;
    $company_name = $_POST['company_name'];
    $work_email = $_POST['work_email'];

    $data = [
        'cand_name' => $cand_name,
        'mob_no' => $mob_no,
        'company_name' => $company_name,
        'email' => $work_email,
        'firstRequest' => "1",
        'lead_source' => 'Qamr HR',
        'submit_lead_from' => 'Qamr HR',
        'lead_date' => date("Y-m-d"),
        'message' => $msgBody
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_HTTPHEADER => ['Content-Type: application/json','Accept: application/json'],
        CURLOPT_URL => $api_endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
    ]);

    $response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    header('Content-Type: application/json');

    if ($http_status !== 200) {
        echo json_encode(['error' => 'Form Not Submitted','HTTP_STATUS' => $http_status,'response'  => $response]);
    } else {
        echo $response;
    }

?>