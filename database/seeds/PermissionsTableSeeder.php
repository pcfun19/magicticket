<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '18',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '19',
                'title' => 'payment_create',
            ],
            [
                'id'    => '20',
                'title' => 'payment_edit',
            ],
            [
                'id'    => '21',
                'title' => 'payment_show',
            ],
            [
                'id'    => '22',
                'title' => 'payment_delete',
            ],
            [
                'id'    => '23',
                'title' => 'payment_access',
            ],
            [
                'id'    => '24',
                'title' => 'saved_customer_create',
            ],
            [
                'id'    => '25',
                'title' => 'saved_customer_edit',
            ],
            [
                'id'    => '26',
                'title' => 'saved_customer_show',
            ],
            [
                'id'    => '27',
                'title' => 'saved_customer_delete',
            ],
            [
                'id'    => '28',
                'title' => 'saved_customer_access',
            ],
            [
                'id'    => '29',
                'title' => 'business_detail_create',
            ],
            [
                'id'    => '30',
                'title' => 'business_detail_edit',
            ],
            [
                'id'    => '31',
                'title' => 'business_detail_show',
            ],
            [
                'id'    => '32',
                'title' => 'business_detail_delete',
            ],
            [
                'id'    => '33',
                'title' => 'business_detail_access',
            ],
            [
                'id'    => '34',
                'title' => 'event_create',
            ],
            [
                'id'    => '35',
                'title' => 'event_edit',
            ],
            [
                'id'    => '36',
                'title' => 'event_show',
            ],
            [
                'id'    => '37',
                'title' => 'event_delete',
            ],
            [
                'id'    => '38',
                'title' => 'event_access',
            ],
            [
                'id'    => '39',
                'title' => 'ticket_create',
            ],
            [
                'id'    => '40',
                'title' => 'ticket_edit',
            ],
            [
                'id'    => '41',
                'title' => 'ticket_show',
            ],
            [
                'id'    => '42',
                'title' => 'ticket_delete',
            ],
            [
                'id'    => '43',
                'title' => 'ticket_access',
            ],
            [
                'id'    => '44',
                'title' => 'payment_method_access',
            ],
            [
                'id'    => '45',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}
