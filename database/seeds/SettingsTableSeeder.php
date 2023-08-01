<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeeder extends Seeder{

    public function run(){
        $setting = $this->findSetting('site.title');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.title'),
                'value' => __('voyager::seeders.settings.site.title'),
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.description');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.description'),
                'value' => __('voyager::seeders.settings.site.description'),
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.logo');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.logo'),
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.google_analytics_tracking_id');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.google_analytics_tracking_id'),
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 4,
                'group' => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('admin.bg_image');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.background_image'),
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 5,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.title');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.title'),
                'value' => 'Voyager',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.emergency_calls');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.emergency_calls'),
                'value' => '09099019898',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.messaging_credit');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.messaging_credit'),
                'value' => '10',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.description');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.description'),
                'value' => __('voyager::seeders.settings.admin.description_value'),
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.loader');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.loader'),
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.icon_image');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.icon_image'),
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 4,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.google_analytics_client_id');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.google_analytics_client_id'),
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ])->save();
        }


        $setting = $this->findSetting('pages.home.services_text');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن خدمات ما",
                'value' => 'خدمات ما در البرز آترا',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('pages.home.services_text_1');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن بالای خدمات ما",
                'value' => 'لورم ایپسوم متن ساختگی',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

    }

    protected function findSetting($key){
        return Setting::query()->firstOrNew(['key' => $key]);
    }
}
