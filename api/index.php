<?php

// First part: Obtain authToken
$auth_url = 'https://auth-jiocinema.voot.com/tokenservice/apis/v4/refreshtoken';

$auth_headers = array(
    'authority: auth-jiocinema.voot.com',
    'accept: application/json, text/plain, */*',
    'accept-language: en-GB,en-US;q=0.9,en;q=0.8',
    'accesstoken: eyJhbGciOiJFUzI1NiIsInR5cCI6IkpXVCJ9.eyJkYXRhIjp7ImF1dGhUb2tlbklkIjoiOWIzN2U3ZmItOWI2Ni00ZTA4LWI2YzgtNTFlZDhkMDZhNTFlIiwidXNlcklkIjoiMzBjZThkOTktMTJjMy00MWY3LWFhODEtZTYyZmFiNzEyOTdhIiwidXNlclR5cGUiOiJOT05KSU8iLCJvcyI6IndlYiIsImRldmljZVR5cGUiOiJwYyIsImFjY2Vzc0xldmVsIjoiOSIsImRldmljZUlkIjoiN2MyOTJjN2QtMDcyNS00ZTMwLWEwMWUtMjVlNDRlZmM2MTYwIiwiZXh0cmEiOiJ7XCJudW1iZXJcIjpcImRhZVZoV0ZBVUJCdVhMYTJORE1WSWxUelpTUFNEb281QXNTdmdaL2N1ZWVSNDRqd1lZRDEwV1E9XCIsXCJhZHNcIjpcInllc1wiLFwicGxhbmRldGFpbHNcIjp7XCJhZHNcIjpcInllc1wiLFwiUGFja2FnZUluZm9cIjpbe1wicGxhbmlkXCI6XCJwbGFuLTRkNGQ3NDNkLWEwZDktNGEyYy04ZjQ4LWQ0NjM1NTIyMDA5YVwiLFwic3Vic2NyaXB0aW9uc3RhcnRcIjoxNzA5ODgzMjkzMjIwLFwic3Vic2NyaXB0aW9uZW5kXCI6MTc0MTc0NDc5OTk5OSxcInBsYW50eXBlXCI6XCJwcmVtaXVtXCIsXCJidXNpbmVzc1R5cGVcIjpcIlByZW1pdW1cIixcImluU3RyZWFtQWRzXCI6XCJFbmFibGVcIixcImRpc3BsYXlBZHNcIjpcIkVuYWJsZVwiLFwiaXNhY3RpdmVcIjp0cnVlLFwibm90ZXNcIjpcIlwiLFwicGxhbkRldGFpbHNcIjp7XCJmZWF0dXJlXCI6e1widmFsdWVcIjp7XCJBZHNDb25maWdcIjp7XCJkaXNwbGF5QWRzXCI6e1wibWFzdGhlYWRcIjp0cnVlLFwiYmFubmVyQWRzXCI6e1wiaW5CZXR3ZWVuVHJheUFkc1wiOnRydWUsXCJiZWxvd1BsYXllckFkc1wiOnRydWV9fSxcImluc3RyZWFtQWRzXCI6e1wibGl2ZVwiOntcInByZVJvbGxcIjp0cnVlLFwibWlkUm9sbFwiOnRydWV9LFwidm9kXCI6e1wicHJlUm9sbFwiOm51bGwsXCJtaWRSb2xsXCI6dHJ1ZX19fX19fX1dfSxcImpUb2tlblwiOlwiXCIsXCJ1c2VyRGV0YWlsc1wiOlwiMVNEWXJURGdydVdrQ2VZUnRrOFl2UVIram45ZGJNMndka3daSk9weDNTZ00wQ0RTY2VLZy81bVEyWjV0SFRNa3FOZDVWbjROWEp5bnZMV0s1VmR4OUN5OVVyMjRPK0hvRXk5YVhXcVZaN2M0OEsrK0d4UWtiMm1GZnF0cTVkZVpwVmRCMDJhNk9ERjZrNTR4VjVDTDdGYmYwdG1mMVViczk3cm5IMEFzZUE9PVwifSIsInN1YnNjcmliZXJJZCI6IiIsImFwcE5hbWUiOiJSSklMX0ppb0NpbmVtYSIsImRlZ3JhZGVkIjoiZmFsc2UiLCJhZHMiOiJ5ZXMiLCJwcm9maWxlSWQiOiJhYWY1NDllYy01MTk4LTRjODYtYjMyZC1kN2RlM2UxMzM0YzciLCJhZElkIjoiN2MyOTJjN2QtMDcyNS00ZTMwLWEwMWUtMjVlNDRlZmM2MTYwIiwiYWRzQ29uZmlnIjp7Imluc3RyZWFtQWRzIjp7ImxpdmUiOnsiZW5hYmxlZCI6dHJ1ZX0sInZvZCI6eyJlbmFibGVkIjp0cnVlfX19LCJleHBlcmltZW50S2V5Ijp7ImNvbmZpZ0tleSI6ImFhZjU0OWVjLTUxOTgtNGM4Ni1iMzJkLWQ3ZGUzZTEzMzRjNyIsImdyb3VwSWQiOjM1ODR9LCJwcm9maWxlRGV0YWlscyI6eyJwcm9maWxlVHlwZSI6ImFkdWx0IiwiY29udGVudEFnZVJhdGluZyI6IkEifSwidmVyc2lvbiI6MjAyNDAzMDQwfSwiZXhwIjoxNzE0MTMxNjc5LCJpYXQiOjE3MTQxMjQ0Nzl9.-TwxKiP0wQlQNFo9rOyjU4Plr0Fp2TpWALQwHCpdgFqr5vXBNKlvLKdvbtN7FuLEK48ansxycEHYh3a1Y0qUfw',
    'content-type: application/json',
    'origin: https://www.jiocinema.com',
    'referer: https://www.jiocinema.com/',
    'sec-ch-ua: "Chromium";v="111", "Not(A:Brand";v="8"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: cross-site',
    'user-agent: Mozilla/5.0 (Linux; Android 11; M2101K6P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36'
);

