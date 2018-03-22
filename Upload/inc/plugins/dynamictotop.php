<?php
/*
 * MyBB: Dynamic To Top 
 *
 * File: dynamictotop.php
 * 
 * Authors: Bomfile, vintagedaddyo
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.2
 * 
 */

// Disallow direct access to this file for security reasons
if(!defined("IN_MYBB"))
{
    die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

// Plugin Hooks
$plugins->add_hook("index_start", "dynamictotop_start");
$plugins->add_hook("portal_start", "dynamictotop_start");
$plugins->add_hook("forumdisplay_start", "dynamictotop_start");
$plugins->add_hook("showthread_start", "dynamictotop_start");

// Plugin Info
function dynamictotop_info()
{
    global $lang;

    $lang->load("dynamictotop");
    
    $lang->dynamictotop_Desc = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float:right;">' .
        '<input type="hidden" name="cmd" value="_s-xclick">' . 
        '<input type="hidden" name="hosted_button_id" value="AZE6ZNZPBPVUL">' .
        '<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">' .
        '<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">' .
        '</form>' . $lang->dynamictotop_Desc;

    return Array(
        'name' => $lang->dynamictotop_Name,
        'description' => $lang->dynamictotop_Desc,
        'website' => $lang->dynamictotop_Web,
        'author' => $lang->dynamictotop_Auth,
        'authorsite' => $lang->dynamictotop_AuthSite,
        'version' => $lang->dynamictotop_Ver,
        'codename' => $lang->dynamictotop_CodeName,
        'compatibility' => $lang->dynamictotop_Compat
    );
}

// Plugin Active
function dynamictotop_activate()
{
 require MYBB_ROOT.'/inc/adminfunctions_templates.php';

 
 global $db, $mybb, $settings, $lang;

    $lang->load("dynamictotop");


     $dynamictotop_group = array(
        'gid'          => '0',
        'name'         => 'dynamictotopgroup',
        'title'        => $lang->dynamictotop_option_0_Title,
        'description'  => $lang->dynamictotop_option_0_Description,
        'disporder'    => '1',
        'isdefault'    => '0'
    );

   $db->insert_query('settinggroups', $dynamictotop_group);
   $gid = $db->insert_id(); 

    $dynamictotop_setting_1 = array(
        'name' => 'pluginonoff',
        'title' => $lang->dynamictotop_option_1_Title,
        'description'  => $lang->dynamictotop_option_1_Description,
        'optionscode' => 'onoff',
        'value' => '1',
        'disporder' => '1',
        'gid' => intval($gid)
    );

	$dynamictotop_setting_2 = array(
        'name' => 'indextotoponoff',
        'title' => $lang->dynamictotop_option_2_Title,
        'description'  => $lang->dynamictotop_option_2_Description,
        'optionscode' => 'onoff',
        'value' => '1',
        'disporder' => '2',
        'gid' => intval($gid)
    );

	$dynamictotop_setting_3 = array(
        'name' => 'forumtotoponoff',
        'title' => $lang->dynamictotop_option_3_Title,
        'description'  => $lang->dynamictotop_option_3_Description,
        'optionscode' => 'onoff',
        'value' => '1' ,
        'disporder' => '3',
        'gid' => intval($gid)
    );

	$dynamictotop_setting_4 = array(
        'name' => 'showthreadtotoponoff',
        'title' => $lang->dynamictotop_option_4_Title,
        'description'  => $lang->dynamictotop_option_4_Description,
        'optionscode' => 'onoff',
        'value' => '1' ,
        'disporder' => '4',
        'gid' => intval($gid)
    );

    $dynamictotop_setting_5 = array(
        'name' => 'scrollSpeed',
        'title' => $lang->dynamictotop_option_5_Title,
        'description'  => $lang->dynamictotop_option_5_Description,
        'optionscode' => 'text',
        'value' => '1200',
        'disporder' => '5',
        'gid' => intval($gid)
    );

    $dynamictotop_setting_6 = array(
        'name' => 'easing',
        'title' => $lang->dynamictotop_option_6_Title,
        'description'  => $lang->dynamictotop_option_6_Description,
        'optionscode'  => 'select
linear=linear
easeInQuad=easeInQuad
easeOutQuad=easeOutQuad
easeInOutQuad=easeInOutQuad
easeInCubic=easeInCubic
easeOutCubic=easeOutCubic
easeInOutCubic=easeInOutCubic
easeInQuart=easeInQuart
easeOutQuart=easeOutQuart
easeInOutQuart=easeInOutQuart
easeInQuint=easeInQuint
easeOutQuint=easeOutQuint
easeInOutQuint=easeInOutQuint
easeInSine=easeInSine
easeOutSine=easeOutSine
easeInOutSine=easeInOutSine
easeInExpo=easeInExpo
easeOutExpo=easeOutExpo
easeInOutExpo=easeInOutExpo
easeInCirc=easeInCirc
easeOutCirc=easeOutCirc
easeInOutCirc=easeInOutCirc
easeInElastic=easeInElastic
easeOutElastic=easeOutElastic
easeInOutElastic=easeInOutElastic
easeInBack=easeInBack
easeOutBack=easeOutBack
easeInOutBack=easeInOutBack
easeInBounce=easeInBounce
easeOutBounce=easeOutBounce
easeInOutBounce=easeInOutBounce',
        'value' => 'linear',
        'disporder' => '6',
        'gid' => intval($gid)
    );

$dynamictotop_setting_7 = array(
    'name' => 'portaltotoponoff',
    'title' => $lang->dynamictotop_option_7_Title,
    'description'  => $lang->dynamictotop_option_7_Description,
    'optionscode' => 'onoff',
    'value' => '1',
    'disporder' => '7',
    'gid' => intval($gid)
    );

    $db->insert_query('settings',$dynamictotop_setting_1);
    $db->insert_query('settings',$dynamictotop_setting_2);
    $db->insert_query('settings',$dynamictotop_setting_3);
	$db->insert_query('settings',$dynamictotop_setting_4);
	$db->insert_query('settings',$dynamictotop_setting_5);
	$db->insert_query('settings',$dynamictotop_setting_6);
    $db->insert_query('settings',$dynamictotop_setting_7);



    rebuild_settings();
    
    $dynamictotop_template = array( 
                        "title"       => "dynamictotop",
		      "template"    => "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen,projection\" href=\"inc/plugins/dynamic-to-top/css/ui.totop.css\" />
<!-- easing plugin ( optional ) -->
<script src=\"inc/plugins/dynamic-to-top/js/easing.js\" type=\"text/javascript\"></script>
<!-- UItoTop plugin -->
<script src=\"inc/plugins/dynamic-to-top/js/jquery.ui.totop.js\" type=\"text/javascript\"></script>
<script type=\"text/javascript\">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: \'moccaUItoTop\', // fading element id
				containerHoverClass: \'moccaUIhover\', // fading element hover class
				scrollSpeed: {\$mybb->settings[\'scrollSpeed\']},
				easingType: \'{\$mybb->settings[\'easing\']}\' 
	 		};
			*/
			
			$().UItoTop({ easingType: \'{\$mybb->settings[\'easing\']}\' });
			
		});
</script>",
		       "sid"           => "-1",
		       "version"	     => "1.2",
		       "dateline"	     => "1157735635",
	); 

	$db->insert_query("templates", $dynamictotop_template);	
}

// Plugin Deactivate
function dynamictotop_deactivate()
{
    require MYBB_ROOT.'/inc/adminfunctions_templates.php';

    global $db;

    $db->query("DELETE FROM ".TABLE_PREFIX."templates WHERE title='dynamictotop'");
    $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN('pluginonoff', 'dynamictotopgroup')");
	$db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN('indextotoponoff', 'dynamictotopgroup')");
    $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN('portaltotoponoff', 'dynamictotopgroup')");
	$db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN('forumtotoponoff', 'dynamictotopgroup')");
	$db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN('showthreadtotoponoff', 'dynamictotopgroup')");
    $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN('scrollSpeed', 'dynamictotopgroup')");
	$db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN('easing', 'dynamictotopgroup')");
    $db->query("DELETE FROM ".TABLE_PREFIX."settinggroups WHERE name='dynamictotopgroup'");

    rebuild_settings();
}

// Plugin Start
function dynamictotop_start()
{
    require MYBB_ROOT.'/inc/adminfunctions_templates.php';
    global $mybb,$db,$lang,$templates,$cache,$dynamictotop;
    if ($mybb->settings['pluginonoff'] == "1" )
{
    eval("\$dynamictotop = \"".$templates->get("dynamictotop")."\";");
	
}
    if ($mybb->settings['indextotoponoff'] == "1" )
{
		$templates->cache['index'] = str_replace('{$footer}','{$footer}{$dynamictotop}',$templates->cache['index']);
		}	
		
    if ($mybb->settings['forumtotoponoff'] == "1" )
{
		$templates->cache['forumdisplay'] = str_replace('{$footer}','{$footer}{$dynamictotop}',$templates->cache['forumdisplay']);
		}
		
    if ($mybb->settings['showthreadtotoponoff'] == "1" )
{
		$templates->cache['showthread'] = str_replace('{$footer}','{$footer}{$dynamictotop}',$templates->cache['showthread']);
		}
        if ($mybb->settings['portaltotoponoff'] == "1" )
{
            $templates->cache['portal'] = str_replace('{$footer}','{$footer}{$dynamictotop}',$templates->cache['portal']);
        }   
}
 
//Finish
?>