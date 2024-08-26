<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table ='invoices';
    public function products():\Illuminate\Database\Eloquent\Relations\HasMany
    {
        // inja yani invoice_id ke too invoiceArticle table hast hammon id hast k too invoice table hast
        return $this->hasMany(InvoiceProduct::class,'invoice_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'invoice_id', 'id');
    }
}
