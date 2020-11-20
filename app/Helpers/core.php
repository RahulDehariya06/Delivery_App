<?php
/**
 * Get the login field
 *
 * @param $value
 * @return string
 */
function getLoginField($value)
{
	$field = 'username';
	if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
		$field = 'email';
	} else if (preg_match('/^((\+|00)\d{1,3})?[\s\d]+$/', $value)) {
		$field = 'phone';
	}
	
	return $field;
}
/**
 * Get Phone's International Format
 *
 * @param $phone
 * @param null $countryCode
 * @param int $format
 * @return \libphonenumber\PhoneNumberUtil|mixed|string
 */
function phoneFormatInt($phone, $countryCode = null, $format = \libphonenumber\PhoneNumberFormat::INTERNATIONAL)
{
	return phoneFormat($phone, $countryCode, $format);
}

/**
 * Get Phone's National Format
 *
 * @param $phone
 * @param null $countryCode
 * @param int $format
 * @return \libphonenumber\PhoneNumberUtil|mixed|string
 */
function phoneFormat($phone, $countryCode = null, $format = \libphonenumber\PhoneNumberFormat::NATIONAL)
{
	// Country Exception
	if ($countryCode == 'UK') {
		$countryCode = 'GB';
	}
	
	// Keep only numeric characters
	$phone = preg_replace('/[^0-9\+]/', '', $phone);
	
	return $phone;
}

/**
 * @param $filePath
 * @param string $type
 * @return mixed|string
 */
function imgUrl($filePath)
{
	return 'http://localhost/Delivery_app/storage'.$filePath;
}