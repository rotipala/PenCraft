<?php

// This controller serves as a base controller for other controllers in the application,
// providing functionality for authorizing requests and validating inputs.

namespace App\Http\Controllers;

// Importing the necessary traits for authorization and validation functionality.
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Extending the base controller provided by Laravel.
class Controller extends BaseController
{
    // Including the AuthorizesRequests trait for handling authorization logic.
    use AuthorizesRequests;
    // Including the ValidatesRequests trait for handling input validation.
    use ValidatesRequests;
}
