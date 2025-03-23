<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
    */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages))
            $response['data'] = $errorMessages;

        return response()->json($response, $code);
    }

    /**
     * sendValidationError function formats the validator messages and sends the reponse using sendError function
     *
     * @param [type] $validator
     * @return sendError function call
     */
    public function sendValidationError($validate)
    {
        $error_msg = '';
        foreach ($validate->errors()->all() as $message)
        {
            $error_msg .= $message."<br>";
        }
        $error_msg = rtrim($error_msg);
        return $this->sendError($error_msg, $validate->errors(), 400);
    }
}
