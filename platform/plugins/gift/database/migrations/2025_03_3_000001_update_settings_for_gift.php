<?php

use Botble\Base\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        rescue(function () {
                DB::table('settings')->insertOrIgnore([
                    'id' => BaseModel::getTypeOfId() === 'BIGINT' ? null : (new BaseModel())->newUniqueId(),
                    'key' => 'ultra_message_app_url',
                    'value' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                DB::table('settings')->insertOrIgnore([
                    'id' => BaseModel::getTypeOfId() === 'BIGINT' ? null : (new BaseModel())->newUniqueId(),
                    'key' => 'ultra_message_token',
                    'value' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                DB::table('settings')->insertOrIgnore([
                    'id' => BaseModel::getTypeOfId() === 'BIGINT' ? null : (new BaseModel())->newUniqueId(),
                    'key' => 'ultra_message_instance',
                    'value' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                DB::table('settings')->insertOrIgnore([
                    'id' => BaseModel::getTypeOfId() === 'BIGINT' ? null : (new BaseModel())->newUniqueId(),
                    'key' => 'donor_message',
                    'value' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                DB::table('settings')->insertOrIgnore([
                    'id' => BaseModel::getTypeOfId() === 'BIGINT' ? null : (new BaseModel())->newUniqueId(),
                    'key' => 'recipient_message',
                    'value' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                DB::table('settings')->insertOrIgnore([
                    'id' => BaseModel::getTypeOfId() === 'BIGINT' ? null : (new BaseModel())->newUniqueId(),
                    'key' => 'is_enabled',
                    'value' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                DB::table('settings')->insertOrIgnore([
                    'id' => BaseModel::getTypeOfId() === 'BIGINT' ? null : (new BaseModel())->newUniqueId(),
                    'key' => 'disable_msg',
                    'value' => 'الإهداءات متوقفة حالياً',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            
        });
    }
};
