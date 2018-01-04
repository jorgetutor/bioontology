# Bioontology Web Service Guzzle Client

Provides an implementation of the Guzzle library to query NCBO Web Service.

The goal of the National Center for Biomedical Ontology is to support biomedical researchers in their knowledge-intensive work, by providing online tools and a Web portal enabling them to access, review, and integrate disparate ontological resources in all aspects of biomedical investigation and clinical practice. A major focus of our work involves the use of biomedical ontologies to aid in the management and analysis of data derived from complex experiments.

- https://www.bioontology.org/about-ncbo
- http://data.bioontology.org/documentation

## API key
You must provide a valid API Key. Your API Key can be obtained by logging in at http://bioportal.bioontology.org/account

## Usage

To use the Bioontology API Client simply instantiate the client.

```php
<?php

require dirname(__FILE__).'/../vendor/autoload.php';

use Tutor\Bioontology\BioontologyClient;
$client = BioontologyClient::factory(['apikey' => 'your_apikey']);

// if you want to see what is happening, add debug => true to the factory call
$client = BioontologyClient::factory(['apikey' => 'your_apikey', 'debug' => true]);
```

Invoke Commands using the `__call` method (auto-complete phpDocs are included)

```php
<?php

$client = BioontologyClient::factory(['apikey' => 'your_apikey']);
$response = $client->query([
  'q' => 'C0025202',
]);

```

Or Use the `getCommand` method (in this case you need to work with the $response['data'] array:

```php
<?php

$client = BioontologyClient::factory();

// Retrieve the Command from Guzzle:
$command = $client->getCommand('Search', [
  'q' => 'C0025202',
]);
$command->prepare();

$response = $command->execute();

$data = $response['data'];

```

## Examples
You can execute the examples in the examples directory.

You can look at the services.json for details on what methods are available and what parameters are available to call them.

http://data.bioontology.org/search?q=C0025202&ontologies=MESH

```php
<?php

$client = BioontologyClient::factory(['apikey' => 'your_apikey']);
$response = $client->search([
  'q' => 'C0025202',
  'ontologies' => 'MESH',
]);

```

## TODO

- [ ] Add some more examples
- [ ] Add tests
- [ ] Add other methods
- [ ] Add some Response models

## Contributions welcome

Found a bug, open an issue, preferably with the debug output and what you did.
Bugfix? Open a Pull Request and I'll look into it.

## License

The use Tutor\Bioontology\BioontologyClient API client is available under an MIT License.
