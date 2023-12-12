<?php

use Illuminate\Database\Seeder;
use Kordy\Ticketit\Seeds\SettingsTableSeeder;
use Kordy\Ticketit\Seeds\TicketitTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(FamilyRolesTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(EthnicityGroupsTableSeeder::class);
        $this->call(MatchQuestCategoriesTableSeeder::class);
        $this->call(CouponDiscountTypesTableSeeder::class);
        $this->call(HudsTableSeeder::class);
    }
}
