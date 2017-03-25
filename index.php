<?php
function currencyConverter($currency_from,$currency_to,$currency_input){
    
    if ($currency_input != '' && $currency_input != 0)  //ignores this to fix an error message if input is left blank or 0
    {
        $amount = urlencode($currency_input);
        $from_Currency = urlencode($currency_from);
        $to_Currency = urlencode($currency_to);
        $get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
        $get = explode("<span class=bld>",$get);
        $get = explode("</span>",$get[1]);  
        $currency_output = preg_replace("/[^0-9\.]/", null, $get[0]);
    
    
        return $currency_output;
    }
    
    return 0;
}

$currency_from = "";
$currency_to = "";
$currency_input = 1;
$selected_from = array_fill(0, 170, ''); //array for the dropdown selections for the "from" box
$selected_to = array_fill(0, 170, '');  //array for the dropdown selections for the "to" box

/*UNUSED OLD CODE

$currency_to_array = $currency_from_array = array ('AED' => 'United Arab Emirates Dirham',
                                                   'AFN' => 'Afghan Afghani',
                                                   'ALL' => 'Albanian Lek',
                                                   'AMD' => 'Armenian Dram',
                                                   'ANG' => 'Netherlands Antillean Guilder',
                                                   'AOA' => 'Angolan Kwanza',
                                                   'ARS' => 'Argentine Peso',
                                                   'AUD' => 'Australian Dollar',
                                                   'AWG' => 'Aruban Florin',
                                                   'AZN' => 'Azerbaijani Manat',
                                                   'BAM' => 'Bosnia-Herzegovina Convertible Mark',
                                                   'BBD' => 'Barbadian Dollar',
                                                   'BDT' => 'Bangladeshi Taka',
                                                   'BGN' => 'Bulgarian Lev',
                                                   'BHD' => 'Bahraini Dinar',
                                                   'BIF' => 'Burundian Franc',
                                                   'BMD' => 'Bermudan Dollar',
                                                   'BND' => 'Brunei Dollar',
                                                   'BOB' => 'Bolivian Boliviano',
                                                   'BRL' => 'Brazilian Real',
                                                   'BSD' => 'Bahamian Dollar',
                                                   'BTC' => 'Bitcoin',
                                                   'BTN' => 'Bhutanese Ngultrum',
                                                   'BWP' => 'Botswanan Pula',
                                                   'BYN' => 'Belarusian Ruble',
                                                   'BYR' => 'Belarusian Ruble (2000-2016)',
                                                   'BZD' => 'Belize Dollar',
                                                   'CAD' => 'Canadian Dollar',
                                                   'CDF' => 'Congolese Franc',
                                                   'CHF' => 'Swiss Franc',
                                                   'CLF' => 'Chilean Unit of Account',
                                                   'CLP' => 'Chilean Peso',
                                                   'CNH' => 'CNH',
                                                   'CNY' => 'Chinese Yuan',
                                                   'COP' => 'Colombian Peso',
                                                   'CRC' => 'Costa Rican Colon',
                                                   'CUP' => 'Cuban Peso',
                                                   'CVE' => 'Cape Verdean Escudo',
                                                   'CZK' => 'Czech Republic Koruna',
                                                   'DEM' => 'German Mark',
                                                   'DJF' => 'Djiboutian Franc',
                                                   'DKK' => 'Danish Krone',
                                                   'DOP' => 'Dominican Peso',
                                                   'DZD' => 'Algerian Dinar',
                                                   'EGP' => 'Egyptian Pound',
                                                   'ERN' => 'Eritrean Nakfa',
                                                   'ETB' => 'Ethiopian Birr',
                                                   'EUR' => 'Euro',
                                                   'FIM' => 'Finnish Markka',
                                                   'FJD' => 'Fijian Dollar',
                                                   'FKP' => 'Falkland Islands Pound',
                                                   'FRF' => 'French Franc',
                                                   'GBP' => 'British Pound',
                                                   'GEL' => 'Georgian Lari',
                                                   'GHS' => 'Ghanaian Cedi',
                                                   'GIP' => 'Gibraltar Pound',
                                                   'GMD' => 'Gambian Dalasi',
                                                   'GNF' => 'Guinean Franc',
                                                   'GTQ' => 'Guatemalan Quetzal',
                                                   'GYD' => 'Guyanaese Dollar',
                                                   'HKD' => 'Hong Kong Dollar',
                                                   'HNL' => 'Honduran Lempira',
                                                   'HRK' => 'Croatian Kuna',
                                                   'HTG' => 'Haitian Gourde',
                                                   'HUF' => 'Hungarian Forint',
                                                   'IDR' => 'Indonesian Rupiah',
                                                   'IEP' => 'Irish Pound',
                                                   'ILS' => 'Israeli New Sheqel',
                                                   'INR' => 'Indian Rupee',
                                                   'IQD' => 'Iraqi Dinar',
                                                   'IRR' => 'Iranian Rial',
                                                   'ISK' => 'Icelandic Krona',
                                                   'ITL' => 'Italian Lira',
                                                   'JMD' => 'Jamaican Dollar',
                                                   'JOD' => 'Jordanian Dinar',
                                                   'JPY' => 'Japanese Yen',
                                                   'KES' => 'Kenyan Shilling',
                                                   'KGS' => 'Kyrgystani Som',
                                                   'KHR' => 'Cambodian Riel',
                                                   'KMF' => 'Comorian Franc',
                                                   'KPW' => 'North Korean Won',
                                                   'KRW' => 'South Korean Won',
                                                   'KWD' => 'Kuwaiti Dinar',
                                                   'KYD' => 'Cayman Islands Dollar',
                                                   'KZT' => 'Kazakhstani Tenge',
                                                   'LAK' => 'Laotian Kip',
                                                   'LBP' => 'Lebanese Pound',
                                                   'LKR' => 'Sri Lankan Rupee',
                                                   'LRD' => 'Liberian Dollar',
                                                   'LSL' => 'Lesotho Loti',
                                                   'LTL' => 'Lithuanian Litas',
                                                   'LVL' => 'Latvian Lats',
                                                   'LYD' => 'Libyan Dinar',
                                                   'MAD' => 'Moroccan Dirham',
                                                   'MDL' => 'Moldovan Leu',
                                                   'MGA' => 'Malagasy Ariary',
                                                   'MKD' => 'Macedonian Denar',
                                                   'MMK' => 'Myanmar Kyat',
                                                   'MNT' => 'Mongolian Tugrik',
                                                   'MOP' => 'Macanese Pataca',
                                                   'MRO' => 'Mauritanian Ouguiya',
                                                   'MUR' => 'Mauritian Rupee',
                                                   'MVR' => 'Maldivian Rufiyaa',
                                                   'MWK' => 'Malawian Kwacha',
                                                   'MXN' => 'Mexican Peso',
                                                   'MYR' => 'Malaysian Ringgit',
                                                   'MZN' => 'Mozambican Metical',
                                                   'NAD' => 'Namibian Dollar',
                                                   'NGN' => 'Nigerian Naira',
                                                   'NIO' => 'Nicaraguan Cordoba',
                                                   'NOK' => 'Norwegian Krone',
                                                   'NPR' => 'Nepalese Rupee',
                                                   'NZD' => 'New Zealand Dollar',
                                                   'OMR' => 'Omani Rial',
                                                   'PAB' => 'Panamanian Balboa',
                                                   'PEN' => 'Peruvian Nuevo Sol',
                                                   'PGK' => 'Papua New Guinean Kina',
                                                   'PHP' => 'Philippine Peso',
                                                   'PKG' => 'PKG',
                                                   'PKR' => 'Pakistani Rupee',
                                                   'PLN' => 'Polish Zloty',
                                                   'PYG' => 'Paraguayan Guarani',
                                                   'QAR' => 'Qatari Rial',
                                                   'RON' => 'Romanian Leu',
                                                   'RSD' => 'Serbian Dinar',
                                                   'RUB' => 'Russian Ruble',
                                                   'RWF' => 'Rwandan Franc',
                                                   'SAR' => 'Saudi Riyal',
                                                   'SBD' => 'Solomon Islands Dollar',
                                                   'SCR' => 'Seychellois Rupee',
                                                   'SDG' => 'Sudanese Pound',
                                                   'SEK' => 'Swedish Krona',
                                                   'SGD' => 'Singapore Dollar',
                                                   'SHP' => 'St. Helena Pound',
                                                   'SKK' => 'Slovak Koruna',
                                                   'SLL' => 'Sierra Leonean Leone',
                                                   'SOS' => 'Somali Shilling',
                                                   'SRD' => 'Surinamese Dollar',
                                                   'STD' => 'Sao Tome &amp; Principe Dobra',
                                                   'SVC' => 'Salvadoran Colon',
                                                   'SYP' => 'Syrian Pound',
                                                   'SZL' => 'Swazi Lilangeni',
                                                   'THB' => 'Thai Baht',
                                                   'TJS' => 'Tajikistani Somoni',
                                                   'TMT' => 'Turkmenistani Manat',
                                                   'TND' => 'Tunisian Dinar',
                                                   'TOP' => 'Tongan Paʻanga',
                                                   'TRY' => 'Turkish Lira',
                                                   'TTD' => 'Trinidad &amp; Tobago Dollar',
                                                   'TWD' => 'New Taiwan Dollar',
                                                   'TZS' => 'Tanzanian Shilling',
                                                   'UAH' => 'Ukrainian Hryvnia',
                                                   'UGX' => 'Ugandan Shilling',
                                                   'USD' => 'US Dollar',
                                                   'UYU' => 'Uruguayan Peso',
                                                   'UZS' => 'Uzbekistani Som',
                                                   'VEF' => 'Venezuelan Bolivar',
                                                   'VND' => 'Vietnamese Dong',
                                                   'VUV' => 'Vanuatu Vatu',
                                                   'WST' => 'Samoan Tala',
                                                   'XAF' => 'Central African CFA Franc',
                                                   'XCD' => 'East Caribbean Dollar',
                                                   'XDR' => 'Special Drawing Rights',
                                                   'XOF' => 'West African CFA Franc',
                                                   'XPF' => 'CFP Franc',
                                                   'YER' => 'Yemeni Rial',
                                                   'ZAR' => 'South African Rand',
                                                   'ZMK' => 'Zambian Kwacha (1968-2012)',
                                                   'ZMW' => 'Zambian Kwacha',
                                                   'ZWL' => 'Zimbabwean Dollar (2009)');*/

