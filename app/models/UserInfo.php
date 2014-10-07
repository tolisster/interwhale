<?php

class UserInfo extends Eloquent {

	public $timestamps = false;
	protected $fillable = array('gender', 'birthdate', 'relationship', 'languages', 'education', 'activity',
		'status', 'description');

	public static $languageCodes = array(
		'aa' => 'Afar',
		'ab' => 'Abkhazian',
		'ae' => 'Avestan',
		'af' => 'Afrikaans',
		'ak' => 'Akan',
		'am' => 'Amharic',
		'an' => 'Aragonese',
		'ar' => 'Arabic',
		'as' => 'Assamese',
		'av' => 'Avaric',
		'ay' => 'Aymara',
		'az' => 'Azerbaijani',
		'ba' => 'Bashkir',
		'be' => 'Belarusian',
		'bg' => 'Bulgarian',
		'bh' => 'Bihari',
		'bi' => 'Bislama',
		'bm' => 'Bambara',
		'bn' => 'Bengali',
		'bo' => 'Tibetan',
		'br' => 'Breton',
		'bs' => 'Bosnian',
		'ca' => 'Catalan',
		'ce' => 'Chechen',
		'ch' => 'Chamorro',
		'co' => 'Corsican',
		'cr' => 'Cree',
		'cs' => 'Czech',
		'cu' => 'Church Slavic',
		'cv' => 'Chuvash',
		'cy' => 'Welsh',
		'da' => 'Danish',
		'de' => 'German',
		'dv' => 'Divehi',
		'dz' => 'Dzongkha',
		'ee' => 'Ewe',
		'el' => 'Greek',
		'en' => 'English',
		'eo' => 'Esperanto',
		'es' => 'Spanish',
		'et' => 'Estonian',
		'eu' => 'Basque',
		'fa' => 'Persian',
		'ff' => 'Fulah',
		'fi' => 'Finnish',
		'fj' => 'Fijian',
		'fo' => 'Faroese',
		'fr' => 'French',
		'fy' => 'Western Frisian',
		'ga' => 'Irish',
		'gd' => 'Scottish Gaelic',
		'gl' => 'Galician',
		'gn' => 'Guarani',
		'gu' => 'Gujarati',
		'gv' => 'Manx',
		'ha' => 'Hausa',
		'he' => 'Hebrew',
		'hi' => 'Hindi',
		'ho' => 'Hiri Motu',
		'hr' => 'Croatian',
		'ht' => 'Haitian',
		'hu' => 'Hungarian',
		'hy' => 'Armenian',
		'hz' => 'Herero',
		'ia' => 'Interlingua',
		'id' => 'Indonesian',
		'ie' => 'Interlingue',
		'ig' => 'Igbo',
		'ii' => 'Sichuan Yi',
		'ik' => 'Inupiaq',
		'io' => 'Ido',
		'is' => 'Icelandic',
		'it' => 'Italian',
		'iu' => 'Inuktitut',
		'ja' => 'Japanese',
		'jv' => 'Javanese',
		'ka' => 'Georgian',
		'kg' => 'Kongo',
		'ki' => 'Kikuyu',
		'kj' => 'Kwanyama',
		'kk' => 'Kazakh',
		'kl' => 'Kalaallisut',
		'km' => 'Khmer',
		'kn' => 'Kannada',
		'ko' => 'Korean',
		'kr' => 'Kanuri',
		'ks' => 'Kashmiri',
		'ku' => 'Kurdish',
		'kv' => 'Komi',
		'kw' => 'Cornish',
		'ky' => 'Kirghiz',
		'la' => 'Latin',
		'lb' => 'Luxembourgish',
		'lg' => 'Ganda',
		'li' => 'Limburgish',
		'ln' => 'Lingala',
		'lo' => 'Lao',
		'lt' => 'Lithuanian',
		'lu' => 'Luba-Katanga',
		'lv' => 'Latvian',
		'mg' => 'Malagasy',
		'mh' => 'Marshallese',
		'mi' => 'Maori',
		'mk' => 'Macedonian',
		'ml' => 'Malayalam',
		'mn' => 'Mongolian',
		'mr' => 'Marathi',
		'ms' => 'Malay',
		'mt' => 'Maltese',
		'my' => 'Burmese',
		'na' => 'Nauru',
		'nb' => 'Norwegian Bokmal',
		'nd' => 'North Ndebele',
		'ne' => 'Nepali',
		'ng' => 'Ndonga',
		'nl' => 'Dutch',
		'nn' => 'Norwegian Nynorsk',
		'no' => 'Norwegian',
		'nr' => 'South Ndebele',
		'nv' => 'Navajo',
		'ny' => 'Chichewa',
		'oc' => 'Occitan',
		'oj' => 'Ojibwa',
		'om' => 'Oromo',
		'or' => 'Oriya',
		'os' => 'Ossetian',
		'pa' => 'Panjabi',
		'pi' => 'Pali',
		'pl' => 'Polish',
		'ps' => 'Pashto',
		'pt' => 'Portuguese',
		'qu' => 'Quechua',
		'rm' => 'Raeto-Romance',
		'rn' => 'Kirundi',
		'ro' => 'Romanian',
		'ru' => 'Russian',
		'rw' => 'Kinyarwanda',
		'sa' => 'Sanskrit',
		'sc' => 'Sardinian',
		'sd' => 'Sindhi',
		'se' => 'Northern Sami',
		'sg' => 'Sango',
		'si' => 'Sinhala',
		'sk' => 'Slovak',
		'sl' => 'Slovenian',
		'sm' => 'Samoan',
		'sn' => 'Shona',
		'so' => 'Somali',
		'sq' => 'Albanian',
		'sr' => 'Serbian',
		'ss' => 'Swati',
		'st' => 'Southern Sotho',
		'su' => 'Sundanese',
		'sv' => 'Swedish',
		'sw' => 'Swahili',
		'ta' => 'Tamil',
		'te' => 'Telugu',
		'tg' => 'Tajik',
		'th' => 'Thai',
		'ti' => 'Tigrinya',
		'tk' => 'Turkmen',
		'tl' => 'Tagalog',
		'tn' => 'Tswana',
		'to' => 'Tonga',
		'tr' => 'Turkish',
		'ts' => 'Tsonga',
		'tt' => 'Tatar',
		'tw' => 'Twi',
		'ty' => 'Tahitian',
		'ug' => 'Uighur',
		'uk' => 'Ukrainian',
		'ur' => 'Urdu',
		'uz' => 'Uzbek',
		've' => 'Venda',
		'vi' => 'Vietnamese',
		'vo' => 'Volapuk',
		'wa' => 'Walloon',
		'wo' => 'Wolof',
		'xh' => 'Xhosa',
		'yi' => 'Yiddish',
		'yo' => 'Yoruba',
		'za' => 'Zhuang',
		'zh' => 'Chinese',
		'zu' => 'Zulu'
	);

