<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use AWS;

class AiQuestion {

    public $input;

    public $max = 3;

    protected $url = "https://dy6fp2ne5bayw4kgjbu2opuanq0lvxmg.lambda-url.us-east-1.on.aws";

    public function __construct()
    {
        
    }

    public function setInput($input)
    {
        $this->input = $input;
    }

    public function setMax($max)
    {
        $this->max = $max;
    }

    public function generate()
    {
        // $lambda = AWS::createLambda()->invoke([
        //     'FunctionName' => 'Flask API',
        //     'Payload' => json_encode([
        //         'input_text' => "Arthritis is the swelling and tenderness of one or more joints. The main symptoms of arthritis are joint pain and stiffness, which typically worsen with age. The most common types of arthritis are osteoarthritis and rheumatoid arthritis.Osteoarthritis causes cartilage — the hard, slippery tissue that covers the ends of bones where they form a joint — to break down. Rheumatoid arthritis is a disease in which the immune system attacks the joints, beginning with the lining of joints.",
        //         'max_questions' => 2
        //     ])
        // ]);

        // $output = json_decode($result['Payload'], true);

        // return $output;

        $response = Http::withHeaders([
            'Authorization' => "AWS4-HMAC-SHA256 Credential=AKIAURB4ZGPGTARL2WNN/20230221/us-east-1/lambda/aws4_request, SignedHeaders=host;x-amz-content-sha256;x-amz-date, Signature=11f28938bfcfd6105ec97197db92889045496efbe9f52eb9fbc7fbe8448ec526",
            'X-Amz-Content-Sha256' => 'beaead3198f7da1e70d03ab969765e0821b24fc913697e929e726aeaebf0eba3',
            'X-Amz-Date' => '20230221T223238Z'
        ])
            ->get($this->url . '?path=mcq', [
            'input_text' => $this->input,
            'max_questions' => $this->max
        ]);

        return $response;
    }
}