if (isset($_POST['currency_from']) && isset($_POST['currency_to']) && isset($_POST['currency_input']))
{
	$currency_from = $_POST['currency_from'];  //sets variable $currency_from to the current drop down selection that is set
	$currency_to = $_POST['currency_to'];      //sets variable $currency_to to the currenct drop down selection set for currency to
	$currency_input = $_POST['currency_input'];    //sets variable $currency_input to the value in the input box
 
    $currency = currencyConverter($currency_from,$currency_to,$currency_input); //sets the variable $currency to the exchange value of the "to" currency
    // Populate a specific paragraph or div with result
    if ($currency_input > 0 && is_numeric($currency_input))    //if value is a number greater than 0
    {
         $result = number_format($currency_input, 2, '.', ',').' '.$currency_from.' = '.number_format($currency, 2, '.', ',').' '.$currency_to; //print result to variable $result
    }
    else if ($currency_input == '' || $currency_input == 0 || $currency_input == NULL) //if value is blank or zero
    {
        $currency_input = 0;
        $result = number_format($currency_input, 2, '.', ',').' '.$currency_from.' = '.number_format($currency, 2, '.', ',').' '.$currency_to; //print result to variable $result
    }
    else
    {
        $result = 'ERROR: Currency must be a number greater than or equal to zero.';    //invalid input, print error message to $result
    }
}
else    //page is opened for the first time and nothing is "set", initialize values for result
{

        $result = '';
}

