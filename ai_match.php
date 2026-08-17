<?php

include("config/api.php");

function analyzeResumeAI($resumeSkills, $jobSkills)
{

    $url = "https://api.groq.com/openai/v1/chat/completions";

    $prompt = "
You are an expert AI Resume Analyzer.

Compare the candidate's resume skills with the job required skills.

Resume Skills:
$resumeSkills

Job Required Skills:
$jobSkills

Instructions:
1. Compare skills case-insensitively.
2. Treat 'Javascript' and 'JavaScript' as the same.
3. Treat 'Git & GitHub' as two separate skills.
4. Calculate match percentage based only on required skills.
5. Suggestions should be short and practical.

Return ONLY valid JSON.

{
    \"match_percentage\":0,
    \"matched_skills\":[],
    \"missing_skills\":[],
    \"suggestions\":[]
}
";

    $data = [

        "model" => GROQ_MODEL,

        "messages" => [

            [
                "role" => "system",
                "content" => "You are an AI Resume Analyzer."
            ],

            [
                "role" => "user",
                "content" => $prompt
            ]

        ],

        "temperature" => 0.2,
        "max_tokens" => 500

    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [

        "Authorization: Bearer " . GROQ_API_KEY,
        "Content-Type: application/json"

    ]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {

        $error = curl_error($ch);

        curl_close($ch);

        return [

            "match_percentage" => 0,
            "matched_skills" => [],
            "missing_skills" => [],
            "suggestions" => ["Connection Error: " . $error]

        ];
    }

    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result['error'])) {

        return [

            "match_percentage" => 0,
            "matched_skills" => [],
            "missing_skills" => [],
            "suggestions" => ["Groq Error: " . $result['error']['message']]

        ];
    }

    if (isset($result['choices'][0]['message']['content'])) {

        $aiText = trim($result['choices'][0]['message']['content']);

        $aiText = str_replace(
            ["```json", "```"],
            "",
            $aiText
        );

        $aiText = trim($aiText);

        $json = json_decode($aiText, true);

        if (is_array($json)) {
            return [

    "match_percentage" => intval($json['match_percentage'] ?? 0),

    "matched_skills" => $json['matched_skills'] ?? [],

    "missing_skills" => $json['missing_skills'] ?? [],

    "suggestions" => $json['suggestions'] ?? []

];

        }

    }
    return [

    "match_percentage" => 0,

    "matched_skills" => [],

    "missing_skills" => ["Unable to analyze skills"],

    "suggestions" => ["Invalid AI response"]

];

}

?>