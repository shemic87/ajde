<?php

/**
 * @property string payment_status
 */
class TransactionModel extends Ajde_Shop_Transaction
{
    protected $_shippingModel = 'ShippingModel';
    protected $_itemModel = 'TransactionItemCollection';
}
