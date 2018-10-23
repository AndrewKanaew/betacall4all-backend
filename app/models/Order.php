<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 */

class Order extends Model
{

    /**
     * @var string
     */

    protected $table = "orders";


    /**
     * @var array
     */
    protected $fillable = ["topdelivery_id", "data", "status", "member_id"];

}