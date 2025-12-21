<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Models\Contract;
use App\Models\InvoiceCharge;
use App\Models\InvoiceStatus;
use App\Services\ContractService;
use App\Services\Integrations\PaymentService;
use App\Services\InvoiceChargeService;
use App\Services\InvoiceService;

trait HasWebHook
{

    private function createInvoiceMovement(InvoiceCharge $charge, string $type, float $amount)
    {
        app(InvoiceService::class)->createInvoiceMovement($charge, $type, $amount);
    }

    private function insertFinancialCreditToContract(Contract $contract, float $amount,  $subsidized = 0, $invoice_id = null)
    {
        app(ContractService::class)->insertFinancialCreditToContract($contract, $amount, $subsidized, $invoice_id);
    }

    private function createInvoiceAttempt(InvoiceCharge $charge) 
    {
        $attempt = app(InvoiceService::class)->newAttempt($charge, request());
        if ($attempt) {
            $charge->invoice_attempt_id = $attempt->id;
            $charge->save();
        }
    }

    protected function invoiceAlreadyPaid(InvoiceCharge $charge, $paid_amount)
    {
        $invoice = $charge->invoice;

        app(InvoiceChargeService::class)->paidCharge($charge);

        app(InvoiceService::class)->createInvoiceMovement($charge, 'CREDIT', $paid_amount);
        
        //Removendo geração de credito webhook
        //app(ContractService::class)->insertFinancialCreditToContract($invoice->contract, $paid_amount, 0, $invoice->id);
    }

    protected function overpaidInvoice(InvoiceCharge $charge, $overpaid_amount)
    {
        $overPaidStatus = InvoiceStatus::where('name', 'Pago a maior')->firstOrFail();

        $invoice = $charge->invoice;

        $this->insertFinancialCreditToContract($invoice->contract, $overpaid_amount, 0,  $invoice->id);

        $invoiceService = app(InvoiceService::class);
        $charge = $invoiceService->paidCharge($charge, 'CREDIT', false);

        $this->createInvoiceAttempt($charge);

        $invoice = $charge->invoice;

        $invoice->invoice_status_id = $overPaidStatus->id;
        $invoice->save();
        $charge->invoice_status_id = $overPaidStatus->id;
        $charge->save();

        $this->createInvoiceMovement($charge, 'CREDIT', $charge->amount + $overpaid_amount);

        activity()
            ->performedOn($invoice)
            ->contract($invoice->contract)
            ->customer($invoice->customer)
            ->withProperties([
                'field_and_value' => [
                    [
                        'field' => 'Fatura',
                        'value' => '#' . $invoice->id
                    ],
                    [
                        'field' => 'Valor pago',
                        'value' => 'R$ ' . $charge->amount + $overpaid_amount
                    ],
                    [
                        'field' => 'Valor excedente',
                        'value' => 'R$ ' . number_format($overpaid_amount, 2, ',', '.')
                    ],
                ]
            ])
            ->log('paid_upper_value');
    }

    protected function underpaidInvoice(InvoiceCharge $charge, $paid_amount)
    {
        $response = request()->all();
        $invoice = $charge->invoice;

        $invoiceService = app(InvoiceService::class);
        $charge = $invoiceService->generateNewChargePaidLowerValue($charge, $paid_amount, 'AUTO', $response);

        $this->createInvoiceMovement($charge, 'CREDIT', $paid_amount);

        activity()
            ->performedOn($invoice)
            ->contract($invoice->contract)
            ->withProperties(
                [
                    'field_and_value' => [
                        [
                            'field' => 'Fatura',
                            'value' => '#' . $invoice->id
                        ],
                        [
                            'field' => 'Valor pago',
                            'value' => 'R$ ' . $paid_amount
                        ],
                        [
                            'field' => 'Valor restante',
                            'value' => 'R$ ' . number_format($charge->amount, 2, ',', '.')
                        ],
                    ]
                ]
            )
            ->log('paid_lower_value');
    }
}
