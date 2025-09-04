<?php

namespace Botble\Whatsapp\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappSetting extends Model
{
    protected $table = 'whatsapp_settings'; // your table name

    protected $fillable = [
        'ultramsg_whatsapp_token',
        'ultramsg_whatsapp_instance_id', 
        'whatsapp_id',
    ];

    public $timestamps = false; // if your table has timestamps
}
