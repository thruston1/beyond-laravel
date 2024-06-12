<?php
if ( ! function_exists('create_slugs')) {
    /**
     * @param $string
     * @param string $replace
     * @return array|string|null
     */
    function create_slugs($string, string $replace = '-'): array|string|null
    {
        $string = trim(strtolower($string));
        $string = preg_replace("/[^a-z0-9 -]/", "", $string);
        $string = preg_replace("/\s+/", $replace, $string);
        $string = preg_replace("/-+/", $replace, $string);
        return preg_replace("/[^a-zA-Z0-9]/", $replace, $string);
    }
}

if ( ! function_exists('valExcel')) {
    /**
     * @param $row
     * @param $column
     * @return string
     */
    function valExcel($row, $column)
    {
        return num2alpha($column).$row;
    }
}
if ( ! function_exists('num2alpha')) {
    /**
     * @param $n
     * @return string
     */
    function num2alpha($n)
    {
        $n = $n - 1;
        for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
            $r = chr($n%26 + 0x41) . $r;
        return $r;
    }
}
if ( ! function_exists('base64_to_jpeg'))
{
    /**
     * @param $data
     * @return false|string
     */
    function base64_to_jpeg($data): bool|string
    {
        $data = str_replace('data:image/jpeg;base64,', '', $data);
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace('[removed]', '', $data);
        $data = str_replace(' ', '+', $data);
        return base64_decode($data);
    }
}

if ( ! function_exists('clear_money_format')) {
    /**
     * @param $money
     * @return array|string|null
     */
    function clear_money_format($money): array|string|null
    {
        return preg_replace('/,/', '', $money);
    }
}

if ( ! function_exists('generateRandomString')) {
    /**
     * @param int $length
     * @return string
     */
    function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if ( ! function_exists('generate_code_verification')) {
    /**
     * @param $email
     * @param int $length
     * @return string
     */
    function generate_code_verification($email, int $length = 12): string
    {
        $randString = md5($email.strtotime("now"));
        $randLength = strlen($randString);
        if ($randLength < $length) {
            $randString .= generateRandomString($randLength - $length);
        }
        else {
            $totalSub = $randLength - $length;
            if ($totalSub > 0) {
                $randString = substr($randString, rand(0, $totalSub), $length);
            }
        }
        return $randString;
    }
}

if ( ! function_exists('getStartAndEndDate')) {
    /**
     * @param $week
     * @param $year
     * @return array
     */
    function getStartAndEndDate($week, $year): array
    {
        $week = intval($week);
        $year = intval($year);
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        if((0 == $year % 4) & (0 != $year % 100) | (0 == $year % 400))
        {
         $dto->modify('-1 days');
        }
        $ret['week_start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d');
        return $ret;
    }
}

if ( ! function_exists('moneyFormatWithK')) {
    /**
     * @param $number
     * @return string
     */
    function moneyFormatWithK($number): string
    {
        $number = $number/1000;
        if(preg_match('/^[0-9]+\.[0-9]{2}$/', $number))
            return number_format($number, 2).'K';
        elseif(preg_match('/^[0-9]+\.[0-9]{1}$/', $number))
            return number_format($number, 1).'K';
        else
            return number_format($number, 0).'K';
    }
}

if ( ! function_exists('distanceFormatWithK')) {
    /**
     * @param $number
     * @return string
     */
    function distanceFormatWithK($number): string
    {
        if ($number < 1000) {
            return number_format($number, 0).' M';
        }
        $number = $number/1000;
        $number = number_format($number, 2, '.', '');
        if(preg_match('/^[0-9]+\.[0-9]{2}$/', $number))
            return number_format($number, 2).' Km';
        elseif(preg_match('/^[0-9]+\.[0-9]{1}$/', $number))
            return number_format($number, 1).' Km';
        else
            return number_format($number, 0).' Km';
    }
}

if ( ! function_exists('getRandomNumber')) {
    /**
     * @param string $len
     * @return string
     */
    function getRandomNumber(string $len = "15"): string
    {
        return sprintf("%0".$len."d", mt_rand(1, str_pad("", $len,"9")));
    }
}

if ( ! function_exists('generateNewCode')) {
    /**
     * @param int $length
     * @param int $caseSensitive
     * @return string
     */
    function generateNewCode(int $length = 6, int $caseSensitive = 0): string
    {
        if ($caseSensitive == 1) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        else if ($caseSensitive == 2) {
            $characters = '0123456789';
        }
        else {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (! function_exists('generatePassingData')) {
    /**
     * @param $data
     * @return array
     */
    function generatePassingData($data): array
    {
        $result = [];
        foreach ($data as $fieldName => $fieldValue) {
            $result[$fieldName] = [
                'create' => $fieldValue['create'] ?? true,
                'edit' => $fieldValue['edit'] ?? true,
                'show' => $fieldValue['show'] ?? true,
                'list' => $fieldValue['list'] ?? true,
                'import' => $fieldValue['import'] ?? true,
                'export' => $fieldValue['export'] ?? true,
                'type' => $fieldValue['type'] ?? 'text',
                'lang' => $fieldValue['lang'] ?? 'general.' . $fieldName,
                'custom' => $fieldValue['custom'] ?? '',
                'extra' => $fieldValue['extra'] ?? [],
                'validate' => [
                    'create' => $fieldValue['validate']['create'] ?? '',
                    'edit' => $fieldValue['validate']['edit'] ?? ''
                ],
                'value' => $fieldValue['value'] ?? '',
                'path' => $fieldValue['path'] ?? '',
                'message' => $fieldValue['message'] ?? ''
            ];
        }
        return $result;
    }
}

if (! function_exists('collectPassingData')) {
    /**
     * @param $data
     * @param string $flag
     * @return array
     */
    function collectPassingData($data, string $flag = 'list'): array
    {
        $result = array(); 
        foreach ($data as $fieldName => $fieldValue) {
            if ($fieldValue[$flag]) {
                $result[$fieldName] = $fieldValue;
            }
        }
        return $result;
    }
}

if (! function_exists('printInitial')) {
    /**
     * @param $string
     * @return string
     */
    function printInitial($string): string
    {
        $getString = explode(' ', $string);
        $getString1 = $getString[0][0] ?? '';
        $getString2 = $getString[1][0] ?? $getString1;
        return $getString1.$getString2;
    }
}
