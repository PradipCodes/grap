<?php

namespace App\StatusCode;

class APIStatusCode
{
    /*
    1xx: Informational - Request received, continuing process
    2xx: Success - The action was successfully received, understood, and accepted
    3xx: Redirection - Further action must be taken in order to complete the request
    4xx: Client Error - The request contains bad syntax or cannot be fulfilled
    5xx: Server Error - The server failed to fulfill an apparently valid request
    */

    const NO_API_KEY = 428; // Precondition Required
    const USER_NOT_FOUND = 404; // user not found
    const OK = 200; // OK
    const METHOD_NOT_ALLOWED = 405; //405	Method Not Allowed
    const UNASSIGNED = 425; //Unassigned
    const ALREADY_REPORTED = 208; // Already Reported
}
