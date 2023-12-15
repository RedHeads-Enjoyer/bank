<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class GetAuthUser
{
  public function authenticateUser()
  {
    try {
      return response()->json(JWTAuth::parseToken()->authenticate());
    } catch (JWTException $e) {
      if ($e instanceof TokenInvalidException) {
        return response()->json(['error' => 'Invalid token'], 401);
      } elseif ($e instanceof TokenExpiredException) {
        return response()->json(['error' => 'Token has expired'], 401);
      } else {
        return response()->json(['error' => 'Failed to authenticate token'], 401);
      }
    }
  }
}
