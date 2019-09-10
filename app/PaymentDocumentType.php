<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentDocumentType model for payment_document_types table
 * @package App
 */
class PaymentDocumentType extends Model
{
    /** @var string $table - table name */
    public $table = 'payment_document_types';

    /** @var array $guarded - limitation on mass assignment */
    protected $guarded = [];
}
