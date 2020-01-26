<?php
return [
    'alarm_types' => [
        '1' => 'بحرانی',
        '2' => 'مهم',
        '3' => 'کم اهمیت'
    ],
    'alarm_colors' => [
        '1' => 'danger',
        '2' => 'warning',
        '3' => 'info'
    ],
    'log_actions' => [
        'login' => ['value' => 'ورود به سیستم', 'color' => 'success'],
        'logout' => ['value' => 'خروج از سیستم', 'color' => 'danger'],
        'change_password' => ['value' => 'تغییر رمز عبور', 'color' => 'info'],
        'update_profile' => ['value' => 'ویرایش اطلاعات کاربری', 'color' => 'primary'],
        'update_device_settings' => ['value' => 'تغییر تنظیمات دستگاه', 'color' => 'warning'],
    ],
];
