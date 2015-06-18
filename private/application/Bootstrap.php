<?php

class Bootstrap extends Ajde_Object_Singleton
{
    public static function getInstance()
    {
        static $instance;
        return $instance === null ? $instance = new self : $instance;
    }

    public function __bootstrap()
    {
        Ajde_Event::register('TransactionModel', 'onPaid', array($this, 'onTransactionPaid'));
        Ajde_Event::register('TransactionModel', 'onCreate', array($this, 'onTransactionCreated'));
        return true;
    }

    public function onTransactionPaid(TransactionModel $transaction)
    {
        /** @var TransactionItemModel $item */
        foreach($transaction->getItems() as $item) {
            $entity = $item->getEntity();
            $qty = $item->qty;

            if ($entity instanceof ProductModel) {
                $entity->stock = $entity->stock - $qty;
                $entity->save();
            }
        }
    }

    public function onTransactionCreated(TransactionModel $transaction)
    {
        $transaction->shipment_country = 'Nederland';
    }
}