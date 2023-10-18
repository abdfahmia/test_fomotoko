<?php

namespace App\Models;

use CodeIgniter\Model;

class FlashSaleModel extends Model
{
    protected $table = 'flash_sale';
    protected $primaryKey = 'flash_sale_id';
    protected $allowedFields = ['product_id', 'discount', 'start_date', 'end_date'];
}
