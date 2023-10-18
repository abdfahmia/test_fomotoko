<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'order_item_id';
    protected $allowedFields = ['order_item_id', 'order_id', 'product_id', 'quantity', 'subtotal'];
}