/******************************************************************************
/Switch statement that checks if current drop down box for the currency_from is
/selected. If it is selected, maintains the selection flag for that specific currency
/*******************************************************************************/
if (isset($_POST['currency_from']))
{
    $temp_variable = $_POST['currency_from'];
    switch($temp_variable)
    {
        case 'AED':     $selected_from[0] = 'selected = "selected"';
                        break;
        case 'AFN':     $selected_from[1] = 'selected = "selected"';
                        break;
        case 'ALL':     $selected_from[2] = 'selected = "selected"';
                        break;
        case 'AMD':     $selected_from[3] = 'selected = "selected"';
                        break;
        case 'ANG':     $selected_from[4] = 'selected = "selected"';
                        break;
        case 'AOA':     $selected_from[5] = 'selected = "selected"';
                        break;
        case 'ARS':     $selected_from[6] = 'selected = "selected"';
                        break;
        case 'AUD':     $selected_from[7] = 'selected = "selected"';
                        break; 
        case 'AWG':     $selected_from[8] = 'selected = "selected"';
                        break;
        case 'AZN':     $selected_from[9] = 'selected = "selected"';
                        break;
        case 'BAM':     $selected_from[10] = 'selected = "selected"';
                        break;
        case 'BBD':     $selected_from[11] = 'selected = "selected"';
                        break;
        case 'BDT':     $selected_from[12] = 'selected = "selected"';
                        break; 
        case 'BGN':     $selected_from[13] = 'selected = "selected"';
                        break; 
        case 'BHD':     $selected_from[14] = 'selected = "selected"';
                        break; 
        case 'BIF':     $selected_from[15] = 'selected = "selected"';
                        break; 
        case 'BMD':     $selected_from[16] = 'selected = "selected"';
                        break; 
        case 'BND':     $selected_from[17] = 'selected = "selected"';
                        break; 
        case 'BOB':     $selected_from[18] = 'selected = "selected"';
                        break; 
        case 'BRL':     $selected_from[19] = 'selected = "selected"';
                        break; 
        case 'BSD':     $selected_from[20] = 'selected = "selected"';
                        break; 
        case 'BTC':     $selected_from[21] = 'selected = "selected"';
                        break; 
        case 'BTN':     $selected_from[22] = 'selected = "selected"';
                        break; 
        case 'BWP':     $selected_from[23] = 'selected = "selected"';
                        break;
        case 'BYN':     $selected_from[24] = 'selected = "selected"';
                        break; 
        case 'BYR':     $selected_from[25] = 'selected = "selected"';
                        break; 
        case 'BZD':     $selected_from[26] = 'selected = "selected"';
                        break; 
        case 'CAD':     $selected_from[27] = 'selected = "selected"';
                        break; 
        case 'CDF':     $selected_from[28] = 'selected = "selected"';
                        break; 
        case 'CHF':     $selected_from[29] = 'selected = "selected"';
                        break; 
        case 'CLF':     $selected_from[30] = 'selected = "selected"';
                        break; 
        case 'CLP':     $selected_from[31] = 'selected = "selected"';
                        break; 
        case 'CNH':     $selected_from[32] = 'selected = "selected"';
                        break; 
        case 'CNY':     $selected_from[33] = 'selected = "selected"';
                        break; 
        case 'COP':     $selected_from[34] = 'selected = "selected"';
                        break; 
        case 'CRC':     $selected_from[35] = 'selected = "selected"';
                        break; 
        case 'CUP':     $selected_from[36] = 'selected = "selected"';
                        break; 
        case 'CVE':     $selected_from[37] = 'selected = "selected"';
                        break; 
        case 'CZK':     $selected_from[38] = 'selected = "selected"';
                        break; 
        case 'DEM':     $selected_from[39] = 'selected = "selected"';
                        break; 
        case 'DJF':     $selected_from[40] = 'selected = "selected"';
                        break;
        case 'DKK':     $selected_from[41] = 'selected = "selected"';
                        break;
        case 'DOP':     $selected_from[42] = 'selected = "selected"';
                        break;
        case 'DZD':     $selected_from[43] = 'selected = "selected"';
                        break;
        case 'EGP':     $selected_from[44] = 'selected = "selected"';
                        break;
        case 'ERN':     $selected_from[45] = 'selected = "selected"';
                        break;
        case 'ETB':     $selected_from[46] = 'selected = "selected"';
                        break;
        case 'EUR':     $selected_from[47] = 'selected = "selected"';
                        break;
        case 'FIM':     $selected_from[48] = 'selected = "selected"';
                        break;
        case 'FJD':     $selected_from[49] = 'selected = "selected"';
                        break;
        case 'FKP':     $selected_from[50] = 'selected = "selected"';
                        break;
        case 'FRF':     $selected_from[51] = 'selected = "selected"';
                        break;
        case 'GBP':     $selected_from[52] = 'selected = "selected"';
                        break;
        case 'GEL':     $selected_from[53] = 'selected = "selected"';
                        break;
        case 'GHS':     $selected_from[54] = 'selected = "selected"';
                        break;
        case 'GIP':     $selected_from[55] = 'selected = "selected"';
                        break;
        case 'GMD':     $selected_from[56] = 'selected = "selected"';
                        break;
        case 'GNF':     $selected_from[57] = 'selected = "selected"';
                        break;
        case 'GTQ':     $selected_from[58] = 'selected = "selected"';
                        break;
        case 'GYD':     $selected_from[59] = 'selected = "selected"';
                        break;
        case 'HKD':     $selected_from[60] = 'selected = "selected"';
                        break;
        case 'HNL':     $selected_from[61] = 'selected = "selected"';
                        break;
        case 'HRK':     $selected_from[62] = 'selected = "selected"';
                        break;
        case 'HTG':     $selected_from[63] = 'selected = "selected"';
                        break;
        case 'HUF':     $selected_from[64] = 'selected = "selected"';
                        break;
        case 'IDR':     $selected_from[65] = 'selected = "selected"';
                        break;
        case 'IEP':     $selected_from[66] = 'selected = "selected"';
                        break;
        case 'ILS':     $selected_from[67] = 'selected = "selected"';
                        break;
        case 'INR':     $selected_from[68] = 'selected = "selected"';
                        break;
        case 'IQD':     $selected_from[69] = 'selected = "selected"';
                        break;
        case 'IRR':     $selected_from[70] = 'selected = "selected"';
                        break;
        case 'ISK':     $selected_from[71] = 'selected = "selected"';
                        break;
        case 'ITL':     $selected_from[72] = 'selected = "selected"';
                        break;
        case 'JMD':     $selected_from[73] = 'selected = "selected"';
                        break;
        case 'JOD':     $selected_from[74] = 'selected = "selected"';
                        break;
        case 'JPY':     $selected_from[75] = 'selected = "selected"';
                        break;
        case 'KES':     $selected_from[76] = 'selected = "selected"';
                        break;
        case 'KGS':     $selected_from[77] = 'selected = "selected"';
                        break;
        case 'KHR':     $selected_from[78] = 'selected = "selected"';
                        break;
        case 'KMF':     $selected_from[79] = 'selected = "selected"';
                        break;
        case 'KPW':     $selected_from[80] = 'selected = "selected"';
                        break;
        case 'KRW':     $selected_from[81] = 'selected = "selected"';
                        break;
        case 'KWD':     $selected_from[82] = 'selected = "selected"';
                        break;
        case 'KYD':     $selected_from[83] = 'selected = "selected"';
                        break;
        case 'KZT':     $selected_from[84] = 'selected = "selected"';
                        break;
        case 'LAK':     $selected_from[85] = 'selected = "selected"';
                        break;
        case 'LBP':     $selected_from[86] = 'selected = "selected"';
                        break;
        case 'LKR':     $selected_from[87] = 'selected = "selected"';
                        break;
        case 'LRD':     $selected_from[88] = 'selected = "selected"';
                        break;
        case 'LSL':     $selected_from[89] = 'selected = "selected"';
                        break;
        case 'LTL':     $selected_from[90] = 'selected = "selected"';
                        break;
        case 'LVL':     $selected_from[91] = 'selected = "selected"';
                        break;
        case 'LYD':     $selected_from[92] = 'selected = "selected"';
                        break;
        case 'MAD':     $selected_from[93] = 'selected = "selected"';
                        break;
        case 'MDL':     $selected_from[94] = 'selected = "selected"';
                        break;
        case 'MGA':     $selected_from[95] = 'selected = "selected"';
                        break;
        case 'MKD':     $selected_from[96] = 'selected = "selected"';
                        break;
        case 'MMK':     $selected_from[97] = 'selected = "selected"';
                        break;
        case 'MNT':     $selected_from[98] = 'selected = "selected"';
                        break;
        case 'MOP':     $selected_from[99] = 'selected = "selected"';
                        break;
        case 'MRO':     $selected_from[100] = 'selected = "selected"';
                        break;
        case 'MUR':     $selected_from[101] = 'selected = "selected"';
                        break;
        case 'MVR':     $selected_from[102] = 'selected = "selected"';
                        break;
        case 'MWK':     $selected_from[103] = 'selected = "selected"';
                        break;
        case 'MXN':     $selected_from[104] = 'selected = "selected"';
                        break;
        case 'MYR':     $selected_from[105] = 'selected = "selected"';
                        break;
        case 'MZN':     $selected_from[106] = 'selected = "selected"';
                        break;
        case 'NAD':     $selected_from[107] = 'selected = "selected"';
                        break;
        case 'NGN':     $selected_from[108] = 'selected = "selected"';
                        break;
        case 'NIO':     $selected_from[109] = 'selected = "selected"';
                        break;
        case 'NOK':     $selected_from[110] = 'selected = "selected"';
                        break;
        case 'NPR':     $selected_from[111] = 'selected = "selected"';
                        break;
        case 'NZD':     $selected_from[112] = 'selected = "selected"';
                        break;
        case 'OMR':     $selected_from[113] = 'selected = "selected"';
                        break;
        case 'PAB':     $selected_from[114] = 'selected = "selected"';
                        break;
        case 'PEN':     $selected_from[115] = 'selected = "selected"';
                        break;
        case 'PGK':     $selected_from[116] = 'selected = "selected"';
                        break;
        case 'PHP':     $selected_from[117] = 'selected = "selected"';
                        break;
        case 'PKG':     $selected_from[118] = 'selected = "selected"';
                        break;
        case 'PKR':     $selected_from[119] = 'selected = "selected"';
                        break;
        case 'PLN':     $selected_from[120] = 'selected = "selected"';
                        break;
        case 'PYG':     $selected_from[121] = 'selected = "selected"';
                        break;
        case 'QAR':     $selected_from[122] = 'selected = "selected"';
                        break;
        case 'RON':     $selected_from[123] = 'selected = "selected"';
                        break;
        case 'RSD':     $selected_from[124] = 'selected = "selected"';
                        break;
        case 'RUB':     $selected_from[125] = 'selected = "selected"';
                        break;
        case 'RWF':     $selected_from[126] = 'selected = "selected"';
                        break;
        case 'SAR':     $selected_from[127] = 'selected = "selected"';
                        break;
        case 'SBD':     $selected_from[128] = 'selected = "selected"';
                        break;
        case 'SCR':     $selected_from[129] = 'selected = "selected"';
                        break;
        case 'SDG':     $selected_from[130] = 'selected = "selected"';
                        break;
        case 'SEK':     $selected_from[131] = 'selected = "selected"';
                        break;
        case 'SGD':     $selected_from[132] = 'selected = "selected"';
                        break;
        case 'SHP':     $selected_from[133] = 'selected = "selected"';
                        break;
        case 'SKK':     $selected_from[134] = 'selected = "selected"';
                        break;
        case 'SLL':     $selected_from[135] = 'selected = "selected"';
                        break;
        case 'SOS':     $selected_from[136] = 'selected = "selected"';
                        break;
        case 'SRD':     $selected_from[137] = 'selected = "selected"';
                        break;
        case 'STD':     $selected_from[138] = 'selected = "selected"';
                        break;
        case 'SVC':     $selected_from[139] = 'selected = "selected"';
                        break;
        case 'SYP':     $selected_from[140] = 'selected = "selected"';
                        break;
        case 'SZL':     $selected_from[141] = 'selected = "selected"';
                        break;
        case 'THB':     $selected_from[142] = 'selected = "selected"';
                        break;
        case 'TJS':     $selected_from[143] = 'selected = "selected"';
                        break;
        case 'TMT':     $selected_from[144] = 'selected = "selected"';
                        break;
        case 'TND':     $selected_from[145] = 'selected = "selected"';
                        break;
        case 'TOP':     $selected_from[146] = 'selected = "selected"';
                        break;
        case 'TRY':     $selected_from[147] = 'selected = "selected"';
                        break;
        case 'TTD':     $selected_from[148] = 'selected = "selected"';
                        break;
        case 'TWD':     $selected_from[149] = 'selected = "selected"';
                        break;
        case 'TZS':     $selected_from[150] = 'selected = "selected"';
                        break;
        case 'UAH':     $selected_from[151] = 'selected = "selected"';
                        break;
        case 'UGX':     $selected_from[152] = 'selected = "selected"';
                        break;
        case 'USD':     $selected_from[153] = 'selected = "selected"';
                        break;
        case 'UYU':     $selected_from[154] = 'selected = "selected"';
                        break;
        case 'UZS':     $selected_from[155] = 'selected = "selected"';
                        break;
        case 'VEF':     $selected_from[156] = 'selected = "selected"';
                        break;
        case 'VND':     $selected_from[157] = 'selected = "selected"';
                        break;
        case 'VUV':     $selected_from[158] = 'selected = "selected"';
                        break;
        case 'WST':     $selected_from[159] = 'selected = "selected"';
                        break;
        case 'XAF':     $selected_from[160] = 'selected = "selected"';
                        break;
        case 'XCD':     $selected_from[161] = 'selected = "selected"';
                        break;
        case 'XDR':     $selected_from[162] = 'selected = "selected"';
                        break;
        case 'XOF':     $selected_from[163] = 'selected = "selected"';
                        break;
        case 'XPF':     $selected_from[164] = 'selected = "selected"';
                        break;
        case 'YER':     $selected_from[165] = 'selected = "selected"';
                        break;
        case 'ZAR':     $selected_from[166] = 'selected = "selected"';
                        break;
        case 'ZMK':     $selected_from[167] = 'selected = "selected"';
                        break;
        case 'ZMW':     $selected_from[168] = 'selected = "selected"';
                        break;
        case 'ZWL':     $selected_from[169] = 'selected = "selected"';
                        break;
        default:        $selected_from = array_fill(0, 170, '');
    }
}
else
{
        $selected_from[153] = 'selected = "selected"';  //if page is opened for first time, default to USD
}

