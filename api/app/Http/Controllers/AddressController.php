<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Address\DeleteAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Requests\Address\ReadAddressRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{

    protected Address $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function read(ReadAddressRequest $request): JsonResponse
    {
        try {
            return parent::output(
                $this->address->read($request->all())
            , 200);
        } catch (\Throwable $t) {
            Log::error('Error when searching address by params: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when searching address by params.'], 500);
        }
    }

    /**
     * @param CreateAddressRequest $request
     * 
     * @return JsonResponse
     */
    public function create(CreateAddressRequest $request): JsonResponse
    {
        try {
            return parent::output(
                Address::create($request->all())    
            , 201);
        } catch (\Throwable $t) {
            Log::error('Error when registering address: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when registering address.'], 500);
        }
    }

    /**
     * @param UpdateAddressRequest $request
     * 
     * @return JsonResponse
     */
    public function update(UpdateAddressRequest $request): JsonResponse
    {
        try {
            return parent::output(
                Address::find($request->id)->update($request->all())
            , 200);
        } catch (\Throwable $t) {
            Log::error('Error when updating address: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when updating address.'], 500);
        }
    }

    /**
     * @param DeleteAddressRequest $request
     * 
     * @return JsonResponse
     */
    public function delete(DeleteAddressRequest $request): JsonResponse
    {
        try {
            return parent::output(
                Address::find($request->id)->delete()
            , 200);
        } catch (\Throwable $t) {
            Log::error('Error when deleting address: ' . $t->getMessage());
    
            return response()->json(['message' => 'Error when deleting address.'], 500);
        }
    }

}