	public static $genders = array(
		'm' => 'Male',
		'f' => 'Female'
	);

	public static $relationships = array(
		'married' => 'Married',
		'single' => 'Single',
		'divorced' => 'Divorced',
		'widowed' => 'Widowed',
		'cohabiting' => 'Cohabiting',
		'civil union' => 'Civil union',
		'domestic partnership' => 'Domestic partnership',
		'unmarried partners' => 'Unmarried partners'
	);

	public static $religions = array(
		'christianity' => 'Christianity',
		'islam' => 'Islam',
		'buddhism' => 'Buddhism',
		'hinduism' => 'Hinduism',
		'chinese folk' => 'Chinese folk religion'
	);

	const MIN_AGE = 16;
	const MAX_AGE = 99;

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function getGenderNameAttribute()
	{
		if (!array_key_exists($this->gender, self::$genders))
			return '';
		return self::$genders[$this->gender];
	}

	public function getAgeAttribute()
	{
		if (is_null($this->birthdate) || $this->birthdate == '0000-00-00')
			return null;
		$birthdate = DateTime::createFromFormat('Y-m-d', $this->birthdate);
		$now = new DateTime();
		return $now->diff($birthdate)->y;
	}

	public function getLanguagesAttribute($value)
	{
		if (empty($value))
			return array();
		return explode(',', $value);
	}

	public function setLanguagesAttribute($value)
	{
		$this->attributes['languages'] = implode(',', $value);
	}

	public function getLanguageNamesAttribute()
	{
		if (empty($this->languages))
			return '';
		$text = array();
		foreach ($this->languages as $code) {
			if (!array_key_exists($code, self::$languageCodes))
				continue;
			$text[] = self::$languageCodes[$code];
		}
		return implode(', ', $text);
	}

	public function getRelationshipNameAttribute()
	{
		if (!array_key_exists($this->relationship, self::$relationships))
			return '';
		return self::$relationships[$this->relationship];
	}

	public function getReligionNameAttribute()
	{
		if (!array_key_exists($this->religion, self::$religions))
			return '';
		return self::$religions[$this->religion];
	}

}