/******************************************************************************
/Switch statement that checks if current drop down box for the currency_to is
/selected. If it is selected, maintains the selection flag for that specific currency
/*******************************************************************************/
if (isset($_POST['currency_to']))
{
    $temp_variable = $_POST['currency_to'];
    switch($temp_variable)
    {
        case 'AED':     $selected_to[0] = 'selected = "selected"';
                        break;
        case 'AFN':     $selected_to[1] = 'selected = "selected"';
                        break;
        case 'ALL':     $selected_to[2] = 'selected = "selected"';
                        break;
        case 'AMD':     $selected_to[3] = 'selected = "selected"';
                        break;
        case 'ANG':     $selected_to[4] = 'selected = "selected"';
                        break;
        case 'AOA':     $selected_to[5] = 'selected = "selected"';
                        break;
        case 'ARS':     $selected_to[6] = 'selected = "selected"';
                        break;
        case 'AUD':     $selected_to[7] = 'selected = "selected"';
                        break; 
        case 'AWG':     $selected_to[8] = 'selected = "selected"';
                        break;
        case 'AZN':     $selected_to[9] = 'selected = "selected"';
                        break;
        case 'BAM':     $selected_to[10] = 'selected = "selected"';
                        break;
        case 'BBD':     $selected_to[11] = 'selected = "selected"';
                        break;
        case 'BDT':     $selected_to[12] = 'selected = "selected"';
                        break; 
        case 'BGN':     $selected_to[13] = 'selected = "selected"';
                        break; 
        case 'BHD':     $selected_to[14] = 'selected = "selected"';
                        break; 
        case 'BIF':     $selected_to[15] = 'selected = "selected"';
                        break; 
        case 'BMD':     $selected_to[16] = 'selected = "selected"';
                        break; 
        case 'BND':     $selected_to[17] = 'selected = "selected"';
                        break; 
        case 'BOB':     $selected_to[18] = 'selected = "selected"';
                        break; 
        case 'BRL':     $selected_to[19] = 'selected = "selected"';
                        break; 
        case 'BSD':     $selected_to[20] = 'selected = "selected"';
                        break; 
        case 'BTC':     $selected_to[21] = 'selected = "selected"';
                        break; 
        case 'BTN':     $selected_to[22] = 'selected = "selected"';
                        break; 
        case 'BWP':     $selected_to[23] = 'selected = "selected"';
                        break;
        case 'BYN':     $selected_to[24] = 'selected = "selected"';
                        break; 
        case 'BYR':     $selected_to[25] = 'selected = "selected"';
                        break; 
        case 'BZD':     $selected_to[26] = 'selected = "selected"';
                        break; 
        case 'CAD':     $selected_to[27] = 'selected = "selected"';
                        break; 
        case 'CDF':     $selected_to[28] = 'selected = "selected"';
                        break; 
        case 'CHF':     $selected_to[29] = 'selected = "selected"';
                        break; 
        case 'CLF':     $selected_to[30] = 'selected = "selected"';
                        break; 
        case 'CLP':     $selected_to[31] = 'selected = "selected"';
                        break; 
        case 'CNH':     $selected_to[32] = 'selected = "selected"';
                        break; 
        case 'CNY':     $selected_to[33] = 'selected = "selected"';
                        break; 
        case 'COP':     $selected_to[34] = 'selected = "selected"';
                        break; 
        case 'CRC':     $selected_to[35] = 'selected = "selected"';
                        break; 
        case 'CUP':     $selected_to[36] = 'selected = "selected"';
                        break; 
        case 'CVE':     $selected_to[37] = 'selected = "selected"';
                        break; 
        case 'CZK':     $selected_to[38] = 'selected = "selected"';
                        break; 
        case 'DEM':     $selected_to[39] = 'selected = "selected"';
                        break; 
        case 'DJF':     $selected_to[40] = 'selected = "selected"';
                        break;
        case 'DKK':     $selected_to[41] = 'selected = "selected"';
                        break;
        case 'DOP':     $selected_to[42] = 'selected = "selected"';
                        break;
        case 'DZD':     $selected_to[43] = 'selected = "selected"';
                        break;
        case 'EGP':     $selected_to[44] = 'selected = "selected"';
                        break;
        case 'ERN':     $selected_to[45] = 'selected = "selected"';
                        break;
        case 'ETB':     $selected_to[46] = 'selected = "selected"';
                        break;
        case 'EUR':     $selected_to[47] = 'selected = "selected"';
                        break;
        case 'FIM':     $selected_to[48] = 'selected = "selected"';
                        break;
        case 'FJD':     $selected_to[49] = 'selected = "selected"';
                        break;
        case 'FKP':     $selected_to[50] = 'selected = "selected"';
                        break;
        case 'FRF':     $selected_to[51] = 'selected = "selected"';
                        break;
        case 'GBP':     $selected_to[52] = 'selected = "selected"';
                        break;
        case 'GEL':     $selected_to[53] = 'selected = "selected"';
                        break;
        case 'GHS':     $selected_to[54] = 'selected = "selected"';
                        break;
        case 'GIP':     $selected_to[55] = 'selected = "selected"';
                        break;
        case 'GMD':     $selected_to[56] = 'selected = "selected"';
                        break;
        case 'GNF':     $selected_to[57] = 'selected = "selected"';
                        break;
        case 'GTQ':     $selected_to[58] = 'selected = "selected"';
                        break;
        case 'GYD':     $selected_to[59] = 'selected = "selected"';
                        break;
        case 'HKD':     $selected_to[60] = 'selected = "selected"';
                        break;
        case 'HNL':     $selected_to[61] = 'selected = "selected"';
                        break;
        case 'HRK':     $selected_to[62] = 'selected = "selected"';
                        break;
        case 'HTG':     $selected_to[63] = 'selected = "selected"';
                        break;
        case 'HUF':     $selected_to[64] = 'selected = "selected"';
                        break;
        case 'IDR':     $selected_to[65] = 'selected = "selected"';
                        break;
        case 'IEP':     $selected_to[66] = 'selected = "selected"';
                        break;
        case 'ILS':     $selected_to[67] = 'selected = "selected"';
                        break;
        case 'INR':     $selected_to[68] = 'selected = "selected"';
                        break;
        case 'IQD':     $selected_to[69] = 'selected = "selected"';
                        break;
        case 'IRR':     $selected_to[70] = 'selected = "selected"';
                        break;
        case 'ISK':     $selected_to[71] = 'selected = "selected"';
                        break;
        case 'ITL':     $selected_to[72] = 'selected = "selected"';
                        break;
        case 'JMD':     $selected_to[73] = 'selected = "selected"';
                        break;
        case 'JOD':     $selected_to[74] = 'selected = "selected"';
                        break;
        case 'JPY':     $selected_to[75] = 'selected = "selected"';
                        break;
        case 'KES':     $selected_to[76] = 'selected = "selected"';
                        break;
        case 'KGS':     $selected_to[77] = 'selected = "selected"';
                        break;
        case 'KHR':     $selected_to[78] = 'selected = "selected"';
                        break;
        case 'KMF':     $selected_to[79] = 'selected = "selected"';
                        break;
        case 'KPW':     $selected_to[80] = 'selected = "selected"';
                        break;
        case 'KRW':     $selected_to[81] = 'selected = "selected"';
                        break;
        case 'KWD':     $selected_to[82] = 'selected = "selected"';
                        break;
        case 'KYD':     $selected_to[83] = 'selected = "selected"';
                        break;
        case 'KZT':     $selected_to[84] = 'selected = "selected"';
                        break;
        case 'LAK':     $selected_to[85] = 'selected = "selected"';
                        break;
        case 'LBP':     $selected_to[86] = 'selected = "selected"';
                        break;
        case 'LKR':     $selected_to[87] = 'selected = "selected"';
                        break;
        case 'LRD':     $selected_to[88] = 'selected = "selected"';
                        break;
        case 'LSL':     $selected_to[89] = 'selected = "selected"';
                        break;
        case 'LTL':     $selected_to[90] = 'selected = "selected"';
                        break;
        case 'LVL':     $selected_to[91] = 'selected = "selected"';
                        break;
        case 'LYD':     $selected_to[92] = 'selected = "selected"';
                        break;
        case 'MAD':     $selected_to[93] = 'selected = "selected"';
                        break;
        case 'MDL':     $selected_to[94] = 'selected = "selected"';
                        break;
        case 'MGA':     $selected_to[95] = 'selected = "selected"';
                        break;
        case 'MKD':     $selected_to[96] = 'selected = "selected"';
                        break;
        case 'MMK':     $selected_to[97] = 'selected = "selected"';
                        break;
        case 'MNT':     $selected_to[98] = 'selected = "selected"';
                        break;
        case 'MOP':     $selected_to[99] = 'selected = "selected"';
                        break;
        case 'MRO':     $selected_to[100] = 'selected = "selected"';
                        break;
        case 'MUR':     $selected_to[101] = 'selected = "selected"';
                        break;
        case 'MVR':     $selected_to[102] = 'selected = "selected"';
                        break;
        case 'MWK':     $selected_to[103] = 'selected = "selected"';
                        break;
        case 'MXN':     $selected_to[104] = 'selected = "selected"';
                        break;
        case 'MYR':     $selected_to[105] = 'selected = "selected"';
                        break;
        case 'MZN':     $selected_to[106] = 'selected = "selected"';
                        break;
        case 'NAD':     $selected_to[107] = 'selected = "selected"';
                        break;
        case 'NGN':     $selected_to[108] = 'selected = "selected"';
                        break;
        case 'NIO':     $selected_to[109] = 'selected = "selected"';
                        break;
        case 'NOK':     $selected_to[110] = 'selected = "selected"';
                        break;
        case 'NPR':     $selected_to[111] = 'selected = "selected"';
                        break;
        case 'NZD':     $selected_to[112] = 'selected = "selected"';
                        break;
        case 'OMR':     $selected_to[113] = 'selected = "selected"';
                        break;
        case 'PAB':     $selected_to[114] = 'selected = "selected"';
                        break;
        case 'PEN':     $selected_to[115] = 'selected = "selected"';
                        break;
        case 'PGK':     $selected_to[116] = 'selected = "selected"';
                        break;
        case 'PHP':     $selected_to[117] = 'selected = "selected"';
                        break;
        case 'PKG':     $selected_to[118] = 'selected = "selected"';
                        break;
        case 'PKR':     $selected_to[119] = 'selected = "selected"';
                        break;
        case 'PLN':     $selected_to[120] = 'selected = "selected"';
                        break;
        case 'PYG':     $selected_to[121] = 'selected = "selected"';
                        break;
        case 'QAR':     $selected_to[122] = 'selected = "selected"';
                        break;
        case 'RON':     $selected_to[123] = 'selected = "selected"';
                        break;
        case 'RSD':     $selected_to[124] = 'selected = "selected"';
                        break;
        case 'RUB':     $selected_to[125] = 'selected = "selected"';
                        break;
        case 'RWF':     $selected_to[126] = 'selected = "selected"';
                        break;
        case 'SAR':     $selected_to[127] = 'selected = "selected"';
                        break;
        case 'SBD':     $selected_to[128] = 'selected = "selected"';
                        break;
        case 'SCR':     $selected_to[129] = 'selected = "selected"';
                        break;
        case 'SDG':     $selected_to[130] = 'selected = "selected"';
                        break;
        case 'SEK':     $selected_to[131] = 'selected = "selected"';
                        break;
        case 'SGD':     $selected_to[132] = 'selected = "selected"';
                        break;
        case 'SHP':     $selected_to[133] = 'selected = "selected"';
                        break;
        case 'SKK':     $selected_to[134] = 'selected = "selected"';
                        break;
        case 'SLL':     $selected_to[135] = 'selected = "selected"';
                        break;
        case 'SOS':     $selected_to[136] = 'selected = "selected"';
                        break;
        case 'SRD':     $selected_to[137] = 'selected = "selected"';
                        break;
        case 'STD':     $selected_to[138] = 'selected = "selected"';
                        break;
        case 'SVC':     $selected_to[139] = 'selected = "selected"';
                        break;
        case 'SYP':     $selected_to[140] = 'selected = "selected"';
                        break;
        case 'SZL':     $selected_to[141] = 'selected = "selected"';
                        break;
        case 'THB':     $selected_to[142] = 'selected = "selected"';
                        break;
        case 'TJS':     $selected_to[143] = 'selected = "selected"';
                        break;
        case 'TMT':     $selected_to[144] = 'selected = "selected"';
                        break;
        case 'TND':     $selected_to[145] = 'selected = "selected"';
                        break;
        case 'TOP':     $selected_to[146] = 'selected = "selected"';
                        break;
        case 'TRY':     $selected_to[147] = 'selected = "selected"';
                        break;
        case 'TTD':     $selected_to[148] = 'selected = "selected"';
                        break;
        case 'TWD':     $selected_to[149] = 'selected = "selected"';
                        break;
        case 'TZS':     $selected_to[150] = 'selected = "selected"';
                        break;
        case 'UAH':     $selected_to[151] = 'selected = "selected"';
                        break;
        case 'UGX':     $selected_to[152] = 'selected = "selected"';
                        break;
        case 'USD':     $selected_to[153] = 'selected = "selected"';
                        break;
        case 'UYU':     $selected_to[154] = 'selected = "selected"';
                        break;
        case 'UZS':     $selected_to[155] = 'selected = "selected"';
                        break;
        case 'VEF':     $selected_to[156] = 'selected = "selected"';
                        break;
        case 'VND':     $selected_to[157] = 'selected = "selected"';
                        break;
        case 'VUV':     $selected_to[158] = 'selected = "selected"';
                        break;
        case 'WST':     $selected_to[159] = 'selected = "selected"';
                        break;
        case 'XAF':     $selected_to[160] = 'selected = "selected"';
                        break;
        case 'XCD':     $selected_to[161] = 'selected = "selected"';
                        break;
        case 'XDR':     $selected_to[162] = 'selected = "selected"';
                        break;
        case 'XOF':     $selected_to[163] = 'selected = "selected"';
                        break;
        case 'XPF':     $selected_to[164] = 'selected = "selected"';
                        break;
        case 'YER':     $selected_to[165] = 'selected = "selected"';
                        break;
        case 'ZAR':     $selected_to[166] = 'selected = "selected"';
                        break;
        case 'ZMK':     $selected_to[167] = 'selected = "selected"';
                        break;
        case 'ZMW':     $selected_to[168] = 'selected = "selected"';
                        break;
        case 'ZWL':     $selected_to[169] = 'selected = "selected"';
                        break;
        default:        $selected_to = array_fill(0, 170, '');
    }
}
else
{
            $selected_to[117] = 'selected = "selected"';    //if page is opened for the first time, set "to" to PHP
}

