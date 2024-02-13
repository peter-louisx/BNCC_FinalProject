<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoices";
    protected $primaryKey = "id";
    protected $fillable = [
        "invoice_number",
        "post_code",
        "address",
        "created_at",
        "updated_at",
    ];
    public $timestamps = false;
    use HasFactory;
}