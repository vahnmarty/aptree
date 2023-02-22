<?php

namespace App\Services;
use AWS;
use GuzzleHttp\Client;
use Aws\Lambda\LambdaClient;
use GuzzleHttp\Psr7\Request;
use Aws\Signature\SignatureV4;
use Aws\Credentials\Credentials;
use Illuminate\Support\Facades\Http;

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

    public function createLambda()
    {

        $region = 'us-east-1';
        $service = 'lambda';

        // Define the AWS access key ID and secret access key to use
        $accessKey = config('aws.credentials.key');
        $secretKey = config('aws.credentials.secret');

        // Define the HTTP method, URI, and query string parameters for your request
        $method = 'GET';
        $uri = 'https://dy6fp2ne5bayw4kgjbu2opuanq0lvxmg.lambda-url.us-east-1.on.aws/?path=mcq';
        $query = [
                'input_text' => 'Arthritis is the swelling and tenderness of one or more joints. The main symptoms of arthritis are joint pain and stiffness, which typically worsen with age. The most common types of arthritis are osteoarthritis and rheumatoid arthritis.Osteoarthritis causes cartilage — the hard, slippery tissue that covers the ends of bones where they form a joint — to break down. Rheumatoid arthritis is a disease in which the immune system attacks the joints, beginning with the lining of joints.', 

                
                'max_questions' => '2'
            ];

        // Define the HTTP headers for your request, including the "Host" and "X-Amz-Date" headers
        $headers = [
            'Host' => 'us-east-1.s3.amazonaws.com',
            'X-Amz-Date' => gmdate('Ymd\THis\Z'),
        ];

        $client = new Client();

        // Create a new SignatureV4 object to sign the request
        $signer = new SignatureV4($service, $region);

        // Sign the request
        $credentials = new Credentials($accessKey, $secretKey);
        $request = new Request('GET', $uri);
        $request = $signer->signRequest($request, $credentials);

        // Send the signed request and get the response
        $response = $client->send($request);

        return $response;
    }

    public function signature()
    {
        $credentials = new Credentials(config('aws.credentials.key'), config('aws.credentials.secret'));
        $signer = new SignatureV4('questgen-api-QuestgenFunction-ILAfqAODMd1f', config('aws.region'));
        $request = new Request('GET', 'https://dy6fp2ne5bayw4kgjbu2opuanq0lvxmg.lambda-url.us-east-1.on.aws/?path=mcq');
        $signedRequest = $signer->signRequest($request, $credentials);

        $client = new Client();
        $response = $client->send($signedRequest);

        dd('cliemt', $response);
        $body = $response->getBody();
        $json = json_decode($body, true);

        return $json;
    }

    public function test()
    {

        $client = LambdaClient::factory([
            'version' => 'latest',
            'region'  => config('aws.region'),
            'credentials' => [
                'key'    => config('aws.credentials.key'),
                'secret' => config('aws.credentials.secret'),
            ]
        ]);

        $result = $client->invoke([
            'FunctionName' => 'questgen-api-QuestgenFunction-ILAfqAODMd1f',
            'Payload' => json_encode([
                'path' => 'mcq',
                'input_text' => "Arthritis is the swelling and tenderness of one or more joints. The main symptoms of arthritis are joint pain and stiffness, which typically worsen with age. The most common types of arthritis are osteoarthritis and rheumatoid arthritis.Osteoarthritis causes cartilage — the hard, slippery tissue that covers the ends of bones where they form a joint — to break down. Rheumatoid arthritis is a disease in which the immune system attacks the joints, beginning with the lining of joints.",
                'max_questions' => 2
            ])
        ]);

        $res = json_decode($result->get('Payload'), true);

        dd($res);
    }


    public function generate()
    {
        $client = LambdaClient::factory([
            'version' => 'latest',
            'region'  => config('aws.region'),
            'credentials' => [
                'key'    => config('aws.credentials.key'),
                'secret' => config('aws.credentials.secret'),
            ]
        ]);

        $params = [
            'path' => 'mcq',
                'input_text' =>  "Arthritis is the swelling and tenderness of one or more joints. The main symptoms of arthritis are joint pain and stiffness, which typically worsen with age. The most common types of arthritis are osteoarthritis and rheumatoid arthritis.Osteoarthritis causes cartilage — the hard, slippery tissue that covers the ends of bones where they form a joint — to break down. Rheumatoid arthritis is a disease in which the immune system attacks the joints, beginning with the lining of joints.",
                'max_questions' => 2
        ];
        $result = $client->invoke([
            'FunctionName' => 'questgen-api-QuestgenFunction-ILAfqAODMd1f',
            'Payload' => json_encode($params)
        ]);

        dd($result);

        $data = $result['Payload']->getContents();

        dd($data);

        // $lambda = AWS::createLambda()->invoke([
        //     'FunctionName' => 'questgen-api-QuestgenFunction-ILAfqAODMd1f',
        //     'Payload' => json_encode([
        //         'path' => 'mcq',
        //         'input_text' =>  "Arthritis is the swelling and tenderness of one or more joints. The main symptoms of arthritis are joint pain and stiffness, which typically worsen with age. The most common types of arthritis are osteoarthritis and rheumatoid arthritis.Osteoarthritis causes cartilage — the hard, slippery tissue that covers the ends of bones where they form a joint — to break down. Rheumatoid arthritis is a disease in which the immune system attacks the joints, beginning with the lining of joints.",
        //         'max_questions' => 2
        //     ])
        // ]);

        // $output = json_decode($lambda, true);

        // dd($output);

        // return $output;
    }
}