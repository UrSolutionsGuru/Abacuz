<?php
if (!isset($_GET['foo'])) {
        // Client
        //$ch = curl_init('http://localhost:8080/receive.php?foo=bar');
	$ch = curl_init('https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=eyJhbGciOiJSUzI1NiIsImtpZCI6ImQ3YThiNzVmMmE2NWQ4Yjc4MDMzZjI5ZmUyNjZhYmVhODU5MWE2YzYifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiYXRfaGFzaCI6IlJvTFZ0YkhCN0hHMGtPMGJmaERQSGciLCJhdWQiOiI2NDA5MTE5NzE5NDYtcDRpZWJ2a2w0M3Q0M29ndHM5ZzkwaXVuMGdlcmEzMTcuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJzdWIiOiIxMTEzNDA1Mjg2NDU3NDEzNzgzNzkiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiYXpwIjoiNjQwOTExOTcxOTQ2LXA0aWVidmtsNDN0NDNvZ3RzOWc5MGl1bjBnZXJhMzE3LmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJnYXJ5ZGFjY2FydGVyQGdtYWlsLmNvbSIsImlhdCI6MTQzOTU3ODAyMCwiZXhwIjoxNDM5NTgxNjIwLCJuYW1lIjoiR2FyeSBDYXJ0ZXIiLCJwaWN0dXJlIjoiaHR0cHM6Ly9saDUuZ29vZ2xldXNlcmNvbnRlbnQuY29tLy1NaWpPdEFwekpTay9BQUFBQUFBQUFBSS9BQUFBQUFBQUFIcy9nTS1SZHNWbFVncy9zOTYtYy9waG90by5qcGciLCJnaXZlbl9uYW1lIjoiR2FyeSIsImZhbWlseV9uYW1lIjoiQ2FydGVyIiwibG9jYWxlIjoiZW4tR0IifQ.DetuXGfiCVSMyPFuJJljUA7WTNPJ8vkFJdUECaZfSUZT5rLLy60uYFA97TocH3ysdzgQDGODTmDg_5p5lB3hGABwJoOcV_FPEH3k8WAF9FK0GRNACuFhVLoe00Ynf9-uE5edf3CqT-Bn1GB51-Fn9jj1u9Q1VPz80WdEzJRDlObM2o8D8Gf2UINzW4cIHabFFMafMcUEWwdxCcgLTKJzg9Q7NVkDMtvRrVYDRMfbKMXZCbIrMTc5405Or3YXghvOVcioVxfVwXscuiJVGu3YX9CEsq2s8aN83g1o-lYYTDTOcePavwwfb-oyWJFVL7E6TtUy5EjQAiBZNOcH4cCfHQ');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2000);
        $data = curl_exec($ch);
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_errno > 0) {
                echo "cURL Error ($curl_errno): $curl_error\n";
        } else {
                echo "Data received: $data\n";
        }
} else {
        // Server
        sleep(10);
        echo "Done.";
}

$obj = json_decode($data);
print $obj->{'name'}; 

?>