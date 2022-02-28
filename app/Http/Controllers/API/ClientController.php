<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Http\Resources\clientRresource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::all();
        return $this->sendResponse(clientRresource::collection($clients),'All data is here!');
    }

    public function show(Client $client){
        return $this->sendResponse(new clientRresource($client),'Client is ready!');
    }

    public function store(Request $request){
        $input = $request->all();


        $validator = Validator::make($input,[
            'name'=>'required|string',
            'email' =>'required|email',
            'address' => 'required',
            'phone'=> 'required'
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }


        $client = Client::create($input);
        return $this->sendResponse(new clientRresource($client),'client created successfully!');
    }

    public function update(Request $request, Client $client){
        $input = $request->all();

        $validator = Validator::make($input,[
            'name'=>'required|string',
            'email' =>'required|email',
            'address' => 'required',
            'phone'=> 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }

        $client->update($input);
        return $this->sendResponse(new clientRresource($client),'client updated successfully!');
    }

    public function destroy(Client $client){
        $client->destroy($client->id);
        return $this->sendResponse(new clientRresource($client),'client deleted successfully!');
    }
}
