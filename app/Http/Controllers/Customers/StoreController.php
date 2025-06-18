<?php

namespace App\Http\Controllers\Customers;

use App\Actions\RegisterCustomer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\StoreRequest;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, RegisterCustomer $register): JsonResponse
    {
        $register->handle($request->validated(), $request->file('logo'));

        return response()->json();
    }
}
