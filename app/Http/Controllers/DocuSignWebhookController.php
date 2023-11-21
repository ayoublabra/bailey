<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DigitalContract;
use Illuminate\Support\Facades\Log;

class DocuSignWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Parse the webhook payload
        // $payload = $request->json()->all();

        // // Check if the event is an "envelope completed" event
        // if ($payload['event_type'] === 'envelope_completed') {
        //     // Extract the envelope ID and status from the payload
        //     $envelopeId = $payload['envelope_id'];
        //     $status = $payload['envelope_status'];

        //     // Update the "is_signed" field in your database
        //     $contract = DigitalContract::where('envelopeId', $envelopeId)->first();
        //     if ($contract) {
        //         $contract->is_signed = ($status === 'completed') ? 1 : 0;
        //         $contract->save();
        //     } else {
        //         Log::warning("Contract with envelope ID $envelopeId not found in database");
        //     }
        // }

        // return response()->json(['success' => true]);

        //-------

        // $payload = $request->json()->all();

        // if ($payload['event'] === 'envelope_completed') {
        //     $envelopeId = $payload['data']['envelopeId'];
        //     $envelope = DigitalContract::where('envelopeId', $envelopeId)->first();
        //     if ($envelope) {
        //         $envelope->is_signed = 1;
        //         $envelope->save();
        //     }
        // }
    
        // return response('OK', 200);

        //----------


        $payload = json_decode($request->getContent(), true);
        if ($payload['event'] == 'envelope_completed') {
            $envelope_id = $payload['data']['envelopeId'];
            $envelope_status = $payload['data']['envelopeStatus'];
            
            // check if envelope is signed
            $is_signed = ($envelope_status == 'completed') ? 1 : 0;

            // dump and die execution
            dd($is_signed);

            // continue processing webhook
            // ...
        }

        return response('OK', 200);


    }
}
