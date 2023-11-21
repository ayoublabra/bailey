<?php

namespace App\Console\Commands;

use App\Models\DigitalContract;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateDocuSignStatus extends Command
{
    protected $signature = 'update:docusign-status';

    protected $description = 'Update database based on DocuSign envelope status';

    public function handle()
    {
        $long = strtotime(date("Y-m-d H:i:s")); 

        // Logique pour interroger DocuSign
        $response = Http::get('https://demo.docusign.net/restapi/v2/accounts/.'."3df36e73-cd9f-49cb-b337-9519ea7239c4".'/envelopes', [
            'status' => 'completed',
            // Ajoutez d'autres paramètres de requête selon vos besoins
        ]);

        $envelopes = $response->json()['envelopes'];

        foreach ($envelopes as $envelope) {
            // Mettez à jour la base de données en conséquence
            $record = DigitalContract::where('envelope_id', $envelope['envelopeId'])->first();

            if ($record) {
                $record->update(['is_signed' => 1,'state'=>'Bultin Signé','updated_at'=>$long]);
            }
        }

        $this->info('DocuSign statuses updated successfully.');
    }
}
