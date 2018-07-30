<?php
namespace App\Helpers;

use App\Currency;
use App\PartnerSetting;
use App\TenantSettings;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Crypt;
use Mail;

class GeneralFunctions
{
    /**
     *
     * Block : Ajax Debug data
     *
     */
    public static function ajax_debug($data)
    {
        echo '<pre>';
        print_r($data);
        die();
    }

    /**
     *
     * Block : Get IP ADDRESS of Current User
     *
     */
    public static function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    /**
     *
     * Block : Check if Data in Table Already Exist
     *
     */
    public static function checkDataExist($table_name, $columns_array, $data_array, $update_column_status = null, $record_id = null)
    {
        $checkExistingRecord = DB::table($table_name);
        foreach ($columns_array as $key => $value) {
            $checkExistingRecord->where($value, $data_array[$key]);
        }
        if ($update_column_status != null) {
            $checkExistingRecord->where('id', '!=', $record_id);
        }
        $result = $checkExistingRecord->get();
        return $result->toArray();
    }

    /**
     *
     * Block : Custom Email Function to Send Emails
     *
     */
    public static function sendEmail($data)
    {
        Mail::send('email.custom_email', $data, function ($message) use ($data) {
            $message->from(env('COMPANY_EMAIL_ADDRESS'), 'Coin Tree');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
    }

    /**
     *
     * Block : Get Company Identity
     *
     */
    public static function getCompanyAuth()
    {
        $userData = User::where('TenantId', Auth::user()->TenantId)->where('IsAdmin', 1)->first();
        return $userData->id;
    }

    /**
     *
     * Block : Serializing error Message
     *
     */
    public static function error_msg_serialize($errorList)
    {
        $errorData = $errorList;
        $errorData = $errorData->toArray();
        $errors    = [];
        $i         = 0;
        foreach ($errorData as $key => $value) {
            $errors[$i] = $value[0];
            $i++;
        }

        return $errors;
    }

    /* Permissions Working */
    public static function check_view_permission($code)
    {
        return GeneralFunctions::permissions($code, 4);
    }

    public static function check_edit_permission($code)
    {
        return GeneralFunctions::permissions($code, 2);
    }

    public static function check_add_permission($code)
    {
        return GeneralFunctions::permissions($code, 1);
    }

    public static function check_delete_permission($code)
    {
        return GeneralFunctions::permissions($code, 3);
    }

    public static function permissions($code, $permission)
    {
        if (Auth::user()->IsAdmin != 1) {
            $getRoleData         = DB::table('staff_contact_details')->where('user_id', Auth::user()->id)->first();
            $getScreenPermission = DB::table('screens_details')->where('code', $code)->first();
            if (!$getScreenPermission) {
                return false;
            }
            $screenId = $getScreenPermission->id;
            $roleId   = $getRoleData->role_id;

            $data = DB::table('permission_role')->where('screen_id', $screenId)->where('role_id', $roleId)->where('permission_id', $permission)->get();
            if (count($data->toArray()) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     *
     * Block : Encrypt Strings for protections
     *
     */
    public static function encryptString($data)
    {
        $encrypted = Crypt::encryptString($data);
        return $encrypted;
    }

    /**
     *
     * Block : Converting Decimal Value into Percentage
     *
     */
    public static function toPercentage($value)
    {
        $value = $value * 100;
        return $value;
    }

    /**
     *
     * Block : Convert String Date into Database DateTime
     *
     */
    public static function convertToDateTime($stringDate)
    {
        $timestamp = strtotime($stringDate);
        return date("Y-m-d H:i:s", $timestamp);
    }

    /**
     *
     * Block : Convert Date to String for Date Picker
     *
     */
    public static function convertToDateTimeToString($date)
    {
        if (!($date instanceof Carbon)) {
            if (is_numeric($date)) {
                // Assume Timestamp
                $date = Carbon::createFromTimestamp($date);
            } else {
                $date = Carbon::parse($date);
            }
        }
        $getTimeZone = TenantSettings::where('TenantId', Auth::user()->TenantId)->first();
        if ($getTimeZone) {
            return $date->setTimezone($getTimeZone->ValueData)->format('jS F Y g:ia');
        } else {
            return $date->setTimezone('UTC')->format('jS F Y g:ia');
        }
    }

    /**
     *
     * Block : Get Root User Of Company
     *
     */
    public static function adminUserId()
    {
        $getUserId = User::where('TenantId', Auth::user()->TenantId)->where('IsAdmin', 1)->first();
        return $getUserId->id;
    }

    /**
     *
     * Block : Get Currency Conversion Between Two Accounts
     *
     */
    public static function convertAmount($sourceId, $targetId, $amount, $transferType)
    {
        $funds = 0.0;
        if ($transferType == 1) {
            // Tenant Account Process
            $getTargetBaseCurrency = PartnerSetting::with('currency')->where('partner_id', $targetId)->first();
            if ($getTargetBaseCurrency) {
                // Calculation Process => Convert Transaction Amount of Tenant to Partner Currency
                $funds = $amount * $getTargetBaseCurrency->currency->CurrentRate;
            }
            return ['converted_funds' => $funds, 'partners_currency' => $getTargetBaseCurrency->currency->CurrencyName, 'currency_rate' => $getTargetBaseCurrency->currency->CurrentRate, 'partners_currency_id' => $getTargetBaseCurrency->currency->Id];
        } elseif ($transferType == 2) {
            // Partner Account Process
            $getTargetBaseCurrency = Currency::where('Tenant_Id', Auth::user()->TenantId)->where('isBaseCurrency', 1)->first();
            // GeneralFunctions::ajax_debug($getTargetBaseCurrency);
            return ['tenant_currency' => $getTargetBaseCurrency->CurrencyName, 'currency_rate' => $getTargetBaseCurrency->CurrentRate, 'tenant_currency_id' => $getTargetBaseCurrency->Id];
        } else {
            // Partner to Partner Account Process
            $getTargetBaseCurrency = PartnerSetting::with('currency')->where('partner_id', $targetId)->first();
            if ($getTargetBaseCurrency) {
                // Calculation Process => Convert Transaction Amount of Partner to Base Partner Currency
                $getTenantBaseCurrency = Currency::where('Tenant_Id', Auth::user()->TenantId)->where('isBaseCurrency', 1)->first();
                $funds                 = ($amount / $getTenantBaseCurrency->CurrentRate) * $getTargetBaseCurrency->currency->CurrentRate;
            }
            return ['converted_funds' => $funds, 'partners_currency' => $getTargetBaseCurrency->currency->CurrencyName, 'currency_rate' => $getTargetBaseCurrency->currency->CurrentRate, 'partners_currency_id' => $getTargetBaseCurrency->currency->Id];
        }
    }

    /**
     *
     * Block : Get Account Total Balance Info
     *
     */
    public static function getBalance(array $record, $accountHolderCurrency)
    {
        $totalBalance = 0.0;
        if (count($record) > 0) {
            foreach ($record as $key => $value) {
                /*----------  Calculation of Balance from different Currency Saved in Accounts Table  ----------*/
                if ($value['currency']['Id'] != $accountHolderCurrency->Id) {
                    // Step 1) Convert the Amount into Base Currency of Tenant Account
                    $convertedAmountToBaseCurrency = $value['Amount'] / $value['Current_Rate'];
                    $totalBalance                  = $totalBalance + ($convertedAmountToBaseCurrency * $accountHolderCurrency->CurrentRate);
                } else {
                    $totalBalance = $totalBalance + $value['Amount'];
                }
            }
        }
        return $totalBalance;
    }

    /**
     *
     * Block : Get Database Date to show in Date Picker
     *
     */
    public static function convertDBdateIntoDatepicker($date)
    {
        if (!($date instanceof Carbon)) {
            if (is_numeric($date)) {
                // Assume Timestamp
                $date = Carbon::createFromTimestamp($date);
            } else {
                $date = Carbon::parse($date);
            }
        }
        $getTimeZone = TenantSettings::where('TenantId', Auth::user()->TenantId)->first();
        if ($getTimeZone) {
            return $date->setTimezone($getTimeZone->ValueData)->format('d/m/Y');
        } else {
            return $date->setTimezone('UTC')->format('d/m/Y');
        }
    }

    /**
     *
     * Block : Get Loading Gif Div.
     *
     */
    public static function getLoadingGif()
    {
        return '<img class="loading_gif" style="display:none; height:33px;" src="' . url('img/loading.gif') . '">';
    }

}
