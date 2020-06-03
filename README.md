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

Now you can see our application on [https://external-api-jane.test](https://external-api-jane.test)

## And how Jane and this external API works together ?

@TODO

## Used libraries

In order to make this app, I used many libraries, here is a quick list of them:
- [jane-php/open-api-3](https://github.com/janephp/janephp): Indeed, we are using it to generate models, normalizers and 
our API client.
- [jolicode/docker-starter](https://github.com/jolicode/docker-starter): Used to have a quick & efficient docker setup
- [symfony/*](https://github.com/symfony/symfony): And indeed, the framework we are using Symfony