$auth_data = array(
    'appName' => 'RJIL_JioCinema',
    'deviceId' => '7c292c7d-0725-4e30-a01e-25e44efc6160',
    'refreshToken' => '278c539b-5e6a-48ef-be56-78aac997b80d',
    'appVersion' => '24.04.23.2-dae57af4'
);

$ch = curl_init($auth_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $auth_headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($auth_data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only for testing purposes, remove in production.

$response = curl_exec($ch);

if(curl_error($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
    curl_close($ch);
    exit();
}

curl_close($ch);

$auth_response = json_decode($response, true);
$auth_token = $auth_response['authToken'];

// Second part: Use authToken to fetch license URL
$content_id = '3774142'; // Default content_id

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://apis-jiovoot.voot.com/playbackjv/v4/' . $content_id);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 11; M2101K6P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Mobile Safari/537.36");
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"4k":false,"ageGroup":"18+","appVersion":"3.4.0","bitrateProfile":"xhdpi","capability":{"drmCapability":{"aesSupport":"yes","fairPlayDrmSupport":"yes","playreadyDrmSupport":"none","widevineDRMSupport":"yes"},"frameRateCapability":[{"frameRateSupport":"30fps","videoQuality":"1440p"}]},"continueWatchingRequired":false,"dolby":false,"downloadRequest":false,"hevc":false,"kidsSafe":false,"manufacturer":"Android","model":"Android","multiAudioRequired":true,"osVersion":"11","parentalPinValid":true,"x-apisignatures":"o668nxgzwff"}');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'authority: apis-jiovoot.voot.com',
    'accept: application/json, text/plain, */*',
    'accept-language: en-GB,en-US;q=0.9,en;q=0.8',
    'accesstoken: '.$auth_token, 
    'appname: RJIL_JioCinema',
    'content-type: application/json',
    'deviceid: 7c292c7d-0725-4e30-a01e-25e44efc6160',
    'origin: https://www.jiocinema.com',
    'referer: https://www.jiocinema.com/',
    'sec-ch-ua: "Chromium";v="111", "Not(A:Brand";v="8"',
    'sec-ch-ua-mobile: ?1',
    'sec-ch-ua-platform: "Android"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: cross-site',
    'uniqueid: 30ce8d99-12c3-41f7-aa81-e62fab71297a',
    'user-agent: Mozilla/5.0 (Linux; Android 10; BRAVIA 4K VH2 Build/QTG3.200305.006.S292; wv)',
    'versioncode: 2311220',
    'x-apisignatures: o668nxgzwff',
    'x-platform: androidtv',
    'x-platform-token: androidtv'
));

// Execute curl and store the result
$result = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Decode the JSON response
$response = json_decode($result, true);

// Check if playbackUrls exist and extract license URL value
if (isset($response['data']['playbackUrls'][0]['url'])) {
    $full_url = $response['data']['playbackUrls'][0]['url'];
    
    // Parse the query string from the full URL
    parse_str(parse_url($full_url, PHP_URL_QUERY), $query_params);
    
    // Check if 'hdnts' exists in the query parameters and extract it
    if (isset($query_params['hdnts'])) {
        $licenseurl = $query_params['hdnts'];
        $output = ['licenseurl' => $licenseurl];
    } else {
        $output = ['error' => 'hdnts parameter not found'];
    }
} else {
    $output = ['error' => 'License URL not found'];
}


// Print the output in JSON format
header('Content-Type: application/json');
echo json_encode($output);

?>
