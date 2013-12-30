<?php
error_reporting(0);

/* include core files */

include_once('config.php');
include_once('includes/autoloader.php');
include_once('includes/breadcrumb.php');
include_once('includes/center.php');
include_once('includes/check.php');
include_once('includes/clean.php');
include_once('includes/contents.php');
include_once('includes/generate.php');
include_once('includes/get.php');
include_once('includes/head.php');
include_once('includes/loader.php');
include_once('includes/misc.php');
include_once('includes/modules.php');
include_once('includes/navigation.php');
include_once('includes/query.php');
include_once('includes/replace.php');
include_once('includes/search.php');
include_once('includes/startup.php');
include_once('migrates/all.php');

/* startup redaxscript */

Redaxscript_Autoloader::init();
startup();

/* include files as needed */

if (FIRST_PARAMETER == 'password_reset' || FIRST_PARAMETER == 'reminder' || s('captcha') > 0)
{
	include_once('includes/captcha.php');
}
if (LAST_TABLE == 'articles')
{
	include_once('includes/comments.php');
}
if (FIRST_PARAMETER == 'admin' || FIRST_PARAMETER == 'login' || FIRST_PARAMETER == 'logout')
{
	include_once('includes/login.php');
}
if ((FIRST_PARAMETER == 'password_reset' || FIRST_PARAMETER == 'reminder') && s('reminder') == 1)
{
	include_once('includes/password.php');
	include_once('includes/reminder.php');
}
if (FIRST_PARAMETER == 'registration' && s('registration') == 1)
{
	include_once('includes/password.php');
	include_once('includes/registration.php');
}

/* include admin files as needed */

if (LOGGED_IN == TOKEN)
{
	include_once('includes/admin/admin.php');
	include_once('includes/admin/center.php');
}
if (FIRST_PARAMETER == 'admin' && LOGGED_IN == TOKEN)
{
	include_once('includes/admin/query.php');
	switch (true)
	{
		case CATEGORIES_NEW == 1:
		case CATEGORIES_EDIT == 1:
		case CATEGORIES_DELETE == 1:
		case ARTICLES_NEW == 1:
		case ARTICLES_EDIT == 1:
		case ARTICLES_DELETE == 1:
		case EXTRAS_NEW == 1:
		case EXTRAS_EDIT == 1:
		case EXTRAS_DELETE == 1:
		case COMMENTS_NEW == 1:
		case COMMENTS_EDIT == 1:
		case COMMENTS_DELETE == 1:
			if (TABLE_PARAMETER == 'categories' || TABLE_PARAMETER == 'articles' || TABLE_PARAMETER == 'extras' || TABLE_PARAMETER == 'comments')
			{
				include_once('includes/admin/contents.php');
			}
		case GROUPS_NEW == 1:
		case GROUPS_EDIT == 1:
		case GROUPS_DELETE == 1:
			if (TABLE_PARAMETER == 'groups')
			{
				include_once('includes/admin/groups.php');
			}
		case MODULES_INSTALL == 1:
		case MODULES_EDIT == 1:
		case MODULES_UNINSTALL == 1:
			if (TABLE_PARAMETER == 'modules')
			{
				include_once('includes/admin/modules.php');
			}
		case SETTINGS_EDIT == 1:
			if (TABLE_PARAMETER == 'settings')
			{
				include_once('includes/admin/settings.php');
			}
		case USERS_NEW == 1:
		case USERS_EDIT == 1:
		case USERS_DELETE == 1:
		case USERS_EXCEPTION == 1:
			if (TABLE_PARAMETER == 'users')
			{
				include_once('includes/admin/users.php');
			}
			break;
	}
}

/* include language files */

include_once('languages/' . LANGUAGE . '.php');
include_once('languages/misc.php');

/* include module files */

$modules_include = modules_include();
if ($modules_include)
{
	foreach ($modules_include as $value)
	{
		if (file_exists('modules/' . $value . '/languages/' . LANGUAGE . '.php'))
		{
			include_once('modules/' . $value . '/languages/' . LANGUAGE . '.php');
		}
		else if (file_exists('modules/' . $value . '/languages/en.php'))
		{
			include_once('modules/' . $value . '/languages/en.php');
		}
		if (file_exists('modules/' . $value . '/config.php'))
		{
			include_once('modules/' . $value . '/config.php');
		}
		if (file_exists('modules/' . $value . '/index.php'))
		{
			include_once('modules/' . $value . '/index.php');
		}
	}
}

/* call loader else render template */

if (FIRST_PARAMETER == 'loader' && (SECOND_PARAMETER == 'styles' || SECOND_PARAMETER == 'scripts'))
{
	echo loader(SECOND_PARAMETER, 'outline');
}
else
{
	hook('render_start');

	/* undefine */

	undefine(array(
		'RENDER_BREAK',
		'CENTER_BREAK',
		'REFRESH_ROUTE',
		'DESCRIPTION',
		'KEYWORDS',
		'ROBOTS',
		'TITLE'
	));

	/* render break */

	if (RENDER_BREAK == 1)
	{
		return;
	}
	else
	{
		/* handle error */

		if (CONTENT_ERROR && CENTER_BREAK == '')
		{
			header('http/1.0 404 not found');
		}
		include_once('templates/' . TEMPLATE . '/index.phtml');
	}
	hook('render_end');
}
?>