<?php

    $api_endpoint = "https://qamarhire.com/api/leads/store";

    // Get POST Request

    $cand_name = $_POST['fullname'];
    $mob_no = $_POST['mobile_no'];
    $whatsapp_no = $_POST['whatsapp_no'];
    $msgBody = $_POST['msgBody'] ? $_POST['msgBody']: null;
    $company_name = $_POST['company_name'];
    $work_email = $_POST['work_email'];
    $no_of_requirement = $_POST['no_of_requirement'];
    $ip = getClientIp();

    $data = [
        'cand_name' => $cand_name,
        'mob_no' => $mob_no,
        'whatsapp_no' => $whatsapp_no,
        'company_name' => $company_name,
        'email' => $work_email,
        'no_of_requirement' => $no_of_requirement,
        'firstRequest' => "1",
        'lead_source' => 'Qamr HR',
        'submit_lead_from' => 'Qamr HR',
        'lead_date' => date("Y-m-d"),
        'message' => $msgBody,
        'ip_address' => $ip
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


    function getClientIp() {
        $headers = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR'
        ];

        foreach ($headers as $key) {
            if (!empty($_SERVER[$key])) {
                // can have multiple IPs (comma separated)
                $ips = explode(',', $_SERVER[$key]);
                foreach ($ips as $ip) {
                    $ip = trim($ip);
                    // validate only public IP (no local)
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                        return $ip;
                    }
                }
            }
        }

        // fallback
        return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    }

?>