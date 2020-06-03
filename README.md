# Jane with External API using a Symfony application

Here is a demo Symfony application of Jane with an external API integration.

This README is a quick *Getting started* guide about this application.

## Requirements

To make this application works you need:
- [docker](https://docs.docker.com/engine/install/)
- python >= 3.6
- [pipenv](https://pipenv.pypa.io/en/latest/install/#installing-pipenv)

## Bash environment

We are using pipenv to avoid installing libraries on your local machine.
To run your bash env you have to install it first: `pipenv install`.
Then you can use it either by doing `pipenv run {command}` or `pipenv shell` 
(first command will only run a given command while second will prompt you in a new shell).

## Start docker

To have all needed services, we use docker. 
To make it start you can use `inv start` command.

Then you will need to have the demo app domain to your `/etc/hosts` as following:
```
127.0.0.1 external-api-jane.test
```

## Running the application

Now you need to install dependencies, setup database and index data in Elasticsearch.
To do all this you have to run:

```bash
inv start # start docker stack, install dependencies and setup database
inv fixtures # load fixtures
```

Now you can see our application on [https://external-api-jane.test/fact](https://external-api-jane.test/fact)

## And how Jane and this external API works together ?

In this section, we will see a working example of OpenApi v3 client onto a simple API that gives facts about cats and 
comment it. You can find this API documentation on following url: 
[https://alexwohlbruck.github.io/cat-facts/](https://alexwohlbruck.github.io/cat-facts/).

### OpenAPI schema

First, we need a valid OpenAPI schema. Since this API doesn't have one I made my own, for some big API, there is 
existing OpenAPI schema, but be carefull with theses, they're often really big and you won't use all endpoints and 
models. A solution to this is to use the `whitelisted-paths` option in Jane configuration, or you can write your own 
schema to have only endpoints and models you need.

Here is the schema I made:
```yaml
openapi: 3.0.0
info:
  version: 1.0.0
  title: 'CatFacts API'
servers:
  - url: https://cat-fact.herokuapp.com
paths:
  /facts/random:
    get:
      operationId: randomFact
      responses:
        200:
          description: 'Get a random `Fact`'
          content:
            application/json:
              schema:
                $ref: '#/components/schemas/Fact'
components:
  schemas:
    Fact:
      type: object
      properties:
        _id:
          type: string
          description: 'Unique ID for the `Fact`'
        __v:
          type: integer
          description: 'Version number of the `Fact`'
        user:
          type: string
          description: 'ID of the `User` who added the `Fact`'
        text:
          type: string
          description: 'The `Fact` itself'
        updatedAt:
          type: string
          format: date-time
          description: 'Date in which `Fact` was last modified'
        sendDate:
          type: string
          description: 'If the `Fact` is meant for one time use, this is the date that it is used'
        deleted:
          type: boolean
          description: 'Weather or not the `Fact` has been deleted (Soft deletes are used)'
        source:
          type: string
          description: 'Can be `user` or `api`, indicates who added the fact to the DB'
        used:
          type: boolean
          description: 'Weather or not the `Fact` has been sent by the CatBot. This value is reset each time every `Fact` is used'
        type:
          type: string
          description: 'Type of animal the `Fact` describes (e.g. ‘cat’, ‘dog’, ‘horse’)'
```

### Declaring services

Here we will create services for Symfony. When requiring package `jane-php/open-api-3`, a recipe will be installed, it
contains a `config/packages/jane.yaml` file, this file will contains wiring for the Normalizer, I added service for the
API client here:

```yaml
services:
    _defaults:
        autowire: true
        autoconfigure: true

    CatFacts\Api\Normalizer\JaneObjectNormalizer: ~

    CatFacts\Api\Client:
        factory: ['CatFacts\Api\Client', 'create']
        lazy: true
```

### Using your client

Finally, we create a controller that will fetch the data from the API and show a twig template to show the fact on 
`/fact` url.

```php
use CatFacts\Api\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FactController extends AbstractController
{
    // Here we will inject the Jane Client, this will allow us to recover the cat fact from the API !
    public function index(Client $client)
    {
        // We will render our home template with the cat fact from the API
        // Thanks to the OpenAPI scheme, Jane knows where is the server `https://cat-fact.herokuapp.com` and the path 
        // to use, so we only have to call related operation (defined by `operationId` in OpenAPI)
        // Jane will call the endpoint and return a list of `CatFacts\Api\Model\Fact` models
        return $this->render('fact.html.twig', [
            'fact' => $client->randomFact(),
        ]);
    }
}
```

## Used libraries

In order to make this app, I used many libraries, here is a quick list of them:
- [jane-php/open-api-3](https://github.com/janephp/janephp): Indeed, we are using it to generate models, normalizers and 
our API client.
- [jolicode/docker-starter](https://github.com/jolicode/docker-starter): Used to have a quick & efficient docker setup
- [symfony/*](https://github.com/symfony/symfony): And indeed, the framework we are using Symfony
