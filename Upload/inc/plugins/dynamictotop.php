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
 * Plugin Version: 1.1
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
    return array(
        "name"        => "Dynamic To Top",
        "description"    => "Adds an automatic and dynamic \"To Top\" button to scroll long pages back to the top.",
        "website"    => "http://www.mybbdestek.com",
        "author"    => "Bomfile & updated by vintagedaddyo",
        "authorsite"    => "https://community.mybb.com/user-6029.html",
        "version"    => "1.1",
        "compatibility" => "18*",
        "guid"        => "2ab170aa2a13c264db6c29397850b433",
    );
}

// Plugin Active
function dynamictotop_activate()
{
 require MYBB_ROOT.'/inc/adminfunctions_templates.php';
 global $db, $mybb, $settings;

     $settings_group = array(
        'gid'          => 'NULL',
        'name'         => 'dynamictotopgroup',
        'title'        => 'Dynamic To Top',
        'description'  => 'Dynamic To Top Settings.',
        'disporder'    => '2',
        'isdefault'    => 'no'
    );
    $db->insert_query('settinggroups', $settings_group);
    $gid = $db->insert_id();

    $settings1 = array('name' => 'pluginonoff','title' =>'Plugin On/Off ?','optionscode' => 'onoff','value' =>'1','disporder' => 1,'gid' => intval($gid));	
	$settings2 = array('name' => 'indextotoponoff','title' =>'Show On Index?','optionscode' => 'onoff','value' =>'1','disporder' => 2,'gid' => intval($gid));
	$settings3 = array('name' => 'forumtotoponoff','title' =>'Show On Forum Display?','optionscode' => 'onoff','value' =>'1','disporder' => 3,'gid' => intval($gid));
	$settings4 = array('name' => 'showthreadtotoponoff','title' =>'Show On Thread Display?','optionscode' => 'onoff','value' =>'1','disporder' => 4,'gid' => intval($gid));
    $settings5 = array('name' => 'scrollSpeed','title' =>'Scroll Speed ( miliseconds )','optionscode' => 'text','value' =>'1200','disporder' => 5,'gid' => intval($gid));
    $settings6 = array('name' => 'easing','title' =>'Easing','optionscode'  => 'select
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
'value' => 'linear','disporder' => 6,'gid' => intval($gid));
$settings7 = array('name' => 'portaltotoponoff','title' =>'Show On Portal?','optionscode' => 'onoff','value' =>'1','disporder' => 7,'gid' => intval($gid));
    $db->insert_query('settings',$settings1);
    $db->insert_query('settings',$settings2);
    $db->insert_query('settings',$settings3);
	$db->insert_query('settings',$settings4);
	$db->insert_query('settings',$settings5);
	$db->insert_query('settings',$settings6);
    $db->insert_query('settings',$settings7);
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
		       "version"	     => "1.1",
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