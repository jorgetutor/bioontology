<?php

require dirname(__FILE__) . '/../../vendor/autoload.php';

use Tutor\Bioontology\BioontologyClient;

$apikey = '';
$debug = true;

// http://data.bioontology.org/search?q=C0025202&ontologies=MESH
$client = BioontologyClient::factory(['apikey' => $apikey, 'debug' => $debug]);
$response = $client->search([
  'q' => 'C0025202',
  'ontologies' => 'MESH',
]);
print_r($response);
