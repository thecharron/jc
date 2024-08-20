<?php
// Define the payload as an associative array
$payload = [
    '4k' => false,
    'ageGroup' => '18+',
    'appVersion' => '3.4.0',
    'bitrateProfile' => 'xhdpi',
    'capability' => [
        'drmCapability' => [
            'aesSupport' => 'yes',
            'fairPlayDrmSupport' => 'yes',
            'playreadyDrmSupport' => 'none',
            'widevineDRMSupport' => 'yes',
        ],
        'frameRateCapability' => [
            [
                'frameRateSupport' => '30fps',
                'videoQuality' => '1440p',
            ],
        ],
    ],
    'continueWatchingRequired' => true,
    'dolby' => false,
    'downloadRequest' => false,
    'hevc' => false,
    'kidsSafe' => false,
    'manufacturer' => 'Linux',
    'model' => 'Linux',
    'multiAudioRequired' => true,
    'osVersion' => 'x86_64',
    'parentalPinValid' => true,
    'x-apisignatures' => 'o668nxgzwff',
];

// Convert the payload to JSON
$json_payload = json_encode($payload);

// API URL
$url = "https://apis-jiovoot.voot.com/playbackjv/v5/3479312";

// Headers
$user_agent = 'Mozilla/5.0 (Linux; Android 10; BRAVIA 4K VH2 Build/QTG3.200305.006.S292; wv)';
$headers = [
    'authority: apis-jiovoot.voot.com',
    'accept: application/json, text/plain, */*',
    'accept-language: en-GB,en-US;q=0.9,en;q=0.8',
    'accesstoken: eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7InVzZXJJZCI6IjliMjAyZDRhLWY5NmUtNGI3YS1hYTEyLTcyMzAxYTRiNjQ5NyIsInVzZXJUeXBlIjoiR1VFU1QiLCJhcHBOYW1lIjoiUkpJTF9KaW9DaW5lbWEiLCJkZXZpY2VJZCI6ImFlMmQ0NzU2LWEyZjctNDcyMy1jZDc5LTgzNTE3NDI2OWVmMCIsImRldmljZVR5cGUiOiJwYyIsIm9zIjoid2ViIiwicHJvZmlsZUlkIjoiNGI5ZDY5ZjktY2MyYi0xMjQ3LTI0NDItNjJhNGIwOGQ0Y2IyIiwiYWRJZCI6ImFlMmQ0NzU2LWEyZjctNDcyMy1jZDc5LTgzNTE3NDI2OWVmMCIsImV4cGVyaW1lbnRLZXkiOnsiY29uZmlnS2V5IjoiNGI5ZDY5ZjktY2MyYi0xMjQ3LTI0NDItNjJhNGIwOGQ0Y2IyIiwiZ3JvdXBJZCI6MjI4Nn0sInByb2ZpbGVEZXRhaWxzIjp7InByb2ZpbGVUeXBlIjoiYWR1bHQiLCJjb250ZW50QWdlUmF0aW5nIjoiQSJ9LCJ2ZXJzaW9uIjoyMDI0MDMwNDB9LCJleHAiOjE3MjYyMzQ0OTcsImlhdCI6MTcyMzY0MjQ5N30.0szYuRB-DwGbsmhdt4xJwMgu9r_swCc8QjE9HV4LEXrILnR1MdzIzR0Vl6_k6HcgA_J7ZyEvmLOcvlnPS7xzog',
    'appname: RJIL_JioCinema',
    'content-type: application/json',
    'deviceid: 7c292c7d-0725-4e30-a01e-25e44efc6160',
    'origin: https://www.jiocinema.com',
    'referer: https://www.jiocinema.com/',
    'sec-ch-ua: "Chromium";v="111", "Not(A:Brand";v="8"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Linux"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: cross-site',
    'uniqueid: 30ce8d99-12c3-41f7-aa81-e62fab71297a',
    'user-agent: ' . $user_agent,
    'versioncode: 2404232',
    'x-apisignatures: o668nxgzwff',
    'x-platform: androidtv',
    'x-platform-token: androidtv',
];

// Initialize cURL session
$ch = curl_init($url);

// Set the cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the cURL request and get the response
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Initialize output array
$output = [];

// Check if the response is not empty
if ($response) {
    // Decode the JSON response
    $response_data = json_decode($response, true);

    // Attempt to extract M3U8 URL
    $mpd_url = $response_data['data']['playbackUrls'][0]['url'] ?? null;

    if ($mpd_url) {
        // Initialize a new cURL session for the redirection
        $ch = curl_init($mpd_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

        // Extract headers
        $header_response = curl_exec($ch);
        curl_close($ch);

        // Grab cookie
        if (preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header_response, $matches)) {
            $cookie = implode('; ', $matches[1]);

            // Extract the hdntl part of the cookie
            if (preg_match('/hdntl=([^;]*)/', $cookie, $match)) {
                $hdntl = $match[1];

                // Parse the expiry time from the hdntl string
                if (preg_match('/exp=(\d+)/', $hdntl, $exp_match)) {
                    $expiry_time = $exp_match[1];

                    // Convert the expiry time to IST
                    $expiry_time_ist = gmdate("Y-m-d H:i:s", $expiry_time + 19800); // 19800 seconds = 5 hours 30 minutes

                    // Prepare the output
                    $output = [
                        "cookies" => "hdntl=" . $hdntl,
                        "user_agent" => $user_agent,
                        "expiry_time_ist" => $expiry_time_ist
                    ];
                } else {
                    $output = ["error" => "Expiry time not found in hdntl"];
                }
            } else {
                $output = ["error" => "hdntl cookie not found"];
            }
        } else {
            $output = ["error" => "Cookies not found in response"];
        }
    } else {
        $output = ["error" => "MPD URL not found in response"];
    }
} else {
    $output = ["error" => "Empty response from API"];
}

// Output the result in JSON format
header('Content-Type: application/json');
echo json_encode($output, JSON_PRETTY_PRINT);

?>
