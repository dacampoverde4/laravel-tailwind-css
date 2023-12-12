<?php

use Illuminate\Database\Seeder;
use App\Models\CouponDiscountType;

class CouponDiscountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupon_discount_types = [
            [
                'name' => 'Token Off',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'name' => 'Discount Percentage',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ],
            [
                'name' => 'Both',
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now()
            ]
        ];
        foreach($coupon_discount_types as $row){
            $row['slug'] = str_replace(' ', '_', strtolower($row['name']));
            CouponDiscountType::updateOrCreate(
                ['slug' => $row['slug']],
                $row
            );
        }
    }
}
