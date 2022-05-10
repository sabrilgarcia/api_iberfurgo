<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;

use function is_null;

class ApiController extends Controller
{
    protected $minRequiredFields = [];

    protected $validOptionalsFields = [];

    protected $defaultService = null;

    protected $defaultRequest = null;

    protected $methodsToValidateRequest = ['POST', 'PUT'];

    protected $actionsToValidateRequest = ['store', 'update'];

    protected $statusCode = 200;

    public function __construct()
    {
        $this->defaultRequestValidation();
    }


    /* API REST DEFAULT METHODS */

    /*  GET ../api/v1/resource   */
    public function index(Request $request)
    {
        return $this->respondNotImplemented();
    }

    /*   GET ../api/v1/resource/íd   */
    public function show(Request $request, $id)
    {
        return $this->respondNotImplemented();
    }

    /*  POST ../api/v1/resource  */
    public function store(Request $request)
    {
        return $this->respondNotImplemented();
    }

    /*  PUT ../api/v1/resource/{id}  */
    public function update(Request $request, $id)
    {
        return $this->respondNotImplemented();
    }

    /*  DELETE ../api/v1/resource/{id}    */
    public function destroy(Request $request, $id)
    {
        return $this->respondNotImplemented();
    }

    /*  GET ../api/v1/resource/{idParent}/resource    */
    public function indexCompose(Request $request, $idParent)
    {
        return $this->respondNotImplemented();
    }

    /*   ../api/v1/resource/services/{method}/{resourceId}   */
    public function accessToService(Request $request, $method, $resourceId = null)
    {
        if (!is_null($this->defaultService)) {
            $results = $this->defaultService->$method($resourceId);
            return $this->respond(['data' => $results]);
        } else {
            return $this->respondNotImplemented();
        }
    }


    /*  API MIXED TOOLS METHODS   */

    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function defaultRequestValidation()
    {
        if ( !isset($this->defaultRequest)) return;

        $method = request()->method();
        if( !in_array( $method, $this->methodsToValidateRequest)) return;

        $action = request()->route() ? request()->route()->getActionMethod() : null;
        if ( !in_array( $action, $this->actionsToValidateRequest)) return;

        $validator = $this->defaultRequest->makeValidator();

        if ($validator->fails()) {
            throw new HttpResponseException($this->respondUnprocessableEntity(null, $validator->errors()));
        }
    }

    protected function validateMinFields($fields)
    {
        if (!isset($fields) || count($this->minRequiredFields) < 0)
            return false;

        $valid = true;
        foreach ($this->minRequiredFields as $key => $item) {
            $valid = in_array($item, array_keys($fields));
            if (!$valid) {
                return $valid;
            }
            return $valid;
        }
    }

    protected function validateFields($fields)
    {
        if (!isset($fields) || count($this->validOptionalsFields) < 0)
            return false;

        $valid = true;
        foreach ($fields as $key => $item) {
            $valid = in_array($key, $this->validOptionalsFields);
            if (!$valid)
                return $valid;
        }
        return $valid;
    }

    protected function validateIndex($fields)
    {
        $valid = $this->validateMinFields($fields);
        if (!$valid) {
            return $this->respondInvalidMinFilterFields();
        }

        $valid = $this->validateFields($fields);
        if (!$valid) {
            return $this->respondInvalidFilterFields();
        }
    }

    protected function respondUnauthorizedError($message = 'Unauthorized! ', $errors = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message, $errors);
    }

    protected function respondForbidenError($message = 'Forbiden! ', $errors = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_FORBIDDEN)->respondWithError($message, $errors);
    }

    protected function respondNotFound($message = 'Not Found! ', $errors = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message, $errors);
    }

    public function respondInternalError($message = 'Internal Error!', $errors = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message, $errors);
    }

    public function respondNotImplemented($message = 'Service not implemented!', $errors = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_IMPLEMENTED)->respondWithError($message, $errors);
    }

    protected function respondInvalidMinFilterFields($message = 'Invalid minimum filters provided. ' , $errors = [])
    {
        return $this->setStatusCode(460)->respondWithError($message . ' Min fields: ' . implode(',',$this->minRequiredFields), $errors);
    }

    protected function respondInvalidFilterFields($message = 'Invalid filters provided. ' , $errors = [])
    {
        return $this->setStatusCode(461)->respondWithError($message . ' Accepted fields: ' . implode(',',$this->validOptionalsFields), $errors);
    }

    protected function respondServiceUnavailable($message = "Service Unavailable!" , $errors = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_SERVICE_UNAVAILABLE)->respondWithError($message, $errors);
    }

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    protected function respondWithError($message, $errors = [])
    {
        return $this->respond([
            'errors' => $errors,
            'message' => $message,
            'status code' => $this->getStatusCode()
        ]);
    }

    protected function respondCreated($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)
                ->respond([
                    'message' => $message
                ]);
    }

    protected function respondUnprocessableEntity( string $messagne = null, $errors = [])
    {
        $status_code = IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY;
        return $this->setStatusCode($status_code)
                    ->respond([
                        'errors' => $errors,
                        'message' => $message ?? IlluminateResponse::$statusTexts[$status_code],
                        'status code' => $this->getStatusCode()
                    ]);
    }

}
