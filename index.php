<?php

require_once './vendor/autoload.php';

session_start();

function test_request($request) {
    $limitedRequestsValidator = new \App\FormValidator\Validators\LimitedRequestsValidator();
    $hiddenFieldValidator = new \App\FormValidator\Validators\HiddenFieldValidator('hidden_field');

    $limitedRequestsValidator->setNextValidator($hiddenFieldValidator);

    try {
        $limitedRequestsValidator->handle($request);
        echo '<br>OK';
    } catch (\App\FormValidator\Exceptions\FormValidatorException $e) {
        echo '<br>Error: ' . $e->getMessage();
    } finally {
        echo '<br>';
    }
}

$request = new \App\FormValidator\Helpers\Request();

// OK
echo '<br>Test positive path';
$request->setData([
    'field_1' => 'value',
    'field_2' => 'Other value',
]);
test_request($request);

// Error hidden field not empty
echo '<br>Test hidden field not empty';
$request->setData([
    'field_1' => 'value',
    'field_2' => 'Other value',
    'hidden_field' => 'should be null',
]);
test_request($request);

session_destroy();
session_start();

// Error request limit exceeded
echo '<br>Test requests limit';
$request->setData([
    'field_1' => 'value',
    'field_2' => 'Other value',
]);
test_request($request);
test_request($request);
test_request($request);
test_request($request);
test_request($request);
test_request($request);

session_destroy();