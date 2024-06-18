<?php
if ( ! function_exists('get_list_active_inactive')) {
    function get_list_active_inactive()
    {
        return [
            80 => __('general.active'),
            99 => __('general.inactive')
        ];
    }
}

if ( ! function_exists('get_list_boolean')) {
    function get_list_boolean()
    {
        return [
            'Y' => __('general.yes'),
            'N' => __('general.no')
        ];
    }
}

if ( ! function_exists('get_list_read')) {
    function get_list_read()
    {
        return [
            1 => __('Unread'),
            80 => __('Read')
        ];
    }
}

if ( ! function_exists('get_list_lang')) {
    function get_list_lang()
    {
        return [
            'en' => __('en'),
            'id' => __('id')
        ];
    }
}

if ( ! function_exists('get_list_class_type')) {
    function get_list_class_type()
    {
        return [
            1 => __('Video Pelatihan'),
            2 => __('Grand Final')
        ];
    }
}

if ( ! function_exists('get_list_coach')) {
    function get_list_coach()
    {
        return [
            1 => __('Pro Player'),
            2 => __('Coach')
        ];
    }
}

if ( ! function_exists('get_list_gender')) {
    function get_list_gender()
    {
        return [
            'Pria' => __('Pria'),
            'Wanita' => __('Wanita')
        ];
    }
}

if ( ! function_exists('get_list_condition')) {
    function get_list_condition()
    {
        return [
            1 => __('general.occupied'),
            2 => __('general.rent'),
            3 => __('general.empty')
        ];
    }
}

if ( ! function_exists('get_list_privilege')) {
    function get_list_privilege()
    {
        return [
            0 => __('general.pending'),
            1 => __('general.active')
        ];
    }
}



if ( ! function_exists('get_list_type')) {
    function get_list_type()
    {
        return [
            1 => __('general.normal'),
            2 => __('general.invitation')
        ];
    }
}

if ( ! function_exists('get_list_month')) {
    function get_list_month()
    {
        return [
            1 => __('general.january'),
            2 => __('general.february'),
            3 => __('general.march'),
            4 => __('general.april'),
            5 => __('general.mei'),
            6 => __('general.june'),
            7 => __('general.juli'),
            8 => __('general.augustus'),
            9 => __('general.september'),
            10 => __('general.october'),
            11 => __('general.november'),
            12 => __('general.december')
        ];
    }
}

if ( ! function_exists('get_list_month_data')) {
    function get_list_month_data($month)
    {
        $list_month = get_list_month();
        $month = intval($month);
        return isset($list_month[$month]) ? $list_month[$month] : '';
    }
}

if ( ! function_exists('get_list_data')) {
    function get_list_data($getList)
    {
        $result = [];
        foreach ($getList as $key => $val) {
            $result[] = [
                'id' => $key,
                'name' => $val
            ];
        }
        return $result;
    }
}

if ( ! function_exists('get_list_year')) {
    function get_list_year()
    {
        return [
            date('Y', strtotime('-2 year')) => date('Y', strtotime('-2 year')),
            date('Y', strtotime('-1 year')) => date('Y', strtotime('-1 year')),
            date('Y', strtotime("now")) => date('Y', strtotime("now")),
            date('Y', strtotime('+1 year')) => date('Y', strtotime('+1 year'))
        ];
    }
}




if ( ! function_exists('get_list_show_hide')) {
    function get_list_show_hide()
    {
        return [
            1 => __('general.hide'),
            2 => __('general.show')
        ];
    }
}

if ( ! function_exists('get_list_status_user')) {
    function get_list_status_user()
    {
        return [
            0 => __('general.pending'),
            1 => __('general.approve'),
            2 => __('general.reject')
        ];
    }
}

if ( ! function_exists('get_list_status_call')) {
    function get_list_status_call()
    {
        return [
            1 => __('general.pending'),
            2 => __('general.process'),
            80 => __('general.done'),
            90 => __('general.reject'),
        ];
    }
}

if ( ! function_exists('get_list_collection')) {
    function get_list_collection()
    {
        return [
            1 => __('general.pending'),
            80 => __('general.done'),
        ];
    }
}

if ( ! function_exists('get_list_result')) {
    function get_list_result()
    {
        return [
            80 => __('general.success'),
            90 => __('general.failed'),
        ];
    }
}

if ( ! function_exists('get_parameter_result')) {
    function get_parameter_result()
    {
        return [
            0 => 'calldate',
            1 => 'src',
            2 => 'dst',
            3 => 'duration',
            4 => 'billsec',
            5 => 'disposition',
            6 => 'usefield',
            7 => 'kontrak',
        ];
    }
}

