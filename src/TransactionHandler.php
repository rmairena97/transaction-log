<?php

namespace Rmairena\TransactionHttp;

use Exception;
use Rmairena\TransactionHttp\Models\Transaction as TransactionModel;
use Rmairena\TransactionHttp\Models\TransactionTrace as TransactionTraceModel;
use Rmairena\TransactionHttp\Models\TransactionType as TransactionTypeModel;
use Rmairena\TransactionHttp\Models\TransactionTraceLog as TransactionTraceLogModel;

class TransactionHandler extends ThreadHandler {

    private $last_trace;
    private $transaction = null;

    public function beginTransactionLog(string $reference_key, string $service_identifider, int $transaction_type_id) : void {
        $this->initThread($reference_key, $service_identifider);
        if ($this->checkActiveThread()) {
            $this->LoadTransaction();
        }

        $this->storeThread($transaction_type_id);
        $this->transaction =  TransactionModel::create([
            'thread_id' => $this->getThreadModel()->id,
        ]);
    }


    private function LoadTransaction() : void {
        $this->last_trace = TransactionTraceModel::getLastTrace($this->transaction->id);         
    }

    public function setTrace(sring $step_name, mixed $payload) : void {
       $this->last_trace = TransactionTraceModel::create([
            'step_name' => $step_name,
            'payload'=> $payload,
            'transaction_id' => $this->transaction->id
        ]);
    }

    public function commitTrace($client_result) : void {
        if ( !$this->last_trace ) throw new Exception("You must set a trace before you complete the trace");
        $this->last_trace->client_result = json_encode($client_result);
        $this->last_trace->step_status = true;
        $this->last_trace->save();
    }

    public function getLastTrace() {
        return $this->last_trace;
    }

    public function CreateLogTrace(string $message) {
        TransactionTraceLogModel::create([
            'log'=> $message,
            'transaction_trace_id' => $this->last_trace->id,
        ]);
    }

    public function commitTransaction() : void {
        $this->transaction->completed = true;
        $this->transaction->save();
    }

    
}