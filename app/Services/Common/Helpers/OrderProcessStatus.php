<?php
namespace App\Services\Common\Helpers;


class OrderProcessStatus
{
    const NEW = '44d5ddf7-1f04-11ea-8a89-b06ebfbfb012';
    const CREATE_DEPOSIT_STARTED = 'aba48033-1e5a-11ea-b0e1-b06ebfbfb012';
    const CREATE_DEPOSIT_INPROCESS = 'afa4e3fd-1e5a-11ea-b0e1-b06ebfbfb012';
    const CREATE_DEPOSIT_COMPLETED = 'b35ed0a6-1e5a-11ea-b0e1-b06ebfbfb012';
    const CREATE_DEPOSIT_UNKNOWN = 'b71c3989-1e5a-11ea-b0e1-b06ebfbfb012';
    const CREATE_DEPOSIT_REJEECTED = 'bac4ee71-1e5a-11ea-b0e1-b06ebfbfb012';
    const FILL_DEPOSIT_STARTED = 'bf374c26-1e5a-11ea-b0e1-b06ebfbfb012';
    const FILL_DEPOSIT_INPROCESS = 'c39a6204-1e5a-11ea-b0e1-b06ebfbfb012';
    const FILL_DEPOSIT_COMPLETED = 'c7406209-1e5a-11ea-b0e1-b06ebfbfb012';
    const FILL_DEPOSIT_UNKNOWN = 'cb567141-1e5a-11ea-b0e1-b06ebfbfb012';
    const FILL_DEPOSIT_REJECTED = 'cfcb57f3-1e5a-11ea-b0e1-b06ebfbfb012';
    const PAY_CARD_SERVICE_STARTED = 'd342f2d1-1e5a-11ea-b0e1-b06ebfbfb012';
    const PAY_CARD_SERVICE_INPROCESS = 'd811eca4-1e5a-11ea-b0e1-b06ebfbfb012';
    const PAY_CARD_SERVICE_COMPLETED = 'dba6c1c6-1e5a-11ea-b0e1-b06ebfbfb012';
    const PAY_CARD_SERVICE_UNKNOWN = 'df38968c-1e5a-11ea-b0e1-b06ebfbfb012';
    const PAY_CARD_SERVICE_REJECTED = '39345f6b-4ef2-11ea-b1c6-005056a37d1d';
    const CREATE_CARD_STARTED = 'e3537615-1e5a-11ea-b0e1-b06ebfbfb012';
    const CREATE_CARD_INPROCESS = 'e769d750-1e5a-11ea-b0e1-b06ebfbfb012';
    const CREATE_CARD_COMPLETED = 'ec385402-1e5a-11ea-b0e1-b06ebfbfb012';
    const CREATE_CARD_UNKNOWN = 'f2107453-1e5a-11ea-b0e1-b06ebfbfb012';
    const REJECTED = '25ea89a4-1e5d-11ea-b0e1-b06ebfbfb012';
    const COMPLETED = '1111554a-1e5c-11ea-b0e1-b06ebfbfb012';
    
    const NOT_ACCEPTED = 'd126cbfb-3713-4087-bfc4-a9b63bcc1aab';
    const ACCEPTED = 'b139e9f6-1a14-4a2b-847d-1c3cc112db5b';
    const WAITING_CLIENT_CONFIRMATION = '66dcd9d5-ddf2-4c1b-873c-adefce463fd2';
    const CLIENT_IDENTIFICATION_CONFIRMED = 'a54159cb-c132-46b5-913a-225859715007';
    const CLIENT_IDENTIFICATION_REJECTED = '75e4ba22-69a5-4eb5-acb2-85eaa6930acb';
    
    const CLOSE_DEPOSIT_STARTED = 'c19060b8-bd4a-11eb-9d20-902b345f5ee8';
    const CLOSE_DEPOSIT_INPROCESS = 'ca0aff0d-bd4a-11eb-9d20-902b345f5ee8';
    const CLOSE_DEPOSIT_COMPLETED = 'd289cf51-bd4a-11eb-9d20-902b345f5ee8';
    const CLOSE_DEPOSIT_UNKNOWN = 'da6ee39b-bd4a-11eb-9d20-902b345f5ee8';
    const CLOSE_DEPOSIT_REJECTED = 'e519ff5b-bd4a-11eb-9d20-902b345f5ee8';


    const CREATE_ACCOUNT_STARTED = '34498931-c382-11eb-9d44-902b345f5ee8';
    const CREATE_ACCOUNT_INPROCESS = '3c29865d-c382-11eb-9d44-902b345f5ee8';
    const CREATE_ACCOUNT_COMPLETED = '42190879-c382-11eb-9d44-902b345f5ee8';
    const CREATE_ACCOUNT_UNKNOWN = '1e41ad34-c383-11eb-9d44-902b345f5ee8';
    const CREATE_ACCOUNT_REJECTED = '2781d87f-c383-11eb-9d44-902b345f5ee8';


}