<?php

function github_api($url)
{
    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "User-Agent: Naukri-Portal",
            "Accept: application/vnd.github+json"
        ],
        CURLOPT_TIMEOUT => 15,

        // IMPORTANT for XAMPP / localhost
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($response === false || $httpCode !== 200) {
        return null;
    }

    $data = json_decode($response, true);

    return is_array($data) ? $data : null;
}

function calculateGithubScore($username)
{
    if (empty($username)) {
        return null;
    }

    $repos = github_api("https://api.github.com/users/$username/repos?per_page=100");

    // API failed or rate-limited
    if (!$repos || isset($repos['message'])) {
        return null;
    }

    $repoCount = count($repos);
    $languages = [];
    $stars = 0;

    foreach ($repos as $repo) {

        if (!empty($repo['language'])) {
            $languages[$repo['language']] = true;
        }

        if (isset($repo['stargazers_count'])) {
            $stars += (int)$repo['stargazers_count'];
        }
    }

    $languageCount = count($languages);

    // Score calculation
    $repoScore = min($repoCount * 5, 40);
    $langScore = min($languageCount * 10, 40);
    $starScore = min($stars, 20);

    return [
        'score'     => min($repoScore + $langScore + $starScore, 100),
        'repos'     => $repoCount,
        'languages' => array_keys($languages)
    ];
}
