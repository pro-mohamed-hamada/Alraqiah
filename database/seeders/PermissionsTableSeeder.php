<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            //start employee permissions
            'users'=>[
                'create_user',
                'edit_user',
                'delete_user',
                'view_user'
            ],
            //end employee permissions

            //start client permissions
            'clients'=>[
                'create_client',
                'edit_client',
                'delete_client',
                'view_client'
            ],
            //end client permissions

            //start center permissions
            'faqs'=>[
                'create_faq',
                'edit_faq',
                'delete_faq',
                'view_faq'
            ],
            //end center permissions

            //start packages permissions
            'videos'=>[
                'create_video',
                'edit_video',
                'delete_video',
                'view_video'
            ],

            //start doctors permissions
            'websites'=>[
                'create_website',
                'edit_website',
                'delete_website',
                'view_website'
            ],
            //end doctors permissions

            //start categories permissions
            'complaints'=>[
                'create_complaint',
                'edit_complaint',
                'delete_complaint',
                'view_complaint'
            ],
            //end categories permissions

            //start settings permissions
            'settings'=>[
                'view_settings',
                'edit_settings',
                ],
            //end settings permissions

            //start fcm_messages permissions
            'fcm_messages'=>[
                'create_fcm_message',
                'edit_fcm_message',
                'delete_fcm_message',
                'view_fcm_message',
                'change_fcm_message_status',
            ],
            //end fcm_messages permissions

            //start schedule_fcm permissions
            'schedule_fcm'=>[
                'create_schedule_fcm',
                'edit_schedule_fcm',
                'delete_schedule_fcm',
                'view_schedule_fcm',
                'change_schedule_fcm_status',
            ],
            //end schedule_fcm permissions


        ];
        $user = User::find(1);
        foreach($permissions as $key=>$permission)
        {
            foreach ($permission as $item){
                Permission::create(['guard_name'=>'web','category'=>$key,'name'=>$item]);
                $user->givePermissionTo($item);
            }
        }
    }
}