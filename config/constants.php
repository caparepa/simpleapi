<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 1/24/2018
 * Time: 9:19 PM
 */

/**
 * CONSTANTS
 */

/*
 * Various status
 */
define('STATUS_ACTIVE','ACTIVE');
define('STATUS_INACTIVE','INACTIVE');
define('VENUE_OPEN','OPEN');
define('VENUE_CLOSED','CLOSED');

/**
 * Response Status
 */
define('STATUS_SUCCESS', 'success');
define('STATUS_ERROR', 'error');

/**
 * Response codes
 */

define('CODE_OK', 200);
define('CODE_CREATED', 201);

define('CODE_BAD_REQUEST', 400);
define('CODE_UNAUTHENTICATED', 401);
define('CODE_UNAUTHORIZED', 403);
define('CODE_NOT_FOUND', 404);
define('CODE_METHOD_NOT_ALLOWED', 405);
define('CODE_REQUEST_TIMEOUT', 408);
define('CODE_TEAPOT', 418);

define('CODE_SERVER_ERROR', 500);
define('CODE_BAD_GATEWAY', 502);
define('CODE_SERVICE_UNAVAILABLE', 503);
define('CODE_GATEWAY_TIMEOUT', 504);

define('CODE_ARRAY', [
    CODE_OK,
    CODE_CREATED,
    CODE_BAD_REQUEST,
    CODE_UNAUTHENTICATED,
    CODE_UNAUTHORIZED,
    CODE_NOT_FOUND,
    CODE_METHOD_NOT_ALLOWED,
    CODE_REQUEST_TIMEOUT,
    CODE_TEAPOT,
    CODE_SERVER_ERROR,
    CODE_BAD_GATEWAY,
    CODE_SERVICE_UNAVAILABLE,
    CODE_GATEWAY_TIMEOUT,
]);

/**
 * Success mesages
 */
define('LOGIN_SUCCESS', 'Login successful');
define('LOGIN_FAILED', 'Login failed');


/**
 * Validation messages
 */
define('VALIDATION_ERROR', 'There are errors in the data provided');

/**
 * Exception messages
 */
//TODO: change (or set) constants to multilanguage!
define('NO_MESSAGE', '');
define('GENERAL_ERROR', 'Something is wrong');

define('TOKEN_FAILED', 'Failed to create token');
define('TOKEN_INVALID', 'Invalid token');
define('TOKEN_REQUIRED', 'Token is required');
define('TOKEN_EXPIRED', 'Token has expired');
define('TOKEN_NOT_FOUND', 'Token not found');
define('TOKEN_NOT_PROVIDED', 'Token not provided');

define('USER_INVALID', 'Invalid email or password');
define('USER_PROFILE_NOT_FOUND', 'User not found');
define('USERS_NOT_FOUND', 'Users not found');
define('USER_SAVED', 'User created successfully');
define('USER_UPDATED', 'User updated successfully');
define('USER_NOT_SAVED', 'User not saved');
define('USER_NOT_UPDATED', 'User not updated');

define('PROMOTIONS_NOT_FOUND', 'Promotions not found');
define('PROMOTION_NOT_FOUND', 'Promotion not found');

define('VENUE_TYPE_NOT_FOUND', 'Venue type not found');
define('VENUE_TYPES_NOT_FOUND', 'Venue types not found');
