<?php

namespace Rmairena\TransactionHttp;

use Exception;
use Rmairena\TransactionHttp\Models\Thread as ThreadModel;

class ThreadHandler {

    
    private $reference_key;
    private $service_identifier;
    private $thread;

    // public function __construct($reference_key, $service_identifier) {
    //     $this->reference_key = $reference_key;
    //     $this->service_identifier = $service_identifier;
        
    //     if ( $this->checkThreadInstance() && !$this->checkActiveThread()) throw new Exception("Thread is already been closed", 500);
    // }

    protected function initThread($reference_key, $service_identifier): void{
        $this->reference_key = $reference_key;
        $this->service_identifier = $service_identifier;
        
        if ( $this->checkThreadInstance() && !$this->checkActiveThread()) throw new Exception("Thread is already been closed", 500);
    }

    private function checkThreadInstance() : bool {
        return ThreadModel::getModelRow($this->reference_key, $this->service_identifier) !== null;
    }


    public function checkActiveThread() : bool {
        return $this->getThreadModel()->active;
    }

    public function getThreadModel() : Model {
        if ( $this->thread) return $this->thread;
        if ($thread  = ThreadModel::getModelRow($this->reference_key, $this->service_identifier))
         throw new Exception("Thread does't exists", 404);
        return $thread;
    }

    public function storeThread($transaction_type_id) : void {
        try{
            $this->thread = ThreadModel::create([
                'reference_key' => $this->reference_key,
                'service_identifier' => $this->service_identifier,
                'transaction_type_id' => $transaction_type_id
            ]);
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function closeThread() : void {
        try{
            $thread = $this->getThreadModel();
            $thread->active = false;
            $thread->save();
        }catch(Exception $ex){
            throw $ex;
        }
    }
}