<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use \PDF;

class InvoiceController extends Controller
{
    public function loadPreviewPdf(Request $request)
    {
        if (!$request->type) {
            throw new \Exception('Must provide a template type');
        }

        $data = [
            'date' => Carbon::now()->toFormattedDateString(),
            'invoice' => '000123',
            'invoice_subject' => 'Site Creation',
            'user_info' => [
                'name' => 'John Doe',
                'address' => '123 Appleseed Street',
                'city' => 'Appleville',
                'state' => 'WI',
                'zip' => '53719',
                'number' => '(555) 555-5555',
                'logo' => 'http://brandmark.io/logo-rank/random/beats.png'
            ],
            'company_info' => [
                'name' => 'Widget Corp.',
            ],
            'invoice_details' => [
                [
                    'description' => 'Monthly web updates for http://widgetcorp.com (Nov. 1 - Nov. 30, 2009)',
                    'quantity' => 1,
                    'unit_cost' => 650
                ],
                [
                    'description' => 'Yearly renewals of SSL certificates on main domain and several subdomains',
                    'quantity' => 3,
                    'unit_cost' => 75
                ],
            ]
        ];

        $pdf = PDF::loadView('templates.'.$request->type, $data);
        return $pdf->stream('invoice.pdf');
    }
}