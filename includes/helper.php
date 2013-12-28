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
	 * construct
	 *
	 * @since 2.1.0
	 */

	public function __construct()
	{
		
	}
	
	public function getSubset()
	{
		if (LANGUAGE == 'bg' || LANGUAGE == 'ru')
		{
			$output = 'cyrillic';
		}
		else if (LANGUAGE == 'vi')
		{
			$output = 'vietnamese';
		}
		else
		{
			$output = 'latin';
		}
		return $output;
	}
	
	public function getClass()
	{
		$classes = array();
		$classes[] = $this->_getBrowserClass();
		$classes[] = $this->_getDeviceClass();
		$classes[] = $this->_getLanguageClass();
		$classes[] = $this->_getContentTypeClass();
		$output = implode(' ', array_filter($classes));
		return $output;
	}

	protected function _getBrowserClass()
	{
		$output = MY_BROWSER . MY_BROWSER_VERSION;
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

	protected function _getDeviceClass()
	{
		if (MY_MOBILE)
		{
			$output = 'mobile';
			if (MY_MOBILE != 'mobile')
			{
				$output .= ' ' . MY_MOBILE;
			}
		}
		else if (MY_TABLET)
		{
			$output = 'tablet';
			if (MY_TABLET != 'tablet')
			{
				$output .= ' ' . MY_TABLET;
			}
		}
		else if (MY_DESKTOP)
		{
			$output = 'desktop ' . MY_DESKTOP;
		}
		return $output;
	}
	
	protected function _getLanguageClass()
	{
		if (LANGUAGE == 'ar' || LANGUAGE == 'fa' || LANGUAGE == 'he')
		{
			$output .= 'rtl';
		}
		return $output;
	}
	
	protected function _getContentTypeClass()
	{
		if (CATEGORY)
		{
			$output = 'category';
		}
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
 * @deprecated 2.0.0
 *
 * @package Redaxscript
 * @category Helper
 * @author Henry Ruhs
 */

function helper_class()
{
	$helper = new Redaxscript_Helper();
	echo $helper->getClass();
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
	$helper = new Redaxscript_Helper();
	echo $helper->getSubset();
}
?>
