<?php

/**
 * Redaxscript Helper
 *
 * @since 2.1.0
 *
 * @package Redaxscript
 * @category Helper
 * @author Kim Kha Nguyen
 */

class Redaxscript_Helper
{
	/**
	 * get subset
	 *
	 * @since 2.1.0
	 */

	public static function getSubset()
	{
		/* cyrillic subset */

		if (LANGUAGE == 'bg' || LANGUAGE == 'ru')
		{
			$output = 'cyrillic';
		}

		/* vietnamese subset */

		else if (LANGUAGE == 'vi')
		{
			$output = 'vietnamese';
		}

		/* latin subset */

		else
		{
			$output = 'latin';
		}
		return $output;
	}

	/**
	 * get class
	 *
	 * @since 2.1.0
	 */

	public static function getClass()
	{
		/* collect all classes */

		$classes = array();
		$classes[] = self::_getBrowserClass();
		$classes[] = self::_getDeviceClass();
		$classes[] = self::_getLanguageClass();
		$classes[] = self::_getContentTypeClass();

		/* glue all classes */

		$output = implode(' ', array_filter($classes));
		return $output;
	}

	/**
	 * get browser class
	 *
	 * @since 2.1.0
	 */

	protected static function _getBrowserClass()
	{
		/* browser name and version */

		$output = MY_BROWSER . MY_BROWSER_VERSION;

		/* engine name */

		if (MY_ENGINE)
		{
			if ($output)
			{
				$output .= ' ';
			}
			$output .= MY_ENGINE;
		}
		return $output;
	}

	/**
	 * get device class
	 *
	 * @since 2.1.0
	 */

	protected static function _getDeviceClass()
	{
		/* mobile device */

		if (MY_MOBILE)
		{
			$output = 'mobile';
			if (MY_MOBILE != 'mobile')
			{
				$output .= ' ' . MY_MOBILE;
			}
		}

		/* tablet device */

		else if (MY_TABLET)
		{
			$output = 'tablet';
			if (MY_TABLET != 'tablet')
			{
				$output .= ' ' . MY_TABLET;
			}
		}

		/* desktop device */

		else if (MY_DESKTOP)
		{
			$output = 'desktop ' . MY_DESKTOP;
		}
		return $output;
	}

	/**
	 * get language class
	 *
	 * @since 2.1.0
	 */

	protected static function _getLanguageClass()
	{
		/* right-to-left */

		if (LANGUAGE == 'ar' || LANGUAGE == 'fa' || LANGUAGE == 'he')
		{
			$output .= 'rtl';
		}
		return $output;
	}

	/**
	 * get content type class
	 *
	 * @since 2.1.0
	 */

	protected static function _getContentTypeClass()
	{
		/* category */

		if (CATEGORY)
		{
			$output = 'category';
		}

		/* article */

		else if (ARTICLE)
		{
			$output = 'article';
		}
		return $output;
	}
}

/**
 * helper class
 *
 * @since 2.0.0
 * @deprecated 2.1.0
 *
 * @package Redaxscript
 * @category Helper
 * @author Henry Ruhs
 */

function helper_class()
{
	echo Redaxscript_Helper::getClass();
}

/**
 * helper subset
 *
 * @since 2.0.0
 * @deprecated 2.1.0
 *
 * @package Redaxscript
 * @category Helper
 * @author Henry Ruhs
 */

function helper_subset()
{
	echo Redaxscript_Helper::getSubset();
}
?>