//Print the html file
echo <<<_END
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
       	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Currency conversion</title>
        <link href="CSS/bootstrap.min.css" rel="stylesheet">
        <link href="CSS/main.css" rel="stylesheet">
	</head>
	<body>
	<form method="post" action="index.php" class = "container">
        <h1>Currency Converter</h1>
		<input type="text" name="currency_input" placeholder = "Enter an amount. . ." autofocus/>
        <br />
        <label>Select currency (from):</label>
        <select name="currency_from">
		<option  value="AED" $selected_from[0]>United Arab Emirates Dirham</option>
		<option  value="AFN" $selected_from[1]>Afghan Afghani</option>
		<option  value="ALL" $selected_from[2]>Albanian Lek</option>
		<option  value="AMD" $selected_from[3]>Armenian Dram</option>
		<option  value="ANG" $selected_from[4]>Netherlands Antillean Guilder</option>
		<option  value="AOA" $selected_from[5]>Angolan Kwanza</option>
		<option  value="ARS" $selected_from[6]>Argentine Peso</option>
		<option  value="AUD" $selected_from[7]>Australian Dollar</option>
		<option  value="AWG" $selected_from[8]>Aruban Florin</option>
		<option  value="AZN" $selected_from[9]>Azerbaijani Manat</option>
		<option  value="BAM" $selected_from[10]>Bosnia-Herzegovina Convertible Mark</option>
		<option  value="BBD" $selected_from[11]>Barbadian Dollar</option>
		<option  value="BDT" $selected_from[12]>Bangladeshi Taka</option>
		<option  value="BGN" $selected_from[13]>Bulgarian Lev</option>
		<option  value="BHD" $selected_from[14]>Bahraini Dinar</option>
		<option  value="BIF" $selected_from[15]>Burundian Franc</option>
		<option  value="BMD" $selected_from[16]>Bermudan Dollar</option>
		<option  value="BND" $selected_from[17]>Brunei Dollar</option>
		<option  value="BOB" $selected_from[18]>Bolivian Boliviano</option>
		<option  value="BRL" $selected_from[19]>Brazilian Real</option>
		<option  value="BSD" $selected_from[20]>Bahamian Dollar</option>
		<option  value="BTC" $selected_from[21]>Bitcoin</option>
		<option  value="BTN" $selected_from[22]>Bhutanese Ngultrum</option>
		<option  value="BWP" $selected_from[23]>Botswanan Pula</option>
		<option  value="BYN" $selected_from[24]>Belarusian Ruble</option>
		<option  value="BYR" $selected_from[25]>Belarusian Ruble (2000-2016)</option>
		<option  value="BZD" $selected_from[26]>Belize Dollar</option>
		<option  value="CAD" $selected_from[27]>Canadian Dollar</option>
		<option  value="CDF" $selected_from[28]>Congolese Franc</option>
		<option  value="CHF" $selected_from[29]>Swiss Franc</option>
		<option  value="CLF" $selected_from[30]>Chilean Unit of Account</option>
		<option  value="CLP" $selected_from[31]>Chilean Peso</option>
		<option  value="CNH" $selected_from[32]>CNH</option>
		<option  value="CNY" $selected_from[33]>Chinese Yuan</option>
		<option  value="COP" $selected_from[34]>Colombian Peso</option>
		<option  value="CRC" $selected_from[35]>Costa Rican Colon</option>
		<option  value="CUP" $selected_from[36]>Cuban Peso</option>
		<option  value="CVE" $selected_from[37]>Cape Verdean Escudo</option>
		<option  value="CZK" $selected_from[38]>Czech Republic Koruna</option>
		<option  value="DEM" $selected_from[39]>German Mark</option>
		<option  value="DJF" $selected_from[40]>Djiboutian Franc</option>
		<option  value="DKK" $selected_from[41]>Danish Krone</option>
		<option  value="DOP" $selected_from[42]>Dominican Peso</option>
		<option  value="DZD" $selected_from[43]>Algerian Dinar</option>
		<option  value="EGP" $selected_from[44]>Egyptian Pound</option>
		<option  value="ERN" $selected_from[45]>Eritrean Nakfa</option>
		<option  value="ETB" $selected_from[46]>Ethiopian Birr</option>
		<option  value="EUR" $selected_from[47]>Euro</option>
		<option  value="FIM" $selected_from[48]>Finnish Markka</option>
		<option  value="FJD" $selected_from[49]>Fijian Dollar</option>
		<option  value="FKP" $selected_from[50]>Falkland Islands Pound</option>
		<option  value="FRF" $selected_from[51]>French Franc</option>
		<option  value="GBP" $selected_from[52]>British Pound</option>
		<option  value="GEL" $selected_from[53]>Georgian Lari</option>
		<option  value="GHS" $selected_from[54]>Ghanaian Cedi</option>
		<option  value="GIP" $selected_from[55]>Gibraltar Pound</option>
		<option  value="GMD" $selected_from[56]>Gambian Dalasi</option>
		<option  value="GNF" $selected_from[57]>Guinean Franc</option>
		<option  value="GTQ" $selected_from[58]>Guatemalan Quetzal</option>
		<option  value="GYD" $selected_from[59]>Guyanaese Dollar</option>
		<option  value="HKD" $selected_from[60]>Hong Kong Dollar</option>
		<option  value="HNL" $selected_from[61]>Honduran Lempira</option>
		<option  value="HRK" $selected_from[62]>Croatian Kuna</option>
		<option  value="HTG" $selected_from[63]>Haitian Gourde</option>
		<option  value="HUF" $selected_from[64]>Hungarian Forint</option>
		<option  value="IDR" $selected_from[65]>Indonesian Rupiah</option>
		<option  value="IEP" $selected_from[66]>Irish Pound</option>
		<option  value="ILS" $selected_from[67]>Israeli New Sheqel</option>
		<option  value="INR" $selected_from[68]>Indian Rupee</option>
		<option  value="IQD" $selected_from[69]>Iraqi Dinar</option>
		<option  value="IRR" $selected_from[70]>Iranian Rial</option>
		<option  value="ISK" $selected_from[71]>Icelandic Krona</option>
		<option  value="ITL" $selected_from[72]>Italian Lira</option>
		<option  value="JMD" $selected_from[73]>Jamaican Dollar</option>
		<option  value="JOD" $selected_from[74]>Jordanian Dinar</option>
		<option  value="JPY" $selected_from[75]>Japanese Yen</option>
		<option  value="KES" $selected_from[76]>Kenyan Shilling</option>
		<option  value="KGS" $selected_from[77]>Kyrgystani Som</option>
		<option  value="KHR" $selected_from[78]>Cambodian Riel</option>
		<option  value="KMF" $selected_from[79]>Comorian Franc</option>
		<option  value="KPW" $selected_from[80]>North Korean Won</option>
		<option  value="KRW" $selected_from[81]>South Korean Won</option>
		<option  value="KWD" $selected_from[82]>Kuwaiti Dinar</option>
		<option  value="KYD" $selected_from[83]>Cayman Islands Dollar</option>
		<option  value="KZT" $selected_from[84]>Kazakhstani Tenge</option>
		<option  value="LAK" $selected_from[85]>Laotian Kip</option>
		<option  value="LBP" $selected_from[86]>Lebanese Pound</option>
		<option  value="LKR" $selected_from[87]>Sri Lankan Rupee</option>
		<option  value="LRD" $selected_from[88]>Liberian Dollar</option>
		<option  value="LSL" $selected_from[89]>Lesotho Loti</option>
		<option  value="LTL" $selected_from[90]>Lithuanian Litas</option>
		<option  value="LVL" $selected_from[91]>Latvian Lats</option>
		<option  value="LYD" $selected_from[92]>Libyan Dinar</option>
		<option  value="MAD" $selected_from[93]>Moroccan Dirham</option>
		<option  value="MDL" $selected_from[94]>Moldovan Leu</option>
		<option  value="MGA" $selected_from[95]>Malagasy Ariary</option>
		<option  value="MKD" $selected_from[96]>Macedonian Denar</option>
		<option  value="MMK" $selected_from[97]>Myanmar Kyat</option>
		<option  value="MNT" $selected_from[98]>Mongolian Tugrik</option>
		<option  value="MOP" $selected_from[99]>Macanese Pataca</option>
		<option  value="MRO" $selected_from[100]>Mauritanian Ouguiya</option>
		<option  value="MUR" $selected_from[101]>Mauritian Rupee</option>
		<option  value="MVR" $selected_from[102]>Maldivian Rufiyaa</option>
		<option  value="MWK" $selected_from[103]>Malawian Kwacha</option>
		<option  value="MXN" $selected_from[104]>Mexican Peso</option>
		<option  value="MYR" $selected_from[105]>Malaysian Ringgit</option>
		<option  value="MZN" $selected_from[106]>Mozambican Metical</option>
		<option  value="NAD" $selected_from[107]>Namibian Dollar</option>
		<option  value="NGN" $selected_from[108]>Nigerian Naira</option>	
		<option  value="NIO" $selected_from[109]>Nicaraguan Cordoba</option>
		<option  value="NOK" $selected_from[110]>Norwegian Krone</option>
		<option  value="NPR" $selected_from[111]>Nepalese Rupee</option>
		<option  value="NZD" $selected_from[112]>New Zealand Dollar</option>
		<option  value="OMR" $selected_from[113]>Omani Rial</option>
		<option  value="PAB" $selected_from[114]>Panamanian Balboa</option>
		<option  value="PEN" $selected_from[115]>Peruvian Nuevo Sol</option>
		<option  value="PGK" $selected_from[116]>Papua New Guinean Kina</option>
		<option  value="PHP" $selected_from[117]>Philippine Peso</option>
		<option  value="PKG" $selected_from[118]>PKG</option>
		<option  value="PKR" $selected_from[119]>Pakistani Rupee</option>
		<option  value="PLN" $selected_from[120]>Polish Zloty</option>
		<option  value="PYG" $selected_from[121]>Paraguayan Guarani</option>
		<option  value="QAR" $selected_from[122]>Qatari Rial</option>
		<option  value="RON" $selected_from[123]>Romanian Leu</option>
		<option  value="RSD" $selected_from[124]>Serbian Dinar</option>
		<option  value="RUB" $selected_from[125]>Russian Ruble</option>
		<option  value="RWF" $selected_from[126]>Rwandan Franc</option>
		<option  value="SAR" $selected_from[127]>Saudi Riyal</option>
		<option  value="SBD" $selected_from[128]>Solomon Islands Dollar</option>
		<option  value="SCR" $selected_from[129]>Seychellois Rupee</option>
		<option  value="SDG" $selected_from[130]>Sudanese Pound</option>
		<option  value="SEK" $selected_from[131]>Swedish Krona</option>
		<option  value="SGD" $selected_from[132]>Singapore Dollar</option>
		<option  value="SHP" $selected_from[133]>St. Helena Pound</option>
		<option  value="SKK" $selected_from[134]>Slovak Koruna</option>
		<option  value="SLL" $selected_from[135]>Sierra Leonean Leone</option>
		<option  value="SOS" $selected_from[136]>Somali Shilling</option>
		<option  value="SRD" $selected_from[137]>Surinamese Dollar</option>
		<option  value="STD" $selected_from[138]>Sao Tome &amp; Principe Dobra</option>
		<option  value="SVC" $selected_from[139]>Salvadoran Colon</option>
		<option  value="SYP" $selected_from[140]>Syrian Pound</option>
		<option  value="SZL" $selected_from[141]>Swazi Lilangeni</option>
		<option  value="THB" $selected_from[142]>Thai Baht</option>
		<option  value="TJS" $selected_from[143]>Tajikistani Somoni</option>
		<option  value="TMT" $selected_from[144]>Turkmenistani Manat</option>
		<option  value="TND" $selected_from[145]>Tunisian Dinar</option>
		<option  value="TOP" $selected_from[146]>Tongan Paʻanga</option>
		<option  value="TRY" $selected_from[147]>Turkish Lira</option>
		<option  value="TTD" $selected_from[148]>Trinidad &amp; Tobago Dollar</option>
		<option  value="TWD" $selected_from[149]>New Taiwan Dollar</option>
		<option  value="TZS" $selected_from[150]>Tanzanian Shilling</option>
		<option  value="UAH" $selected_from[151]>Ukrainian Hryvnia</option>
		<option  value="UGX" $selected_from[152]>Ugandan Shilling</option>
		<option  value="USD" $selected_from[153]>US Dollar</option>
		<option  value="UYU" $selected_from[154]>Uruguayan Peso</option>
		<option  value="UZS" $selected_from[155]>Uzbekistani Som</option>
		<option  value="VEF" $selected_from[156]>Venezuelan Bolivar</option>
		<option  value="VND" $selected_from[157]>Vietnamese Dong</option>
		<option  value="VUV" $selected_from[158]>Vanuatu Vatu</option>
		<option  value="WST" $selected_from[159]>Samoan Tala</option>
		<option  value="XAF" $selected_from[160]>Central African CFA Franc</option>
		<option  value="XCD" $selected_from[161]>East Caribbean Dollar</option>
		<option  value="XDR" $selected_from[162]>Special Drawing Rights</option>
		<option  value="XOF" $selected_from[163]>West African CFA Franc</option>
		<option  value="XPF" $selected_from[164]>CFP Franc</option>
		<option  value="YER" $selected_from[165]>Yemeni Rial</option>
		<option  value="ZAR" $selected_from[166]>South African Rand</option>
		<option  value="ZMK" $selected_from[167]>Zambian Kwacha (1968-2012)</option>
		<option  value="ZMW" $selected_from[168]>Zambian Kwacha</option>
		<option  value="ZWL" $selected_from[169]>Zimbabwean Dollar (2009)</option>
        </select>
        <label>Select currency (to):</label>
        <select name="currency_to">
		<option  value="AED" $selected_to[0]>United Arab Emirates Dirham</option>
		<option  value="AFN" $selected_to[1]>Afghan Afghani</option>
		<option  value="ALL" $selected_to[2]>Albanian Lek</option>
		<option  value="AMD" $selected_to[3]>Armenian Dram</option>
		<option  value="ANG" $selected_to[4]>Netherlands Antillean Guilder</option>
		<option  value="AOA" $selected_to[5]>Angolan Kwanza</option>
		<option  value="ARS" $selected_to[6]>Argentine Peso</option>
		<option  value="AUD" $selected_to[7]>Australian Dollar</option>
		<option  value="AWG" $selected_to[8]>Aruban Florin</option>
		<option  value="AZN" $selected_to[9]>Azerbaijani Manat</option>
		<option  value="BAM" $selected_to[10]>Bosnia-Herzegovina Convertible Mark</option>
		<option  value="BBD" $selected_to[11]>Barbadian Dollar</option>
		<option  value="BDT" $selected_to[12]>Bangladeshi Taka</option>
		<option  value="BGN" $selected_to[13]>Bulgarian Lev</option>
		<option  value="BHD" $selected_to[14]>Bahraini Dinar</option>
		<option  value="BIF" $selected_to[15]>Burundian Franc</option>
		<option  value="BMD" $selected_to[16]>Bermudan Dollar</option>
		<option  value="BND" $selected_to[17]>Brunei Dollar</option>
		<option  value="BOB" $selected_to[18]>Bolivian Boliviano</option>
		<option  value="BRL" $selected_to[19]>Brazilian Real</option>
		<option  value="BSD" $selected_to[20]>Bahamian Dollar</option>
		<option  value="BTC" $selected_to[21]>Bitcoin</option>
		<option  value="BTN" $selected_to[22]>Bhutanese Ngultrum</option>
		<option  value="BWP" $selected_to[23]>Botswanan Pula</option>
		<option  value="BYN" $selected_to[24]>Belarusian Ruble</option>
		<option  value="BYR" $selected_to[25]>Belarusian Ruble (2000-2016)</option>
		<option  value="BZD" $selected_to[26]>Belize Dollar</option>
		<option  value="CAD" $selected_to[27]>Canadian Dollar</option>
		<option  value="CDF" $selected_to[28]>Congolese Franc</option>
		<option  value="CHF" $selected_to[29]>Swiss Franc</option>
		<option  value="CLF" $selected_to[30]>Chilean Unit of Account</option>
		<option  value="CLP" $selected_to[31]>Chilean Peso</option>
		<option  value="CNH" $selected_to[32]>CNH</option>
		<option  value="CNY" $selected_to[33]>Chinese Yuan</option>
		<option  value="COP" $selected_to[34]>Colombian Peso</option>
		<option  value="CRC" $selected_to[35]>Costa Rican Colon</option>
		<option  value="CUP" $selected_to[36]>Cuban Peso</option>
		<option  value="CVE" $selected_to[37]>Cape Verdean Escudo</option>
		<option  value="CZK" $selected_to[38]>Czech Republic Koruna</option>
		<option  value="DEM" $selected_to[39]>German Mark</option>
		<option  value="DJF" $selected_to[40]>Djiboutian Franc</option>
		<option  value="DKK" $selected_to[41]>Danish Krone</option>
		<option  value="DOP" $selected_to[42]>Dominican Peso</option>
		<option  value="DZD" $selected_to[43]>Algerian Dinar</option>
		<option  value="EGP" $selected_to[44]>Egyptian Pound</option>
		<option  value="ERN" $selected_to[45]>Eritrean Nakfa</option>
		<option  value="ETB" $selected_to[46]>Ethiopian Birr</option>
		<option  value="EUR" $selected_to[47]>Euro</option>
		<option  value="FIM" $selected_to[48]>Finnish Markka</option>
		<option  value="FJD" $selected_to[49]>Fijian Dollar</option>
		<option  value="FKP" $selected_to[50]>Falkland Islands Pound</option>
		<option  value="FRF" $selected_to[51]>French Franc</option>
		<option  value="GBP" $selected_to[52]>British Pound</option>
		<option  value="GEL" $selected_to[53]>Georgian Lari</option>
		<option  value="GHS" $selected_to[54]>Ghanaian Cedi</option>
		<option  value="GIP" $selected_to[55]>Gibraltar Pound</option>
		<option  value="GMD" $selected_to[56]>Gambian Dalasi</option>
		<option  value="GNF" $selected_to[57]>Guinean Franc</option>
		<option  value="GTQ" $selected_to[58]>Guatemalan Quetzal</option>
		<option  value="GYD" $selected_to[59]>Guyanaese Dollar</option>
		<option  value="HKD" $selected_to[60]>Hong Kong Dollar</option>
		<option  value="HNL" $selected_to[61]>Honduran Lempira</option>
		<option  value="HRK" $selected_to[62]>Croatian Kuna</option>
		<option  value="HTG" $selected_to[63]>Haitian Gourde</option>
		<option  value="HUF" $selected_to[64]>Hungarian Forint</option>
		<option  value="IDR" $selected_to[65]>Indonesian Rupiah</option>
		<option  value="IEP" $selected_to[66]>Irish Pound</option>
		<option  value="ILS" $selected_to[67]>Israeli New Sheqel</option>
		<option  value="INR" $selected_to[68]>Indian Rupee</option>
		<option  value="IQD" $selected_to[69]>Iraqi Dinar</option>
		<option  value="IRR" $selected_to[70]>Iranian Rial</option>
		<option  value="ISK" $selected_to[71]>Icelandic Krona</option>
		<option  value="ITL" $selected_to[72]>Italian Lira</option>
		<option  value="JMD" $selected_to[73]>Jamaican Dollar</option>
		<option  value="JOD" $selected_to[74]>Jordanian Dinar</option>
		<option  value="JPY" $selected_to[75]>Japanese Yen</option>
		<option  value="KES" $selected_to[76]>Kenyan Shilling</option>
		<option  value="KGS" $selected_to[77]>Kyrgystani Som</option>
		<option  value="KHR" $selected_to[78]>Cambodian Riel</option>
		<option  value="KMF" $selected_to[79]>Comorian Franc</option>
		<option  value="KPW" $selected_to[80]>North Korean Won</option>
		<option  value="KRW" $selected_to[81]>South Korean Won</option>
		<option  value="KWD" $selected_to[82]>Kuwaiti Dinar</option>
		<option  value="KYD" $selected_to[83]>Cayman Islands Dollar</option>
		<option  value="KZT" $selected_to[84]>Kazakhstani Tenge</option>
		<option  value="LAK" $selected_to[85]>Laotian Kip</option>
		<option  value="LBP" $selected_to[86]>Lebanese Pound</option>
		<option  value="LKR" $selected_to[87]>Sri Lankan Rupee</option>
		<option  value="LRD" $selected_to[88]>Liberian Dollar</option>
		<option  value="LSL" $selected_to[89]>Lesotho Loti</option>
		<option  value="LTL" $selected_to[90]>Lithuanian Litas</option>
		<option  value="LVL" $selected_to[91]>Latvian Lats</option>
		<option  value="LYD" $selected_to[92]>Libyan Dinar</option>
		<option  value="MAD" $selected_to[93]>Moroccan Dirham</option>
		<option  value="MDL" $selected_to[94]>Moldovan Leu</option>
		<option  value="MGA" $selected_to[95]>Malagasy Ariary</option>
		<option  value="MKD" $selected_to[96]>Macedonian Denar</option>
		<option  value="MMK" $selected_to[97]>Myanmar Kyat</option>
		<option  value="MNT" $selected_to[98]>Mongolian Tugrik</option>
		<option  value="MOP" $selected_to[99]>Macanese Pataca</option>
		<option  value="MRO" $selected_to[100]>Mauritanian Ouguiya</option>
		<option  value="MUR" $selected_to[101]>Mauritian Rupee</option>
		<option  value="MVR" $selected_to[102]>Maldivian Rufiyaa</option>
		<option  value="MWK" $selected_to[103]>Malawian Kwacha</option>
		<option  value="MXN" $selected_to[104]>Mexican Peso</option>
		<option  value="MYR" $selected_to[105]>Malaysian Ringgit</option>
		<option  value="MZN" $selected_to[106]>Mozambican Metical</option>
		<option  value="NAD" $selected_to[107]>Namibian Dollar</option>
		<option  value="NGN" $selected_to[108]>Nigerian Naira</option>	
		<option  value="NIO" $selected_to[109]>Nicaraguan Cordoba</option>
		<option  value="NOK" $selected_to[110]>Norwegian Krone</option>
		<option  value="NPR" $selected_to[111]>Nepalese Rupee</option>
		<option  value="NZD" $selected_to[112]>New Zealand Dollar</option>
		<option  value="OMR" $selected_to[113]>Omani Rial</option>
		<option  value="PAB" $selected_to[114]>Panamanian Balboa</option>
		<option  value="PEN" $selected_to[115]>Peruvian Nuevo Sol</option>
		<option  value="PGK" $selected_to[116]>Papua New Guinean Kina</option>
		<option  value="PHP" $selected_to[117]>Philippine Peso</option>
		<option  value="PKG" $selected_to[118]>PKG</option>
		<option  value="PKR" $selected_to[119]>Pakistani Rupee</option>
		<option  value="PLN" $selected_to[120]>Polish Zloty</option>
		<option  value="PYG" $selected_to[121]>Paraguayan Guarani</option>
		<option  value="QAR" $selected_to[122]>Qatari Rial</option>
		<option  value="RON" $selected_to[123]>Romanian Leu</option>
		<option  value="RSD" $selected_to[124]>Serbian Dinar</option>
		<option  value="RUB" $selected_to[125]>Russian Ruble</option>
		<option  value="RWF" $selected_to[126]>Rwandan Franc</option>
		<option  value="SAR" $selected_to[127]>Saudi Riyal</option>
		<option  value="SBD" $selected_to[128]>Solomon Islands Dollar</option>
		<option  value="SCR" $selected_to[129]>Seychellois Rupee</option>
		<option  value="SDG" $selected_to[130]>Sudanese Pound</option>
		<option  value="SEK" $selected_to[131]>Swedish Krona</option>
		<option  value="SGD" $selected_to[132]>Singapore Dollar</option>
		<option  value="SHP" $selected_to[133]>St. Helena Pound</option>
		<option  value="SKK" $selected_to[134]>Slovak Koruna</option>
		<option  value="SLL" $selected_to[135]>Sierra Leonean Leone</option>
		<option  value="SOS" $selected_to[136]>Somali Shilling</option>
		<option  value="SRD" $selected_to[137]>Surinamese Dollar</option>
		<option  value="STD" $selected_to[138]>Sao Tome &amp; Principe Dobra</option>
		<option  value="SVC" $selected_to[139]>Salvadoran Colon</option>
		<option  value="SYP" $selected_to[140]>Syrian Pound</option>
		<option  value="SZL" $selected_to[141]>Swazi Lilangeni</option>
		<option  value="THB" $selected_to[142]>Thai Baht</option>
		<option  value="TJS" $selected_to[143]>Tajikistani Somoni</option>
		<option  value="TMT" $selected_to[144]>Turkmenistani Manat</option>
		<option  value="TND" $selected_to[145]>Tunisian Dinar</option>
		<option  value="TOP" $selected_to[146]>Tongan Paʻanga</option>
		<option  value="TRY" $selected_to[147]>Turkish Lira</option>
		<option  value="TTD" $selected_to[148]>Trinidad &amp; Tobago Dollar</option>
		<option  value="TWD" $selected_to[149]>New Taiwan Dollar</option>
		<option  value="TZS" $selected_to[150]>Tanzanian Shilling</option>
		<option  value="UAH" $selected_to[151]>Ukrainian Hryvnia</option>
		<option  value="UGX" $selected_to[152]>Ugandan Shilling</option>
		<option  value="USD" $selected_to[153]>US Dollar</option>
		<option  value="UYU" $selected_to[154]>Uruguayan Peso</option>
		<option  value="UZS" $selected_to[155]>Uzbekistani Som</option>
		<option  value="VEF" $selected_to[156]>Venezuelan Bolivar</option>
		<option  value="VND" $selected_to[157]>Vietnamese Dong</option>
		<option  value="VUV" $selected_to[158]>Vanuatu Vatu</option>
		<option  value="WST" $selected_to[159]>Samoan Tala</option>
		<option  value="XAF" $selected_to[160]>Central African CFA Franc</option>
		<option  value="XCD" $selected_to[161]>East Caribbean Dollar</option>
		<option  value="XDR" $selected_to[162]>Special Drawing Rights</option>
		<option  value="XOF" $selected_to[163]>West African CFA Franc</option>
		<option  value="XPF" $selected_to[164]>CFP Franc</option>
		<option  value="YER" $selected_to[165]>Yemeni Rial</option>
		<option  value="ZAR" $selected_to[166]>South African Rand</option>
		<option  value="ZMK" $selected_to[167]>Zambian Kwacha (1968-2012)</option>
		<option  value="ZMW" $selected_to[168]>Zambian Kwacha</option>
		<option  value="ZWL" $selected_to[169]>Zimbabwean Dollar (2009)</option>
        </select>
        <br /> <br />
		<input type="submit" value="Convert!" class = "button"/>
        <p>$result</p>
	</form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
	</body>
</html>
_END;
?>

