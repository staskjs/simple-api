# Simple API

## Installation

    composer require staskjs/simple-api

## Usage

Create class for your api wrapper.

    use Staskjs\SimpleApi\SimpleJsonApi;

    class GithubApi extends SimpleJsonApi {

        // Headers for each request
        protected $headers = [
            'Authorization' => 'token TOKEN',
        ];

        // Specify default query params for each request (for example this can be api version or api token)
        protected $default_query = [
        ];

        public function getUsers() {
            return $this->request('GET', 'users');
        }
    }

    // ...

    $api = new GithubApi('https://api.github.com');

    $success = $api->getUsers();

    // If http query was successful
    if ($success) {
        $data = $api->getData();
    }
    else {
        $errors = $api->getErrors();
    }
