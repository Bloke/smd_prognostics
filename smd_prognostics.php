<?php

// This is a PLUGIN TEMPLATE for Textpattern CMS.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Plugin names should start with a three letter prefix which is
// unique and reserved for each plugin author ("abc" is just an example).
// Uncomment and edit this line to override:
$plugin['name'] = 'smd_prognostics';

// Allow raw HTML help, as opposed to Textile.
// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.4.1';
$plugin['author'] = 'Stef Dawson';
$plugin['author_uri'] = 'https://stefdawson.com/';
$plugin['description'] = 'Pro-active diagnostics that alarm when things have changed in Textpattern';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment
// spam evaluators or URL redirectors would probably want to run earlier
// (1...4) to prepare the environment for everything else that follows.
// Values 6...9 should be considered for plugins which would work late.
// This order is user-overrideable.
$plugin['order'] = '1';

// Plugin 'type' defines where the plugin is loaded
// 0 = public              : only on the public side of the website (default)
// 1 = public+admin        : on both the public and admin side
// 2 = library             : only when include_plugin() or require_plugin() is called
// 3 = admin               : only on the admin side (no AJAX)
// 4 = admin+ajax          : only on the admin side (AJAX supported)
// 5 = public+admin+ajax   : on both the public and admin side (AJAX supported)
$plugin['type'] = '1';

// Plugin "flags" signal the presence of optional capabilities to the core plugin loader.
// Use an appropriately OR-ed combination of these flags.
// The four high-order bits 0xf000 are available for this plugin's private use
if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001); // This plugin wants to receive "plugin_prefs.{$plugin['name']}" events
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002); // This plugin wants to receive "plugin_lifecycle.{$plugin['name']}" events

$plugin['flags'] = '1';

// Plugin 'textpack' is optional. It provides i18n strings to be used in conjunction with gTxt().
// Syntax:
// ## arbitrary comment
// #@event
// #@language ISO-LANGUAGE-CODE
// abc_string_name => Localized String

$plugin['textpack'] = <<<EOT
#@language en, en-gb, en-us
#@admin-side
smd_prognostics => Prognostics
#@smd_prognostics
smd_prognostics_acked => Alarms acknowledged.
smd_prognostics_alarm_freq => Alarm on detection and every: 
smd_prognostics_and =>  and 
smd_prognostics_auth_users => Restrict prognostic config to: 
smd_prognostics_block => Block
smd_prognostics_btn_ackit => Acknowledge
smd_prognostics_btn_csi => Send Forensics
smd_prognostics_btn_ignore => Ignore
smd_prognostics_check_between => Check files between: 
smd_prognostics_check_for => Check files for: 
smd_prognostics_check_freq => Check files (at most) every: 
smd_prognostics_check_qty => Check this many files each time: 
smd_prognostics_check_where => Check files on public side clicks: 
smd_prognostics_ch_add => Additions
smd_prognostics_ch_del => Deletions
smd_prognostics_ch_mod => Modifications
smd_prognostics_csense => (case-sensitive)
smd_prognostics_csi_sent =>  Forensics data sent
smd_prognostics_csv => (comma-separated)
smd_prognostics_currmon => You are currently monitoring {curr} out of {outof} available files.
smd_prognostics_docroot_files => Consider moving the "files" folder outside of your site root folder. You can do this via the "Admin > Preferences > Admin > File directory path" setting.
smd_prognostics_docroot_prognostics => Please change the "Prognostics folder" setting to a directory outside your site root folder.
smd_prognostics_docroot_tmp => Consider moving the "tmp" folder outside of your site root folder. You can do this via the "Admin > Preferences > Admin > Temporary directory path" setting.
smd_prognostics_excludir => Exclude folders: 
smd_prognostics_files_updated => File list updated
smd_prognostics_help_link => (<a href="{link}">Help</a>)
smd_prognostics_hms => (hrs:mins:secs)
smd_prognostics_ignores => Ignore files: 
smd_prognostics_lbl_added => Added (not monitored)
smd_prognostics_lbl_changed => Changed
smd_prognostics_lbl_hashmod => COMPROMISED
smd_prognostics_lbl_missing => Missing
smd_prognostics_listloc => File locations: 
smd_prognostics_mailto => Send e-mail to: 
smd_prognostics_mailto_csi => Send forensics to: 
smd_prognostics_monfiles_explain => Select all the files you wish to monitor and click Save. Altering this list will automatically acknowledge any outstanding alarms against the selected files.
smd_prognostics_none_selected => No files selected
smd_prognostics_notify_email => E-mail
smd_prognostics_notify_txp => Txp interface
smd_prognostics_notify_via => Notify via: 
smd_prognostics_not_writable => {location} is not a directory or is not writable
smd_prognostics_no_alarms => No alarms to acknowledge at present.
smd_prognostics_no_files => No files to list. Check the plugin setup (and Save it).
smd_prognostics_no_log_entries => No log activity around the time of the differences.
smd_prognostics_pnl_ack => Alarms
smd_prognostics_pnl_advice => Advice
smd_prognostics_pnl_files => Files
smd_prognostics_pnl_setup => Setup
smd_prognostics_postamble => Acknowledge alarms
smd_prognostics_preamble_added => These files have been added: 
smd_prognostics_preamble_files => File contents follows: 
smd_prognostics_preamble_hashdown => WARNING! The checksums file is missing.
smd_prognostics_preamble_hashmod => WARNING! The checksums file has been altered: 
smd_prognostics_preamble_miss => These files are missing: 
smd_prognostics_preamble_nok => These files differ from their expected content: 
smd_prognostics_preamble_sql_inject => Possible SQL injection detected
smd_prognostics_preamble_txplog => Log entries prior to this detection: 
smd_prognostics_progloc => Prognostics folder: 
smd_prognostics_progpfx => Unique prefix: 
smd_prognostics_req_headers => Block request headers: 
smd_prognostics_req_not_allowed => REQUEST_METHOD not allowed: {req}
smd_prognostics_rh_del => DELETE
smd_prognostics_rh_put => PUT
smd_prognostics_rh_trace => TRACE
smd_prognostics_rpc_exists => The rpc directory is not being used. Consider removing it.
smd_prognostics_rt_hdr => Header violations
smd_prognostics_rt_sql => SQL injections
smd_prognostics_seconds => (seconds)
smd_prognostics_send_forensics => Send forensics for: 
smd_prognostics_sensitivity => Sensitivity threshold: 
smd_prognostics_sensitivity_explain => (1=most sensitive)
smd_prognostics_setup_exists => The setup directory still exists. Please delete it.
smd_prognostics_show_grants => Your Txp user can access the MySQL privileges in the DB. Consider accessing the DB using a less privileged user.
smd_prognostics_sql_file_privs => Your MySQL user has FILE privileges. Consider revoking this right unless absolutely necessary.
smd_prognostics_sql_inject => Protect against SQL injection: 
smd_prognostics_stat_gid => Group ID: 
smd_prognostics_stat_mod => Modified: 
smd_prognostics_stat_name => Filename: 
smd_prognostics_stat_size => Size: 
smd_prognostics_stat_uid => User ID: 
smd_prognostics_subject => Prognostics ({site})
smd_prognostics_subject_csi => Prognostics ({site}) forensics
smd_prognostics_tight => You run a pretty tight ship. Stay frosty.
smd_prognostics_ttl_ack => Prognostic alarm acknowledgement
smd_prognostics_ttl_advice => Prognostic advice
smd_prognostics_ttl_fileopts => Filesystem options
smd_prognostics_ttl_files => Prognostic file monitoring
smd_prognostics_ttl_monopts => Monitoring options
smd_prognostics_ttl_plugopts => Plugin options
smd_prognostics_ttl_realopts => Realtime options
smd_prognostics_ttl_setup => Prognostic setup
smd_prognostics_txpdir => Admin-side URL: 
smd_prognostics_warn_loc => File locations changed. Update your <a href="index.php?event=smd_prognostics&#38;;step=smd_prognostics_files">list of files</a> now
smd_prognostics_with =>  with: 
smd_prognostics_xss => XSS shield
smd_prognostics_xss_explain => (may break Textiled comments)
EOT;

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
/**
 * smd_prognostics
 *
 * A Textpattern CMS plugin for pro-active diagnostics
 *  -> Detect changes to the file system
 *  -> Acknowledge alarms (sent via e-mail or to the admin interface)
 *
 * @author Stef Dawson
 * @link   https://stefdawson.com/
 * @todo   Monitor PHP / MySQL version? (https://forum.textpattern.io/viewtopic.php?pid=260163#p260163)
 */

global $smd_prognostics_event, $smd_prognostics_checksums, $smd_prognostics_sqlprot;

$smd_prognostics_event = 'smd_prognostics';
$smd_prognostics_checksums = rtrim(get_pref('smd_prognostics_dir', txpath, 1), DS) . DS . get_pref('smd_prognostics_prefix', '').'smd_prognostics_checksums.txt';
$hdron = get_pref('smd_prognostics_req_headers', '');
$smd_prognostics_sqlprot = new smd_prog_PhProtector(false);

if (txpinterface === 'admin') {
    global $txp_user, $event, $step;

    $smd_prognostics_privs = '1,2';
    $smd_prognostics_suppress = gps('smd_prognostics_suppress');

    $privs = safe_field("privs", "txp_users", "name = '".doSlash($txp_user)."'");
    $users = get_pref('smd_prognostics_users', '');
    $allow = ($users) ? in_array($txp_user, do_list($users)) : true;

    if ($allow) {
        add_privs($smd_prognostics_event, $smd_prognostics_privs);
        add_privs('plugin_prefs.'.$smd_prognostics_event, $smd_prognostics_privs);
        register_tab('extensions', $smd_prognostics_event, gTxt('smd_prognostics'));
        register_callback('smd_prognostics_setup', 'plugin_prefs.'.$smd_prognostics_event);
        register_callback('smd_prognostics_dispatcher', $smd_prognostics_event);
        register_callback('smd_prognostics_inject_css', 'admin_side', 'head_end');
    }

    if ($hdron) {
        register_callback('smd_prognostics_request_headers', 'admin_side', 'head_end');
    }

    // Admin side callback for checking files
    if (!$smd_prognostics_suppress && in_array($privs, do_list($smd_prognostics_privs))) {
        register_callback('smd_prognostics', 'admin_side', 'main_content');
    }
}

// Public side callbacks
if (strpos(get_pref('smd_prognostics_check_where', ''), 'public') !== false) {
    register_callback('smd_prognostics', 'pretext');
}
if ($hdron) {
    register_callback('smd_prognostics_request_headers', 'pretext');
}
if (strpos(get_pref('smd_prognostics_sql_inject', 'smd_no'), 'smd_no') === false) {
    register_callback('smd_prognostics_sql_inject', 'pretext');
}

// -------------------------------------------------------------
// CSS definitions: hopefully kind to themers.
function smd_prognostics_get_style_rules()
{
    $smd_prognostics_styles = array(
        'msg' =>
         '.smd_prog_warn { margin:0 auto 10px; width:500px; background:#ffc; border:2px dashed red; padding:10px; color:#444; }
          .smd_prog_warn a { font-weight:bold; color:#963; }
          .smd_prog_warn span { font-weight:bold; }
          .smd_prog_warn div { font-weight:bold; padding-bottom:10px; }',
        'setup' =>
         '.smd_label { text-align:right!important; vertical-align:middle; }
          .smd_prog_btns form { display:inline; }
          .smd_prognostics_setup h3 { margin:25px 0 0; }',
        'advice' =>
         '.smd_prog_advice { width:750px; }
          #list.smd_prog_advice td { padding:5px; }
          .smd_prog_btns { width:140px; }',
    );

    return $smd_prognostics_styles;
}

// -------------------------------------------------------------
function smd_prognostics_inject_css($evt, $stp)
{
    global $smd_prognostics_event, $event, $step;

    if ($event == $smd_prognostics_event) {
        $smd_prognostics_style = smd_prognostics_get_style_rules();

        $styles = array();

        switch ($step) {
            case 'smd_prognostics_advice':
            $styles[] = 'advice';
            $styles[] = 'setup';
            break;
        }

        if ($styles) {
            echo '<style type="text/css">';
            foreach ($styles as $style) {
                echo $smd_prognostics_style[$style];
            }
            echo '</style>';
        }
    }

    return;
}

// ------------------------
function smd_prognostics_dispatcher($evt, $stp)
{
    $available_steps = array(
        'smd_prognostics_files'  => false,
        'smd_prognostics_setup'  => false,
        'smd_prognostics_advice' => false,
        'smd_prognostics_ack'    => false,
    );

    if (!$stp or !bouncer($stp, $available_steps)) {
        $stp = 'smd_prognostics_setup';
    }
    $stp();
}

// Stub to call the verification code from the URL
function smd_prognostics($evt, $stp)
{
    return smd_do_prognostics();
}

// Verify the file checksums
// $mode = 0: normal / 1: no update (return arrays only) / 2: silent update
function smd_do_prognostics($mode = 0)
{
    global $smd_prognostics_event, $smd_prognostics_checksums;

    $smd_prognostics_style = smd_prognostics_get_style_rules();

    $now = time();
    $nok = $miss = $added = $allfiles = $hashdown = $hashmod = array();
    $timenow = date('H:i:s', $now);
    list($beg, $end) = do_list(get_pref('smd_prognostics_check_between', '|'), '|'); // Default is pipe so we can guarantee two return vals
    $tdiff = ($mode == 1 || ( ($timenow > $beg) && ($timenow < $end) && ($now - get_pref('smd_prognostics_lastcheck', 0) > get_pref('smd_prognostics_check_freq', 3600)) ) ) ? true : false;

    // Parts shamelessly plagiarised from txp_diag
    if ($tdiff) {
        $sumhash = get_pref('smd_prognostics_sumhash', NULL, ($mode==1 ? 1 : 0));
        $lookat = get_pref('smd_prognostics_check_for', '');
        $adds = (strpos($lookat, 'add') !== false);
        $dels = (strpos($lookat, 'delete') !== false);
        $mods = (strpos($lookat, 'modify') !== false);

        if ($cs = @file($smd_prognostics_checksums)) {
            $hash = md5(smd_prognostics_prep_file($smd_prognostics_checksums));
            if ($hash != $sumhash) {
                $hashmod[] = $smd_prognostics_checksums;
            } else {
                $ctr = 0;
                $qty_per = (($qty = get_pref('smd_prognostics_check_qty', '')) == '') ? count($cs) : $qty;
                $so_far = get_pref('smd_prognostics_qty_so_far', 0);
                $until = $so_far + $qty_per;
                foreach ($cs as $c) {
                    if (preg_match('@^(\S+): \((.*)\)$@', trim($c), $m)) {
                        list(,$file,$md5) = $m;
                        if ($dels && !file_exists($file)) {
                            $miss[] = $file;
                        } else if ($mods && $md5 != 'NULL') {
                            // Check file_exists last as it's the slowest operation; allows PHP to short circuit conditionals faster
                            if ( ( (($ctr >= $so_far) && ($ctr < $until) || $mode == 1) ) && file_exists($file) ) {
                                $content = smd_prognostics_prep_file($file);
                                if ((md5($content) != $md5) && ($file != $smd_prognostics_checksums)) {
                                    $nok[] = $file;
                                }
                            }
                            $ctr++;
                        }
                        $allfiles[] = $file;
                    }
                }

                // Stash the story so far ready for next time the function is called
                if ($mode != 1) {
                    set_pref('smd_prognostics_qty_so_far', (($until < $ctr) ? $until : 0), 'smd_prognos', PREF_HIDDEN, 'text_input');
                }
                if ($adds) {
                    $filelist = smd_prognostics_readfiles();
                    $added = array_diff($filelist, $allfiles);
                }

                if ($mode != 1) {
                    set_pref('smd_prognostics_lastcheck', $now, 'smd_prognos', PREF_HIDDEN, 'text_input');
                }
            }
        } else {
            // File doesn't exist
            $hashdown[] = $smd_prognostics_checksums;
        }
    }

    // Assemble message
    if ($nok || $miss || $added || $hashdown || $hashmod) {
        if ($mode==1) {
            return array($nok, $miss, $added, $hashdown, $hashmod);
        } else {
            $via = get_pref('smd_prognostics_notify_via', '');
            $detect = get_pref('smd_prognostics_lastdetect', '');
            $lasts = explode(',', get_pref('smd_prognostics_lastact', 0));
            $freqs = explode(',', get_pref('smd_prognostics_alarm_freq', 86400));
            if (!isset($lasts[1])) {
                $lasts[1] = $lasts[0];
            }
            if (!isset($freqs[1])) {
                $freqs[1] = $freqs[0];
            }

            $lastact_txp = ($mode < 2 && ($now - $lasts[0] > $freqs[0])) ? true : false;
            $lastact_mail = ($mode < 2 && ($now - $lasts[1] > $freqs[1])) ? true : false;
            $lastmsg = get_pref('smd_prognostics_lastmsg', '');

            $subject = gTxt('smd_prognostics_subject', array('{site}' => get_pref('siteurl')));
            $msg = join('|', array_merge($hashdown, $hashmod, $nok, $miss, $added));

            if (txpinterface === 'admin' && strpos($via, 'txp') !== false) {
                if ($lastact_txp || ($lastmsg != md5($msg))) {
                    $txpdir = get_pref('smd_prognostics_txpdir', hu.smd_prognostics_guess_admin_dir());
                    $out = '<style type="text/css">'.$smd_prognostics_style['msg'].'</style><div class="smd_prog_warn"><div>'.$subject.'</div>'.
                        (($hashdown) ? '<p>'.gTxt('smd_prognostics_preamble_hashdown').'</p><ul><li>'.join('</li><li>',$hashdown).'</li></ul>' : '').
                        (($hashmod) ? '<p>'.gTxt('smd_prognostics_preamble_hashmod').'</p><ul><li>'.join('</li><li>',$hashmod).'</li></ul>' : '').
                        (($nok) ? '<p>'.gTxt('smd_prognostics_preamble_nok').'</p><ul><li>'.join('</li><li>',$nok).'</li></ul>' : '').
                        (($miss) ? '<p>'.gTxt('smd_prognostics_preamble_miss').'</p><ul><li>'.join('</li><li>',$miss).'</li></ul>' : '').
                        (($added) ? '<p>'.gTxt('smd_prognostics_preamble_added').'</p><ul><li>'.join('</li><li>',$added).'</li></ul>' : '').
                        '<p><a href="'.$txpdir.'/index.php?event='.$smd_prognostics_event.a.'step=smd_prognostics_ack'.a.'smd_prognostics_suppress=1">'.
                        gTxt('smd_prognostics_postamble').'</a></p></div>';

                    set_pref('smd_prognostics_lastact', $now.','.$lasts[1], 'smd_prognos', PREF_HIDDEN, 'text_input');
                    echo $out;
                }
            }

            if (strpos($via, 'email') !== false) {
                if ($lastact_mail || ($lastmsg != md5($msg))) {
                    $to = get_pref('smd_prognostics_mailto', '');
                    if ($to) {
                        $hdrs = smd_prognostics_header_info('smd_prognostics');
                        $body =
                            (($hashdown) ? n.gTxt('smd_prognostics_preamble_hashdown').n.n.join(n,$hashdown) : '').
                            (($hashmod) ? n.gTxt('smd_prognostics_preamble_hashmod').n.n.join(n,$hashmod) : '').
                            (($nok) ? n.gTxt('smd_prognostics_preamble_nok').n.n.join(n,$nok) : '').
                            (($miss) ? n.n.gTxt('smd_prognostics_preamble_miss').n.n.join(n,$miss) : '').
                            (($added) ? n.n.gTxt('smd_prognostics_preamble_added').n.n.join(n,$added) : '').
                            n.n.'<a href="'.$hdrs['txpdir'].'/index.php?event='.$smd_prognostics_event.a.'step=smd_prognostics_ack'.a.'smd_prognostics_suppress=1">'.gTxt('smd_prognostics_postamble').'</a>';
                        mail($to, $subject, $body, $hdrs['headers']);
                    }
                    set_pref('smd_prognostics_lastact', $lasts[0].','.$now, 'smd_prognos', PREF_HIDDEN, 'text_input');
                }
            }

            set_pref('smd_prognostics_lastmsg', md5($msg), 'smd_prognos', PREF_HIDDEN, 'text_input');

            if ($lastmsg != md5($msg)) {
                if ($detect == '') {
                    set_pref('smd_prognostics_lastdetect', $now, 'smd_prognos', PREF_HIDDEN, 'text_input');
                } else {
                    $detect = explode(',',$detect);
                    set_pref('smd_prognostics_lastdetect', $detect[0].','.$now, 'smd_prognos', PREF_HIDDEN, 'text_input');
                }
            }
        }
    }
}

// ----------  Catch unexpected request headers
function smd_prognostics_request_headers($evt, $stp) {
    $block = explode('|', get_pref('smd_prognostics_req_headers', ''));
    $hdr = serverSet('REQUEST_METHOD');

    if (in_array($hdr, $block)) {
        $send = (strpos(get_pref('smd_prognostics_rt_forensics'), 'hdr') !== false);

        // Send the forensics off if necessary
        $to = get_pref('smd_prognostics_mailto_csi', '');
        if ($to && $send) {
            $subject = gTxt('smd_prognostics_subject_csi', array('{site}' => get_pref('siteurl')));
            $hdrs = smd_prognostics_header_info('smd_frognostics');
            $body = n.gTxt('smd_prognostics_req_not_allowed', array('{req}' => $hdr)).n;
            foreach ($_SERVER + $_REQUEST + $_ENV as $key => $var) {
                $body .= n.$key.': '.$var;
            }
    
            mail($to, $subject, $body, $hdrs['headers']);
        }

        //TODO: offer alternative die mechanisms like SQL attacks?
        exit(1);
    }
}

// ----------  SQL injection detection
function smd_prognostics_sql_inject() {
    global $smd_prognostics_sqlprot, $permlink_mode, $DB;

    // Determine comment preview step and ignore if so
    $is_prevu = false;
    $com = psa(array(
        'parentid',
        'preview',
        'backpage',
    ));
    if ($com['preview']) {
        $urlparts = explode('/', $com['backpage']);
        $num = ($permlink_mode == 'messy') ? 1 : count($urlparts);
        $artic = safe_field('id','textpattern', "ID=".doSlash($com['parentid']).(($num > 1) ? " AND url_title='".doSlash($urlparts[$num-1])."'" : ''));
        $is_prevu = ($artic) ? true : false;
    }
    if(!$is_prevu && $smd_prognostics_sqlprot->isMalicious()) {
        $opts = do_list(get_pref('smd_prognostics_sql_inject', '|'), '|');
        $blok = (strpos($opts[0], 'smd_block') !== false);
        $send = (strpos(get_pref('smd_prognostics_rt_forensics'), 'sql') !== false);
        $ver = (defined('txp_version')) ? txp_version : get_pref('version', '');

        // Send the forensics off if necessary
        $to = get_pref('smd_prognostics_mailto_csi', '');
        if ($to && $send) {
            $subject = gTxt('smd_prognostics_subject_csi', array('{site}' => get_pref('siteurl')));
            $hdrs = smd_prognostics_header_info('smd_frognostics');
            $body = n.gTxt('smd_prognostics_preamble_sql_inject').n;
            $body .= (($ver) ? 'Txp: ' . $ver .n : '') . 'PHP: ' . phpversion() .n. 'MySQL: ' . mysqli_get_server_info($DB->link) .n. ((is_callable('apache_get_version')) ? 'Apache: ' . apache_get_version().n : '');
            foreach ($_SERVER + $_REQUEST + $_ENV as $key => $var) {
                $body .= n.$key.': '.$var;
            }

            mail($to, $subject, $body, $hdrs['headers']);
        }

        if (isset($opts[1]) && !empty($opts[1])) {
            $parts = do_list($opts[1], ':');
            if ($parts[0] == 'txp_form') {
                $msg = parse_form($parts[1]);
            } else {
                $msg = $opts[1];
            }
        } else {
            $msg = '';
        }

        if ($blok) {
            echo $msg;
            exit(1);
        } else {
            txp_die($msg, $opts[0]);
        }
    }
}

// -----------------
// Admin-side panels
// -----------------
// ----------  Alarm acknowledgement
function smd_prognostics_ack($msg = '')
{
    global $smd_prognostics_event, $smd_prognostics_checksums, $prefs, $DB;

    $method = ps('edit_method');
    $submit = ($method == 'acknowledge');
    $ignore = ($method == 'ignore');
    $csi    = ($method == 'csi');

    $ack = gps('selected');
    $smd_prog_ack = (is_array($ack)) ? $ack : (($ack) ? array($ack) : array());

    $out = array();

    if ($submit || $ignore) {
        if ($cs = @file($smd_prognostics_checksums)) {
            foreach ($cs as $c) {
                if (preg_match('@^(\S+): \((.*)\)$@', trim($c), $m)) {
                    list(,$file,$md5) = $m;
                    if (($key = array_search($file, $smd_prog_ack)) !== false) {
                        if (file_exists($file)) {
                            $content = smd_prognostics_prep_file($file);
                            $out[] = $file.': ('.( ($ignore) ? 'NULL' : md5($content) ).')';
                        }
                        // Remove files that already have checksums so we're left with additions
                        unset($smd_prog_ack[$key]);
                    } else {
                        $out[] = trim($c);
                    }
                }
            }

            // Tack on any new files
            foreach ($smd_prog_ack as $file) {
                if ( ($file != $smd_prognostics_checksums) && file_exists($file) ) {
                    $content = smd_prognostics_prep_file($file);
                    $out[] = $file.': ('.( ($ignore) ? 'NULL' : md5($content) ).')';
                }
            }

            $fh = fopen($smd_prognostics_checksums, "w");
            fwrite($fh, join(n, $out));
            fclose($fh);
            smd_prognostics_self_hash();
            $msg = gTxt('smd_prognostics_acked');
        }
    }

    if ($csi && $smd_prog_ack) {
         $msg = gTxt('smd_prognostics_csi_sent');
    } else if ($csi) {
         $msg = gTxt('smd_prognostics_none_selected');
    }

    pagetop(gTxt('smd_prognostics_ttl_ack'), $msg);

    list($nok, $miss, $added, $hashdown, $hashmod) = smd_do_prognostics(1);
    $nok = is_array($nok) ? $nok : array();
    $miss = is_array($miss) ? $miss : array();
    $added = is_array($added) ? $added : array();
    $hashmod = is_array($hashmod) ? $hashmod : array();
    $errnum = count(array_merge($nok, $miss, $added, $hashmod));
    $forensics = array();
    $lform = 'Y-m-d H:i:s';
    $med = '';

    echo n. '<div class="txp-layout">'.
        n. '<div class="txp-layout-2col">'.
        n. '<h1 class="txp-heading">'.
        n. gTxt('smd_prognostics_ttl_ack').
        n. '</h1>'.
        n. '</div>'.
        n. '<div id="'.$smd_prognostics_event.'_control" class="txp-layout-2col">'.
        n. smd_prognostics_button_bar('ack').
        n. '</div>'.
        n. '<div id="'.$smd_prognostics_event.'_container" class="txp-container">'.
        n. '<form class="smd_prognostics-ack-form" name="longform" method="post" action="?event='.$smd_prognostics_event.a.'step=smd_prognostics_ack'.a.'smd_prognostics_suppress=1">'.
        n. '<div class="txp-listtables">'.
        n. startTable('', '', 'txp-list');

    if ($errnum > 0) {
        foreach($hashmod as $naughty) {
            $sel = in_array($naughty, $smd_prog_ack);
            echo tr(td(checkbox('selected[]', $naughty, $sel), '', 'multi-edit').tda(gTxt('smd_prognostics_lbl_hashmod')).tda($naughty));
        }

        foreach($nok as $naughty) {
            $sel = in_array($naughty, $smd_prog_ack);
            echo tr(td(checkbox('selected[]', $naughty, $sel), '', 'multi-edit').tda(gTxt('smd_prognostics_lbl_changed')).tda($naughty));

            if ($sel) {
                $fi = stat($naughty);
                $forensics['nok'][] = smd_prognostics_forensic_output($naughty, $fi);
                $forensics['files'][$naughty] = chunk_split(base64_encode(file_get_contents($naughty)));
            }
        }

        foreach($miss as $naughty) {
            $sel = in_array($naughty, $smd_prog_ack);
            echo tr(td(checkbox('selected[]', $naughty, $sel), '', 'multi-edit').tda(gTxt('smd_prognostics_lbl_missing')).tda($naughty));

            if ($sel) {
                $forensics['miss'][] = $naughty;
            }
        }

        foreach($added as $naughty) {
            $sel = in_array($naughty, $smd_prog_ack);
            echo tr(td(checkbox('selected[]', $naughty, $sel), '', 'multi-edit').tda(gTxt('smd_prognostics_lbl_added')).tda($naughty));

            if ($sel) {
                $fi = stat($naughty);
                $forensics['added'][] = smd_prognostics_forensic_output($naughty, $fi);
                $forensics['files'][$naughty] = chunk_split(base64_encode(file_get_contents($naughty)));
            }
        }

        if ($smd_prog_ack && $prefs['logging'] != 'none') {
            $detect = explode(',',get_pref('smd_prognostics_lastdetect', time()));

            if (!isset($detect[1])) {
                $detect[1] = $detect[0];
            }

            $rs = safe_rows('*', 'txp_log', "time BETWEEN '" . date($lform, ($detect[0] - $prefs['smd_prognostics_check_freq'])) . "' AND '" . date($lform, ($detect[1] + 5)) . "'");

            foreach ($rs as $row) {
                $forensics['txp_log'][] = join(',',$row);
            }
        }

        $methods = array(
            'acknowledge' => array('label' => gTxt('smd_prognostics_btn_ackit')),
            'ignore'      => array('label' => gTxt('smd_prognostics_btn_ignore')),
            'csi'         => array('label' => gTxt('smd_prognostics_btn_csi')),
        );

        $med = multi_edit($methods, $smd_prognostics_event, 'smd_prognostics_ack');

        if (get_pref('smd_prognostics_mailto_csi', '') == '') {
            unset($methods['csi']);
        }
    } else {
        echo tr(td(gTxt('smd_prognostics_no_alarms')));
        set_pref('smd_prognostics_lastdetect', '', 'smd_prognos', PREF_HIDDEN, 'text_input');
    }
    echo endTable().
        '</div>'.
        $med.
        tInput().
        '</form>'.
        '</div></div>'.
        script_js( <<<EOS
            $(document).ready(function() {
                $('.smd_prognostics-ack-form').txpMultiEditForm({
                    'row' : 'tr',
                    'highlighted' : 'tr'
                });
            });
EOS
        );

    if ($csi && $forensics) {
        // Send the forensics off.
        $to = get_pref('smd_prognostics_mailto_csi', '');
        if ($to) {
            $subject = gTxt('smd_prognostics_subject_csi', array('{site}' => get_pref('siteurl')));
            $hdrs = smd_prognostics_header_info('smd_frognostics');
            $body =
                n.'Txp: ' . txp_version .n. 'PHP: ' . phpversion() .n. 'MySQL: ' . mysqli_get_server_info($DB->link) .n. ((is_callable('apache_get_version')) ? 'Apache: ' . apache_get_version().n : '').
                ((isset($forensics['nok'])) ? n.gTxt('smd_prognostics_preamble_nok').n.join(n,$forensics['nok']) : '').
                ((isset($forensics['miss'])) ? n.n.gTxt('smd_prognostics_preamble_miss').n.join(n,$forensics['miss']) : '').
                ((isset($forensics['added'])) ? n.n.gTxt('smd_prognostics_preamble_added').n.join(n,$forensics['added']) : '').
                ((isset($forensics['txp_log'])) ? n.n.gTxt('smd_prognostics_preamble_txplog').n.join(n,$forensics['txp_log']) : n.n.gTxt('smd_prognostics_no_log_entries'));
            if (isset($forensics['files'])) {
                $body .= n.n.gTxt('smd_prognostics_preamble_files');
                foreach ($forensics['files'] as $fn => $content) {
                    $body .= n.n.$fn.n.n.$content.n;
                }
            }

            mail($to, $subject, $body, $hdrs['headers']);
        }
    }
}

// ---------- File management
function smd_prognostics_files($msg = '')
{
    global $smd_prognostics_event, $smd_prognostics_checksums;

    extract(doSlash(gpsa(array('submit'))));
    $smd_prognostics_files = gps('smd_prognostics_files');

    if (!is_array($smd_prognostics_files)) {
        $smd_prognostics_files = array();
    }

    $adds = (strpos(get_pref('smd_prognostics_check_for'), 'add') !== false);
    $filelist = smd_prognostics_readfiles();
    $allcount = count($filelist);

    if ($submit) {
        $outfile = array();
        foreach ($smd_prognostics_files as $file) {
            $content = smd_prognostics_prep_file($file);
            $outfile[] = $file.': ('.md5($content).')';
        }

        if (is_writable(dirname($smd_prognostics_checksums))) {
            $fh = @fopen($smd_prognostics_checksums, "w");
            if ($fh) {
                fwrite($fh, join(n, $outfile));

                if ($adds) {
                    $additions = array_diff($filelist, $smd_prognostics_files);
                    $added = array();
                    foreach ($additions as $addition) {
                        $added[] = $addition.': (NULL)';
                    }
                    fwrite($fh, n.join(n, $added));
                }
                fclose($fh);
                smd_prognostics_self_hash();
                smd_do_prognostics(2); // Silently acknowledge all the files
                set_pref('smd_prognostics_lastdetect', '', 'smd_prognos', PREF_HIDDEN, 'text_input');
                $msg = gTxt('smd_prognostics_files_updated');
            } else {
                $msg = array(gTxt('smd_prognostics_not_writable', array('{location}' => $smd_prognostics_checksums)), E_WARNING);
            }
        } else {
            $msg = array(gTxt('smd_prognostics_not_writable', array('{location}' => dirname($smd_prognostics_checksums))), E_WARNING);
        }
    }

    pagetop(gTxt('smd_prognostics_ttl_files'), $msg);

    $smd_prognostics_files = array();

    if ($cs = @file($smd_prognostics_checksums)) {
        foreach ($cs as $c) {
            if (preg_match('@^(\S+): \((.*)\)$@', trim($c), $m)) {
                list(,$file,$md5) = $m;

                if ($md5 != 'NULL') {
                    $smd_prognostics_files[] = $file;
                }
            }
        }
    }

    $moncount = count($smd_prognostics_files);

    if ($filelist) {
        $filez = array();

        foreach($filelist as $key => $val) {
            $filez[$val] = $filelist[$key];
        }

        $filesel = smd_prognostics_multisel('smd_prognostics_files', $filez, $smd_prognostics_files);
    }

    $showfiles = (!empty($filesel));

    echo n. '<div class="txp-layout">'.
        n. '<div class="txp-layout-2col">'.
        n. '<h1 class="txp-heading">'.
        n. gTxt('smd_prognostics_ttl_files').
        n. '</h1>'.
        n. '</div>'.
        n. '<div id="'.$smd_prognostics_event.'_control" class="txp-layout-2col">'.
        n. smd_prognostics_button_bar('fil').
        n. '</div>'.
        n. '<div id="'.$smd_prognostics_event.'_container" class="txp-container">'.
        n. '<form class="smd_prognostics-files-form" method="post" action="?event='.$smd_prognostics_event.a.'step=smd_prognostics_files">'.
        n. startTable('', '', 'txp-list').
        n. tr(tdcs(gTxt('smd_prognostics_currmon', array('{curr}' => $moncount, '{outof}' => $allcount)) .(($showfiles) ? br.br. gTxt('smd_prognostics_monfiles_explain') : ''), 1, 400)).
        n. (($showfiles) ? tr(tda($filesel)) : tr(tda(gTxt('smd_prognostics_no_files')))).
        n. tr(tda(fInput('hidden', 'smd_prognostics_suppress', 1).fInput('submit', 'submit', gTxt('save'), 'publish'))).
        n. endTable().
        n. tInput().
        n. '</form>'.
        n. '</div></div>';
}

// ---------- Setup / prefs
function smd_prognostics_setup($msg = '')
{
    global $smd_prognostics_event, $smd_prognostics_checksums, $prefs;

    $origloc = get_pref('smd_prognostics_listloc', realpath(txpath.DS.'..'.DS).DS, 1);
    $origexc = get_pref('smd_prognostics_excludir', 'images, files, tmp', 1);
    $origdir = rtrim(get_pref('smd_prognostics_dir', realpath(txpath), 1), DS);
    $origpfx = get_pref('smd_prognostics_prefix', '', 1);

    $preflist = array(
        'smd_prognostics_check_freq',
        'smd_prognostics_check_qty',
        'smd_prognostics_alarm_freq',
        'smd_prognostics_check_where',
        'smd_prognostics_mailto',
        'smd_prognostics_mailto_csi',
        'smd_prognostics_users',
        'smd_prognostics_dir',
        'smd_prognostics_prefix',
        'smd_prognostics_listloc',
        'smd_prognostics_excludir',
        'smd_prognostics_ignores',
        'smd_prognostics_inject_sensitivity',
        'smd_prognostics_xss',
        'smd_prognostics_txpdir',
    );

    $warnloc = '';
    $notify = gps('smd_prognostics_notify_via');
    $chfor = gps('smd_prognostics_check_for');
    $reqs = gps('smd_prognostics_req_headers');
    $sqlin = gps('smd_prognostics_sql_inject');
    $tween = gps('smd_prognostics_check_between');
    $rtfor = gps('smd_prognostics_rt_forensics');

    // Only one of these valid status codes is allowed to be thrown
    $throw_codes = array(
        'smd_no' => gTxt('no'),
        'smd_block' => gTxt('smd_prognostics_block'),
        '200' => '200 OK',
        '301' => '301 Moved Permanently',
        '302' => '302 Found',
        '307' => '307 Temporary Redirect',
        '401' => '401 Unauthorized',
        '403' => '403 Forbidden',
        '404' => '404 Not Found',
        '410' => '410 Gone',
        '414' => '414 Request-URI Too Long',
        '500' => '500 Internal Server Error',
        '501' => '501 Not Implemented',
    );

    if (!is_array($tween)) {
        $tween = array();
    }

    foreach ($tween as $idx => $val) {
        if (empty($val)) {
            $tween[$idx] = ($idx==0) ? '00:00' : '23:59';
        } else {
            $timeparts = do_list($val, ':');
            foreach ($timeparts as $num) {
                if (!is_numeric($num)) {
                    $tween[$idx] = ($idx==0) ? '00:00' : '23:59';
                    break;
                }
            }
        }
    }

    $smd_prognostics_notify_via = join('|', ((is_array($notify)) ? $notify : array($notify)));
    $smd_prognostics_check_for = join('|', ((is_array($chfor)) ? $chfor : array($chfor)));
    $smd_prognostics_req_headers = join('|', ((is_array($reqs)) ? $reqs : array($reqs)));
    $smd_prognostics_sql_inject = join('|', ((is_array($sqlin)) ? $sqlin : array($sqlin)));
    $smd_prognostics_check_between = join('|', ((is_array($tween)) ? $tween : array($tween)));
    $smd_prognostics_rt_forensics = join('|', ((is_array($rtfor)) ? $rtfor : array($rtfor)));

    // Grab the saved pref values and tack on the array item(s)
    extract(doSlash(gpsa(array_merge(array('submit'), $preflist))));
    $preflist[] = 'smd_prognostics_notify_via';
    $preflist[] = 'smd_prognostics_check_for';
    $preflist[] = 'smd_prognostics_req_headers';
    $preflist[] = 'smd_prognostics_sql_inject';
    $preflist[] = 'smd_prognostics_check_between';
    $preflist[] = 'smd_prognostics_rt_forensics';
    $smd_prognostics_dir = rtrim($smd_prognostics_dir, DS);

    if ($submit) {
        if (($smd_prognostics_dir != $origdir) || ($smd_prognostics_prefix != $origpfx)) {
            if (is_dir($smd_prognostics_dir) && is_writable($smd_prognostics_dir)) {
                // Everything OK so do nothing for now
            } else {
                // Ignore new dir and reset it to what it was before
                $msg = array(gTxt('smd_prognostics_not_writable', array('{location}' => $smd_prognostics_dir)), E_WARNING);
                $smd_prognostics_dir = $origdir;
            }

            // Room for more config files as and when they are required
            $filelist[] = $smd_prognostics_checksums;

            foreach ($filelist as $file) {
                $filename = $smd_prognostics_prefix.ltrim(basename($file), $origpfx);
                rename($file, rtrim($smd_prognostics_dir, DS).DS.$filename);
            }
        }

        // Write all the prefs
        foreach ($preflist as $prefval) {
            set_pref(doSlash($prefval), doSlash($$prefval), 'smd_prognos', PREF_HIDDEN, 'text_input');
        }

        if ( ($smd_prognostics_listloc != $origloc) || ($smd_prognostics_excludir != $origexc) ) {
            $msg = array(gTxt('smd_prognostics_warn_loc'), E_WARNING);
        }

        if (!$msg) {
            $msg = gTxt('preferences_saved');
        }
    }

    pagetop(gTxt('smd_prognostics_ttl_setup'), $msg);

    $smd_prognostics_dir = get_pref('smd_prognostics_dir', txpath, 1);
    $smd_prognostics_prefix = get_pref('smd_prognostics_prefix', '', 1);
    $smd_prognostics_check_for = get_pref('smd_prognostics_check_for', 'delete|modify', 1);
    $smd_prognostics_check_where = get_pref('smd_prognostics_check_where', 'admin', 1);
    $smd_prognostics_check_freq = get_pref('smd_prognostics_check_freq', 10, 1);
    $smd_prognostics_check_between = get_pref('smd_prognostics_check_between', '00:00|23:59', 1);
    $smd_prognostics_check_qty = get_pref('smd_prognostics_check_qty', '30', 1);
    $smd_prognostics_alarm_freq = get_pref('smd_prognostics_alarm_freq', 86400, 1);
    $smd_prognostics_notify_via = get_pref('smd_prognostics_notify_via', '', 1);
    $smd_prognostics_mailto = get_pref('smd_prognostics_mailto', '', 1);
    $smd_prognostics_mailto_csi = get_pref('smd_prognostics_mailto_csi', '', 1);
    $smd_prognostics_users = get_pref('smd_prognostics_users', '', 1);
    $smd_prognostics_listloc = get_pref('smd_prognostics_listloc', realpath(txpath.DS.'..'.DS).DS, 1);
    $smd_prognostics_excludir = get_pref('smd_prognostics_excludir', 'images, files, tmp', 1);
    $smd_prognostics_ignores = get_pref('smd_prognostics_ignores', 'error_log', 1);
    $smd_prognostics_req_headers = get_pref('smd_prognostics_req_headers', 'TRACE|PUT|DELETE', 1);
    $smd_prognostics_sql_inject = get_pref('smd_prognostics_sql_inject', '0|', 1);
    $smd_prognostics_inject_sensitivity = get_pref('smd_prognostics_inject_sensitivity', 1, 1);
    $smd_prognostics_xss = get_pref('smd_prognostics_xss', 0, 1);
    $smd_prognostics_rt_forensics = get_pref('smd_prognostics_rt_forensics', '1|1', 1);
    $smd_prognostics_txpdir = get_pref('smd_prognostics_txpdir', hu.smd_prognostics_guess_admin_dir(), 1);

    $adds = (strpos($smd_prognostics_check_for, 'add') !== false);
    $dels = (strpos($smd_prognostics_check_for, 'delete') !== false);
    $mods = (strpos($smd_prognostics_check_for, 'modify') !== false);
    $rh_trace = (strpos($smd_prognostics_req_headers, 'TRACE') !== false);
    $rh_put = (strpos($smd_prognostics_req_headers, 'PUT') !== false);
    $rh_del = (strpos($smd_prognostics_req_headers, 'DELETE') !== false);
    $rt_hdr = (strpos($smd_prognostics_rt_forensics, 'hdr') !== false);
    $rt_sql = (strpos($smd_prognostics_rt_forensics, 'sql') !== false);
    $tweens = do_list($smd_prognostics_check_between, '|');
    $throws = do_list($smd_prognostics_sql_inject, '|');
    $helpLink = "?event=plugin".a."step=plugin_help".a."name=$smd_prognostics_event#smd_setup";

    //TODO: refactor with inputLabel()
    echo n. '<div class="txp-layout">'.
        n. '<div class="txp-layout-2col">'.
        n. '<h1 class="txp-heading">'.
        n. gTxt('smd_prognostics_ttl_setup'), sp, gTxt('smd_prognostics_help_link', array('{link}' => $helpLink), 'raw').
        n. '</h1>'.
        n. '</div>'.
        n. '<div id="'.$smd_prognostics_event.'_control" class="txp-layout-2col">'.
        n. smd_prognostics_button_bar('set').
        n. '</div>'.
        n. '<div id="'.$smd_prognostics_event.'_container" class="txp-container">'.
        n. '<form class="smd_prognostics-setup-form" method="post" action="?event='.$smd_prognostics_event.a.'step=smd_prognostics_setup">'.
        n. startTable('', '', 'smd_prognostics_setup').
        n. tr(tdcs(hed(gTxt('smd_prognostics_ttl_monopts'), 3), 2)).
        n. tr(
            tda(gTxt('smd_prognostics_check_where'), ' class="smd_label"').
            tda(radioSet(
                array(
                    'admin' => gTxt('no'),
                    'adminpublic' => gTxt('yes')
                ), 'smd_prognostics_check_where', $smd_prognostics_check_where), ' id="smd_prognostics_check_where"')
        ).
        n. tr(
            tda(gTxt('smd_prognostics_check_freq'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_check_freq', $smd_prognostics_check_freq, '','','',15).sp.gTxt('smd_prognostics_seconds'))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_check_between'), ' class="smd_label"').
            tda(
                fInput('text', 'smd_prognostics_check_between[]', $tweens[0], '','','',15).
                gTxt('smd_prognostics_and').
                fInput('text', 'smd_prognostics_check_between[]', $tweens[1], '','','',15).sp.gTxt('smd_prognostics_hms')
            )
        ).
        n. tr(
            tda(gTxt('smd_prognostics_check_qty'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_check_qty', $smd_prognostics_check_qty, '','','',15))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_alarm_freq'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_alarm_freq', $smd_prognostics_alarm_freq, '','','',15).sp.gTxt('smd_prognostics_seconds'))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_notify_via'), ' class="smd_label"').
            tda(
                checkbox('smd_prognostics_notify_via[]', 'txp', strpos($smd_prognostics_notify_via, 'txp') !== false) .
                '<label>'.gTxt('smd_prognostics_notify_txp').'</label>'.
                checkbox('smd_prognostics_notify_via[]', 'email', strpos($smd_prognostics_notify_via, 'email') !== false).
                '<label>'.gTxt('smd_prognostics_notify_email').'</label>'
            )
        ).
        n. tr(
            tda(gTxt('smd_prognostics_mailto'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_mailto', $smd_prognostics_mailto, '','','',60).sp.gTxt('smd_prognostics_csv'))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_mailto_csi'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_mailto_csi', $smd_prognostics_mailto_csi, '','','',60).sp.gTxt('smd_prognostics_csv'))
        ).
        n. tr(tdcs(hed(gTxt('smd_prognostics_ttl_realopts'), 3), 2)).
        n. tr(
            tda(gTxt('smd_prognostics_req_headers'), ' class="smd_label"').
            tda(
                checkbox('smd_prognostics_req_headers[]', 'TRACE', $rh_trace).
                '<label>'.gTxt('smd_prognostics_rh_trace').'</label>'.
                checkbox('smd_prognostics_req_headers[]', 'PUT', $rh_put).
                '<label>'.gTxt('smd_prognostics_rh_put').'</label>'.
                checkbox('smd_prognostics_req_headers[]', 'DELETE', $rh_del).
                '<label>'.gTxt('smd_prognostics_rh_del').'</label>'
            )
        ).
        n. tr(
            tda(gTxt('smd_prognostics_sql_inject'), ' class="smd_label"').
            tda(
                selectInput('smd_prognostics_sql_inject[]', $throw_codes, $throws[0], 0).
                gTxt('smd_prognostics_with').
                fInput('text', 'smd_prognostics_sql_inject[]', $throws[1], '','','',60).br.
                gTxt('smd_prognostics_sensitivity').
                fInput('text', 'smd_prognostics_inject_sensitivity', $smd_prognostics_inject_sensitivity, '','','',5).sp.gTxt('smd_prognostics_sensitivity_explain').br.
                gTxt('smd_prognostics_xss').
                yesnoRadio('smd_prognostics_xss', $smd_prognostics_xss).sp.gTxt('smd_prognostics_xss_explain')
            )
        ).
        n. tr(
            tda(gTxt('smd_prognostics_send_forensics'), ' class="smd_label"').
            tda(
                checkbox('smd_prognostics_rt_forensics[]', 'hdr', $rt_hdr).
                '<label>'.gTxt('smd_prognostics_rt_hdr').'</label>'.
                checkbox('smd_prognostics_rt_forensics[]', 'sql', $rt_sql).
                '<label>'.gTxt('smd_prognostics_rt_sql').'</label>'
            )
        ).
        n. tr(tdcs(hed(gTxt('smd_prognostics_ttl_fileopts'), 3), 2)).
        n. tr(
            tda(gTxt('smd_prognostics_check_for'), ' class="smd_label"').
            tda(
                checkbox('smd_prognostics_check_for[]', 'add', $adds) .
                '<label>'.gTxt('smd_prognostics_ch_add').'</label>'.
                checkbox('smd_prognostics_check_for[]', 'delete', $dels).
                '<label>'.gTxt('smd_prognostics_ch_del').'</label>'.
                checkbox('smd_prognostics_check_for[]', 'modify', $mods).
                '<label>'.gTxt('smd_prognostics_ch_mod').'</label>'
            )
        ).
        n. tr(
            tda(gTxt('smd_prognostics_listloc'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_listloc', $smd_prognostics_listloc, '','','',60).sp.gTxt('smd_prognostics_csv'))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_excludir'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_excludir', $smd_prognostics_excludir, '','','',60).sp.gTxt('smd_prognostics_csv'))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_ignores'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_ignores', $smd_prognostics_ignores, '','','',60).sp.gTxt('smd_prognostics_csv'))
        ).
        n. tr(tdcs(hed(gTxt('smd_prognostics_ttl_plugopts'), 3), 2)).
        n. tr(
            tda(gTxt('smd_prognostics_auth_users'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_users', $smd_prognostics_users, '','','',60).sp.gTxt('smd_prognostics_csv').sp.gTxt('smd_prognostics_csense'))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_txpdir'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_txpdir', $smd_prognostics_txpdir, '','','',60))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_progloc'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_dir', $smd_prognostics_dir, '','','',60))
        ).
        n. tr(
            tda(gTxt('smd_prognostics_progpfx'), ' class="smd_label"').
            tda(fInput('text', 'smd_prognostics_prefix', $smd_prognostics_prefix, '','','',60))
        ).
        n. tr(tda(fInput('submit', 'submit', gTxt('save'), 'publish'))).
        n. endTable().
        n. tInput().
        n. '</form>'.
        n. '</div>'.
        n. '</div>';
}

// ----------  Security advice
function smd_prognostics_advice($msg = '')
{
    global $smd_prognostics_event, $prefs, $event, $DB;
    require_once txpath.'/lib/IXRClass.php';

    pagetop(gTxt('smd_prognostics_ttl_advice'), $msg);

    $checks = array();

    // Prognostics dir in docroot?
    if (strpos(get_pref('smd_prognostics_dir', txpath), $prefs['path_to_site']) !== false) {
        $checks[] = gTxt('smd_prognostics_docroot_prognostics');
    }

    // Setup still exists?
    if (@is_dir(txpath . DS. 'setup')) {
        $checks[] = gTxt('smd_prognostics_setup_exists');
    }

    // RPC still exists?
    if ( ($prefs['enable_xmlrpc_server'] == 0) && (@is_dir(realpath(txpath.DS.'..'.DS. 'rpc'))) ) {
        $checks[] = gTxt('smd_prognostics_rpc_exists');
    }

    // New Txp version/branch available?
    include_once txpath.'/include/txp_diag.php';
    $now = time();
    $updateInfo = unserialize(get_pref('smd_prognostics_last_update_check', ''));

    if (!$updateInfo || ( $now > ($updateInfo['when'] + (60*60*24)) )) {
        $updates = checkUpdates();
        $checks[] = $updateInfo['msg'] = ($updates) ? gTxt($updates['msg'], array('{version}' => $updates['version'])) : '';
        $updateInfo['when'] = $now;
        set_pref('smd_prognostics_last_update_check', serialize($updateInfo), 'smd_prognos', PREF_HIDDEN, 'text_input');
    }

    // Files dir in docroot?
    if (strpos($prefs['file_base_path'], $prefs['path_to_site']) !== false) {
        $checks[] = gTxt('smd_prognostics_docroot_files');
    }

    // Tmp dir in docroot?
    if (strpos($prefs['tempdir'], $prefs['path_to_site']) !== false) {
        $checks[] = gTxt('smd_prognostics_docroot_tmp');
    }

/*
    // TODO: check what SHOW GRANTS returns and determine if it could be a security risk
    $res = safe_query('SHOW GRANTS');
    if (numRows($res) > 0) {
        $checks[] = gTxt('smd_prognostics_show_grants');
    }
*/

    // Does this MySQL user have FILES privs?
    $randfile = $prefs['tempdir'].DS.rand().time().'.sql';
    $res = @safe_query('SELECT id INTO OUTFILE "'.$randfile.'" FIELDS TERMINATED BY "\t" LINES TERMINATED BY "\n" FROM txp_image WHERE 1 LIMIT 1');
    if (mysqli_error($DB->link) == '') {
        $checks[] = gTxt('smd_prognostics_sql_file_privs');
        if (is_file($randfile)) {
            @unlink($randfile);
        }
    }

    echo n. '<div class="txp-layout">'.
        n. '<div class="txp-layout-2col">'.
        n. '<h1 class="txp-heading">'.
        n. gTxt('smd_prognostics_ttl_advice').
        n. '</h1>'.
        n. '</div>'.
        n. '<div id="'.$smd_prognostics_event.'_control" class="txp-layout-2col">'.
        n. smd_prognostics_button_bar('adv').
        n. '</div>'.
        n. '<div id="'.$smd_prognostics_event.'_container" class="txp-container">'.
        n. startTable('', '', 'smd_prognostics_advice');

    if ($checks) {
        foreach($checks as $check) {
            echo n. tr(tda($check));
        }
    } else {
        echo n. tr(tda(gTxt('smd_prognostics_tight')));
    }

    echo endTable(),
        n. '</div></div>';
}

// ---------- Common buttons
function smd_prognostics_button_bar($active = '')
{
    global $smd_prognostics_event;

    $active = ($active) ? $active : 'setup';

    $btns = array(
        'ack' => eLink($smd_prognostics_event, 'smd_prognostics_ack', 'smd_prognostics_suppress', '1', gTxt('smd_prognostics_pnl_ack')),
        'adv' => sLink($smd_prognostics_event, 'smd_prognostics_advice', gTxt('smd_prognostics_pnl_advice')),
        'fil' => sLink($smd_prognostics_event, 'smd_prognostics_files', gTxt('smd_prognostics_pnl_files')),
        'set' => sLink($smd_prognostics_event, 'smd_prognostics_setup', gTxt('smd_prognostics_pnl_setup')),
    );

    return graf(
            (($active == 'set') ? strong($btns['set']) : $btns['set'])
            .n.(($active == 'fil') ? strong($btns['fil']) : $btns['fil'])
            .n.(($active == 'ack') ? strong($btns['ack']) : $btns['ack'])
            .n.(($active == 'adv') ? strong($btns['adv']) : $btns['adv'])
        , ' class="txp-buttons"');
}

// ---------- Hash the hashfile
function smd_prognostics_self_hash() {
    global $smd_prognostics_checksums;

    if (file_exists($smd_prognostics_checksums)) {
        $content = smd_prognostics_prep_file($smd_prognostics_checksums);
        $hash = md5($content);
    } else {
        $hash = NULL;
    }
    set_pref('smd_prognostics_sumhash', $hash, 'smd_prognos', PREF_HIDDEN, 'text_input');
}

// ---------- Compile list of files to monitor
function smd_prognostics_readfiles() {
    $filelist = array();

    $smd_prognostics_listloc = get_pref('smd_prognostics_listloc', '');
    $excludes = smd_prognostics_ignore_list();

    if ($smd_prognostics_listloc) {
        foreach (do_list($smd_prognostics_listloc) as $loc) {
            // NOTE: not using GLOB_BRACE to grab regular and dot files, since it's not always available cross-OS
            $filelist = array_merge($filelist, smd_prognostics_rglob("*", GLOB_MARK, $loc, $excludes), smd_prognostics_rglob(".*", GLOB_MARK, $loc, $excludes));
        }
    }
    return $filelist;
}

// ---------- Prepare file contents for md5. Assumes file exists
// Checks to see if large files are binary before wasting time stripping newlines and stuff
function smd_prognostics_prep_file($file) {
    $content = file_get_contents($file);
    $stat = stat($file);
    $dostrip = true;
    // Perform the strip regardless on files < 1Kb as it has little impact
    if ($stat['size'] > 1024000) {
        $part = substr($content, 0, 1536000); // First 1.5KB
        if (strpos($part, 0x00) || (strpos($part, 0x0D) !== false) || (strpos($part, 0x0A) !== false)) {
            // Likely a binary file: leave it be
            $dostrip = false;
        }
    }
    if ($dostrip) {
        $content = str_replace(array("\r\n", "\$HeadURL: http:"), array("\n", "\$HeadURL: https:"), $content);
    }
    return $content;
}

// ---------- Pre-compute excluded files and dirs, expanding wildcards in the process
function smd_prognostics_ignore_list() {
    global $smd_prognostics_checksums;

    $excl = do_list(get_pref('smd_prognostics_excludir', ''));
    $ign = get_pref('smd_prognostics_ignores', '');

    // Add any files to permanently exclude here (NOT dirs: they're ignored automatically)
    $ignarr = ($ign) ? do_list($ign) : array();

    // Expand any wildcard filenames
    $regarr = array();
    foreach ($ignarr as $idx => $item) {
        if ( (strpos($item, '*') !== false) || (strpos($item, '?') !== false) ) {
            $regarr[] = str_replace( array("\*", "\?"), array(".*", "."), preg_quote($item) );
            unset($ignarr[$idx]); // Remove the wildcard filename from the ignore list
        }
    }
    $regexclude = ($regarr) ? '/^(' . join('|', $regarr) . ')$/' : '';
    $permexclude = array_merge(array(basename($smd_prognostics_checksums)), $ignarr);

    return array($excl, $regexclude, $permexclude);
}

// Frankensteined from http://snipplr.com/view/16233/recursive-glob/
function smd_prognostics_rglob($pattern, $flags=0, $path='', $excludes = array(), $excl=array(), $ign='') {
    if (!$path && ($dir = dirname($pattern)) != '.') {
        if ($dir == '\\' || $dir == DS) $dir = '';
        return (array)smd_prognostics_rglob(basename($pattern), $flags, $dir . DS, $excludes);
    }
    $paths = glob($path . '*', GLOB_ONLYDIR | GLOB_NOSORT);
    $files = glob($path . $pattern, $flags);

    if (is_array($paths)) {
        foreach ($paths as $p) {
            $parts = explode(DS, $p);
            $pinfo = array_pop($parts);
            if (!in_array($pinfo, $excludes[0])) {
                $files = array_merge((array)$files, (array)smd_prognostics_rglob($pattern, $flags, $p . DS, $excludes));
                foreach($files as $idx => $theFile) {
                    $parts = explode(DS, $theFile);
                    $fex = array_pop($parts);
                    $rex = ($excludes[1]) ? preg_match($excludes[1], $fex) : false;
                    if($fex=='' || in_array($fex, $excludes[2]) || $rex) {
                        unset($files[$idx]);
                    }
                }
            }
        }
    }
    return $files;
}

// Format forensic data for a file
function smd_prognostics_forensic_output($file, $fi) {
    global $prefs;

    $dform = $prefs['dateformat'];
    $sep = n;
    $out = '';

    $out .= $sep . gTxt('smd_prognostics_stat_name') . $file;
    $out .= $sep . gTxt('smd_prognostics_stat_size') . $fi['size'];
    $out .= $sep . gTxt('smd_prognostics_stat_mod') . strftime($dform, $fi['mtime']);
    $out .= $sep . gTxt('smd_prognostics_stat_uid') . $fi['uid'];
    $out .= $sep . gTxt('smd_prognostics_stat_gid') . $fi['gid'];

    return $out;
}

// ---------- Does what it says on the tin
// Assumes 'textpattern' is the admin-side directory if server var not set. Must fix in core one day with true constant
function smd_prognostics_guess_admin_dir() {
    $admindir = trim(dirname($_SERVER['PHP_SELF']), '/\\');
    $admindir = (empty($admindir)) ? 'textpattern' : $admindir;
    return $admindir;
}

// ---------- Get common server info for mail headers, etc
function smd_prognostics_header_info($fromname) {
    $domainparts = do_list(doStrip(serverSet('SERVER_NAME')), '.');
    $numparts = count($domainparts);
    $domain = $domainparts[$numparts-2] . '.' . $domainparts[$numparts-1];
    $reply_to = 'noreply@'.$domain;
    $txpdir = get_pref('smd_prognostics_txpdir', hu.smd_prognostics_guess_admin_dir());
    $sep = IS_WIN ? "\r\n" : "\n";
    $headers = "From: $fromname <$reply_to>".
        $sep.'Reply-To: '.$reply_to.
        $sep.'X-Mailer: Textpattern'.
        $sep.'Content-Transfer-Encoding: 8bit'.
        $sep.'Content-Type: text/plain; charset="UTF-8"'.
        $sep;

    $out = array(
        'domain' => $domain,
        'reply_to' => $reply_to,
        'txpdir' => $txpdir,
        'sep' => $sep,
        'headers' => $headers,
    );

    return $out;
}

// Multi-file dropdown selection
function smd_prognostics_multisel($selname='', $tree=array(), $sel=array()) {
    $out[] = '<select id="'.$selname.'" name="'.$selname.'[]" class="list" style="height:400px;" multiple="multiple">';
    foreach ($tree as $leaf) {
        $selected='';
        if (in_array($leaf, $sel)) {
            $selected = ' selected="selected"';
        }

        $out[] = t.'<option'.$selected.'>'.htmlspecialchars($leaf).'</option>'.n;
    }
    $out[] = '</select>';
    return join('',$out);
}



//****************************************************************
// Web page      : http://code.google.com/p/phprotector
// Autor                : Hugo Sousa        adamastor666@gmail.com
// Date              : 2010-03-25
// Version          : 0.3.1.1
//
//***************************************************************
class smd_prog_PhProtector {
    var $SHOW_ERRORS;
    var $do_xss;

    public function __construct($show_errors) {
        $this->SHOW_ERRORS=$show_errors;
        if ($this->SHOW_ERRORS) {
            error_reporting(E_ERROR | E_WARNING | E_PARSE);  //Show errors
            ini_set('display_errors', "1"); //display errors
        } else {
            ini_set('display_errors', "0"); //display errors
            ini_set('log_errors', "1"); //log_errors
        }
        $this->do_xss = get_pref('smd_prognostics_xss', 0);
    }

    /*
    * Main function to be called in a index page that redirects to other pages
    *
    */
    public function isMalicious() {
        $sqli = 0;

        $sqli = callback_event('smd_frognostics', 'sql_injection', false);

        if (!$sqli) {
            $num_bad_words1 = $this->CheckGet();
            $num_bad_words2 = $this->CheckPost();

            $thresh = explode(',', get_pref('smd_prognostics_inject_sensitivity', 1));
            if (!isset($thresh[1])) {
                $thresh[1] = $thresh[0];
            }
            $thresh[0] = is_numeric($thresh[0]) ? $thresh[0] : 1;
            $thresh[1] = is_numeric($thresh[1]) ? $thresh[1] : 1;

            if ($num_bad_words1 >= $thresh[0]) {
                $sqli = true;
            }

            if ($num_bad_words2 >= $thresh[1]) {
                $sqli = true;
            }
        }

        return (($sqli <= 0) ? false : $sqli);
    }

    //check for sql injection and XSS in Post variables
    private function CheckPost() {
        $num_bad_words = 0;

        foreach($_POST as $campo => $input) {
            // XSS PROTECTION
            if ($this->do_xss) {
                if (is_array($_POST[$campo])) {
                    $_POST[$campo] = array_map('htmlentities', $_POST[$campo], array_fill(0, count($_POST[$campo]), ENT_NOQUOTES) );
                } else {
                    $_POST[$campo]= htmlentities($_POST[$campo], ENT_NOQUOTES);
                }
            }
            $num_bad_words = $num_bad_words + $this->wordExists($input); //SQL INJECTION
        }

        return $num_bad_words;
    }

    //check for sql injection and XSS in GET variables
    private function CheckGet() {
        $num_bad_words = 0;

        foreach($_GET as $campo => $input) {
            // XSS PROTECTION
            if ($this->do_xss) {
                if (is_array($_GET[$campo])) {
                    $_GET[$campo] = array_map('htmlentities', $_GET[$campo], array_fill(0, count($_GET[$campo]), ENT_NOQUOTES) );
                } else {
                    $_GET[$campo]= htmlentities($_GET[$campo], ENT_NOQUOTES);
                }
            }
            $strinput = (is_array($input)) ? join('', $input) : $input;
            if($this->isIdInjection($campo, $strinput)){ //SQL ID INJECTION
                $num_bad_words =    $num_bad_words + 0.5;
            }

            $num_bad_words = $num_bad_words + $this->wordExists($input); //SQL INJECTION
        }

        return $num_bad_words;
    }

    /**
    *   return true if injection sql word is found.
    *   The input is tested if is equal to a sql injection pattern
    *   \b[^a-z]*?drop[^a-z]*?\b
    *    http://www.pagecolumn.com/tool/regtest.htm
    **//*        "/*","+"               */
    private function wordExists($input) {
        $num_bad_words = 0;
        $input = is_array($input) ? $input : array($input);

        /*
         WORD AFTER
        */
        $baddelim1 = "[^a-z]*"; //the delim should be from "a" to "b" anything else is considered sql injection :)
        $baddelim2 = "[^a-z]+";
        $badwords= array("union", "select", "show", "insert", "update", "delete", "drop", "truncate", "create", "load_file", "exec", "#", "--");
        //"/*"
        foreach($badwords as $badword) {
            $expression = "/".$baddelim1.strtolower($badword).$baddelim2."/";
            foreach ($input as $wrd) {
                if (preg_match ($expression, strtolower($wrd))) {
//dmp('*WA*',$badword, $wrd);
                    //die("sql injection!");
                    $num_bad_words++;
                }
            }
        }

        /*
        BEFORE WORD
        */
        $baddelim1 = "[^a-z]+"; //the delim should be from "a" to "b" anything else is considered sql injection :)
        $baddelim2 = "[^a-z]*";
        $badwords= array("@@version", "@@datadir", "user", "version");

        foreach($badwords as $badword) {
            $expression = "/".$baddelim1.strtolower($badword).$baddelim2."/";
            foreach ($input as $wrd) {
                if (preg_match ($expression, strtolower($wrd))) {
//dmp('*BW*',$badword, $wrd);
                    //die("sql injection!");
                    $num_bad_words++;
                }
            }
        }

        /*
        BEFORE WORD AFTER
        */
        $baddelim1 = "[^a-z]+"; //the delim should be from "a" to "b" anything else is considered sql injection :)
        $baddelim2 = "[^a-z]+";
        $badwords= array("benchmark", "--", "varchar", "convert", "char", "limit", "information_schema","table_name", "from", "where", "order");

        foreach($badwords as $badword) {
            $expression = "/".$baddelim1.strtolower($badword).$baddelim2."/";
            foreach ($input as $wrd) {
                if (preg_match ($expression, strtolower($wrd))) {
//dmp('*B-W-A*',$badword, $wrd);
                    //die("sql injection!");
                    $num_bad_words++;
                }
            }
        }
//dmp($num_bad_words);
        return $num_bad_words;
    }

    /**
    *   return true if an ID is not really an ID
    *
    **/
    private function isIDInjection($campo, $input) {
        $reg="/^id/";

        if(preg_match($reg, $campo)) {
            if(!$this->stringIsNumberNotZero($input)) {
                return true;     // if is ID and NOT INTEGER or NULL -> SQL INJECTION!!
            }
        }

        return false;
    }

    /**
    *   return true if the string is a number (different from 0, the id could not be zero!)
    *  TODO: check if *all* chars are zero and fail, e.g. id=0000
    **/
    private function stringIsNumberNotZero( $string ) {
        if (empty($string)) {
            return false;
        }
        return ctype_digit($string);
    }
} //end class
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
h1. smd_prognostics

The _Admin -> Diagnostics_ panel is great if you remember to look at it from time to time. But if your server is compromised, how would you know about a sneaky Trojan or malware until your visitors complain or the search engines block your site?

The answer is to use smd_prognostics to tell you when things have changed so you can take action immediately.

h2. Features

* Monitor files and attacks in and around your Textpattern installation.
* Automatically detect any changes and display/send notification to designated user(s).
* Customise where and how often the checks are performed.
* Acknowledge known alterations and send repeat alarms at configurable intervals if the situation remains unchecked.

h2. Installation / uninstallation

*(warning)Requires Textpattern 4.6.2+*

Download the plugin from either "GitHub":https://github.com/Bloke/smd_prognostics/releases, or the "software page":https://stefdawson.com/sw, paste the code into the Textpattern _Admin -> Plugins_ panel, install and enable the plugin. Note that it is recommended that the plugin runs as priority 1 so it can detect things before other plugins.

To uninstall, delete from the _Admin -> Plugins_ panel. You may use smd_prefalizer to remove any @smd_prognostics_*@ preferences that the plugin created.

Visit the "forum thread":https://forum.textpattern.io/viewtopic.php?id=34938 for more info or to report on the success or otherwise of the plugin.

h2. Quick start: the three steps to detection

# Visit _Extensions -> Prognostics_, alter the setup information to taste and *make sure you _Save_ it*
# Click the Prognostic page's _Files_ button (ignore any warning about missing checksums for now: they've not been created yet) and choose the files you wish to monitor. *Make sure you _Save_ the changes*
# Go about your business. If the filesystem changes you'll be told about it. Please consider helping to "make the plugin better":#smd_proghelp_better

h2(#smd_proghelp_setup). Setup

The _Prognostic setup_ page houses the following configuration options:

h3. Monitoring options

; %Check files on public side clicks%
: Checks are always performed when people visit admin side tabs. You may also elect to check the files when visitors/bots browse your web site if you prefer (see "how it works":#smd_proghelp_howitworks for details).
; %Check files (at most) every%
: The plugin does not check the files every click because that would place unnecessary strain on the server. Instead you choose a configurable time -- in seconds -- after which the very next admin- or public-side click will trigger the check.
; %Check files between%
: Two times of day between which the files will be checked. You could set this to off-peak hours if you preferred to minimise the plugin's impact on daytime visitors.
: Default: @00:00 => 23:59@
; %Check this many files each time%
: Instead of testing every single file each time -- which will slow down your site / admin side -- it is good practice to only check a subset of files every time the plugin is triggered.
; %Alarm on detection and every%
: When something has changed and it's detected, an alarm action is always taken. But if the plugin continually bombarded you with information it would be annoying and not as useful. This setting allows you to configure the interval between repeat nags of the same message. Once a day (the default of 86400 seconds) by e-mail is usually enough unless you're a masochist. Note that if more files are changed -- even when the timeout period has yet to elapse -- you will receive another alert.
: You may specify two values (comma-separated) if you wish: the first is the time between notifications to the Textpattern admin side; the second is the time between e-mails. If you use only one value then it will be applied to both.
; %Notify via%
: Choose how you wish to be notified:
:: _Txp Interface_ will display a message on the Textpattern admin side when a change is detected.
:: _E-mail_ will send out an e-mail about the changes.
; %Send e-mail to%
: Comma-separated list of e-mail address recipients. If this is empty no e-mails will be sent, even if you choose to be notified via e-mail.
; %Send forensics to%
: Comma-separated list of e-mail address recipients to receive forensics data (the nattily-titled _frognostics_). You can choose nobody if you wish to disable this feature, or send them to yourself, or "to me for analaysis":#smd_proghelp_better. *Please note that some data is quite sensitive and may divulge paths to your files or site*. If you prefer to keep stuff private by all means sanitize the forensics and send the edited highlights to me for analysis if you wish.

h3. Realtime options

; %Block request headers%
: If you enable this facility you can elect to block or allow certain types of speical HTTP request. Any request of a checked type will be blocked and a message will be returned instead of the page. The core types GET, POST, HEAD and OPTIONS are automatically allowed because Textpattern requires them. The remaining three -- TRACE, PUT and DELETE -- are specialist headers that aren't used by the core but may be required by some plugins. Permit them if you wish by clearing the relevant check box(es), otherwise for maximum protection keep this feature switched on with all three types of header checked.
; %Protect against SQL injection%
: Monitor incoming URLs for SQL injection attacks and deal with them in a variety of ways. When an attack is detected the request can be @Block@ed or you can send an HTTP status header so you can deal with the attack on your error pages. If you type anything in the @with@ box, the given message will be displayed on the page.
: You may specify @txp_form:name-of-form@ in the @with@ box to hand off control to a custom form first before the result is thrown to the page. You could use this, for example, to mail off your own diagnostics or to make a decision on whether the SQL attack was legitimate or not and either block it yourself or strip out anything dodgy and send the request on. If you wish to go further, there is a "callback available":#smd_proghelp_callbacks.
: The sensitivity may be altered by raising the number; 1 is the most sensitive (i.e. 1 of the trigger words will trip the switch). You can control GET and POST sensitivity independently by putting two comma-separated values in the box. If you accept comments on your site it may be prudent to raise the POST value (the second one), as any comment that contains words like @select@ or @union@ or even Textile's @--@ will trip the injector. A good trade-off betwen security and false alarms for a site with comments is @1, 3@. Raise further if your commenters regularly post code fragments or SQL statements.
: There is also the option to employ an XSS(Cross-Site Scripting) shield which will encode all spurious characters to help prevent injection / cookie attacks. Note that because the comment preview step is always skipped (to avoid triggering on preview and annoying frognostic recipients), this may cause publicly submitted comments to not appear as previewed. Especially if angle brackets or tags are used in the comment text.
; %Send forensics for%
: E-mail frognostics info to the designated e-mail address(es) when either header violations, SQL injections, or both are detected.

h3. Filesystem options

; %Check files for%
: Choose what type of alterations you wish to monitor: new files added, files deleted or files modified. By default, additions are not selected because it incurs a (tiny) extra processing penalty to the checks. Therefore if you want to monitor for additions, you need to opt-in.
; %File locations%
: Comma-separated list of directories from which you wish to be able to select files for monitoring. Choose only the top-level folder; everything beneath will automatically be selected. It defaults to your site root. If using a multi-site setup you may have to alter this.
; %Exclude folders%
: Since the list of files under your Textpattern installation may potentially be large you can designate some folders to be automatically excluded, which makes the file list shorter.
: Default: @images, files, tmp@.
; %Ignore files%
: Some files, such as the error_log file on typical Linux hosts, pop up unannounced and you may periodically delete them. On development sites this can cause excessive alarms during debugging. To minimise this, you can list files here that you always wish to ignore. No paths are necessary: just supply a comma-separated list of file names. Wildcards (* and ?) are permissable.
: Note that the prognostics checksums file is always treated as a special case so there's no need to list it explicitly.

h3. Plugin options

; %Restrict prognostic config to%
: If you have to issue Publisher / Managing Editor privs to someone else as well as yourself but don't want anyone messing with the plugin settings, put a list of permitted user names in this box. %(warning)Be careful. The names are case-sensitive and if you misspell a name you can lock yourself out of editing the settings!%
; %Admin-side URL%
: The URL of your 'textpattern' admin side. This is usually @http://site.com/textpattern@ but if you are running "multi-site":#smd_proghelp_multisite or have otherwise altered the directory, you can specify it here.
; %Prognostics folder%
: The folder where the prognostics checksums file will reside. The directory must already exist and be writable, or your chosen location will be ignored. It is *highly recommended* that this folder be outside of your website document root, i.e. in a non-web-accessible location.
; %Unique prefix%
: Prefix the checksums file with this string. Useful to avoid files clashing if you are using the same (non-docroot) folder to store the checksums from more than one site.

h2(#smd_proghelp_howitworks). How it works

Ideally, the plugin would be a timed script that runs every N seconds. But that requires a particular piece of software (cron) on your host and there's no guarantee it exists. Thus the only thing that can 'trigger' the plugin is Textpattern itself. The plugin runs every time you interact with the admin side, but if it checked all the files against all the checksums you have chosen on every click, your admin side would slow down a lot. The compromise is to specify a timeout value and a number of files to check. This is how it works:

# When you click a tab or interact with the admin side, the plugin looks at when you _last_ clicked something and asks "is it greater than N (seconds)?" where N is the value of @Check files (at most) every@ on the Setup panel. It also checks if the current time of day is between the values specified in @Check files between@.
# If so, it grabs as many files as you have specified in @Check this many files each time@, tests them and resets the timer. It keeps a note of how far it has worked through your list of files and continues where it left off next time it runs.
# If the value of N has not yet been reached, it does nothing, thus saving you precious processor cycles

All that is great if you're continually using the admin side and producing clicks for the plugin to run. But once you hand over the site to your client, they may not use the admin side as often as you -- if at all. Thus your files would rarely/never be checked. To counteract this, you can ask the plugin to respond to public side clicks as well so that any time a visitor (or bot) crawls your pages the plugin runs, checks if the timeout has been exceeded and, if so, checks some files and resets the timer (exactly as it does on the admin side).

This will push the processing load onto your public site, but since it's only run at most once every N seconds and you specify how many files to read each time, and at what times of day, you can control how much of an impact it has by matching your desire to know 'instantly' that something has changed versus the volume of traffic / visitors to the site and how often you want to delay their browsing.

The good thing about being able to specify both the timeout, the time of day and the quantity of files is that you can determine if the plugin runs 'little and often' or takes more of your resources when it runs less frequently or during off-peak times. The recommendation is to run fairly frequently -- between 10 and 60 seconds is good -- and only processing a small number of files, say 20 or 30 each time.

As an example, if you monitored every file in a stock Txp installation with a ten-second timeout and checked 30 files each time, then -- assuming you had at least five clicks per minute -- you would cycle through them in under a minute. And your visitors probably won't notice the delay. If you have fewer than five clicks per minute then it will take longer to cycle through the files and the chance of catching changes as they happen reduces. But if you run too often (say, every one or two seconds) you are wasting your visitors' time, your server's resources and increasing the chance of the plugin misinforming you of alterations (it may still be partway through the previous run when the next occurs and trigger a warning that something isn't right).

The plugin is written to be as quick and efficient as it possibly can to avoid any delays; there may be "room for improvement":#smd_proghelp_better of course! Please be aware that no detection system is foolproof and there is no substitute for vigilance and "good passwords":https://stefdawson.com/blog/choosing-a-brilliant-password :-)

h2(#smd_proghelp_monfiles). Monitoring files

Clicking the _Files_ button takes you to a screen with a textarea that allows you to choose the files you wish to monitor. A count of the current number of monitored files is shown at the top, along with the number of files available in your chosen file location(s). The following files will be in the list:

# all files in all subdirectories from all @File locations@ you specified to monitor in the Setup screen
# _except_ any files below the directories you chose to exclude
# _except_ any file names you explicitly chose to ignore
# _except_ the prognostics checksums file

At first, no files will be selected so you will be monitoring nothing. Choose which files you wish to monitor and save the changes. The plugin will keep tabs on those files.

If you have elected to watch for additions to the file system, any files in any of your chosen locations that are not currently in the list at the time you hit _Save_ (regardless of whether you are monitoring them or not) will trigger an alarm. Go ahead and try it: add some files to your server or install a new theme or something and the plugin will tell you.

h2(#smd_proghelp_ack). Acknowledging alarms

If one or more files are altered, deleted, or new files have been added (depending on which actions you have elected to monitor) the plugin will detect this when the next admin- or public-side click is received and the timeout cycle is exceeded. It will then take the action you chose. Note of course that you won't see the admin-side warning if not logged in!

The message delivered to you contains a link to the Acknowledgement page (which can also be reached by clicking the _Alarms_ button from the Prognostics panel). You are presented with a list of all the filesystem alterations. If you know about the changes -- e.g. you initiated them by uploading some new file version(s) -- then you can acknowlegde this by placing a check mark next to the files you know contain legitimate alterations. When you select _Acknowledge_ from the dropdown below the list, you signify to the plugin that you accept the changes. Thus the new file(s) become the baseline.

If you are monitoring file system additions, the act of acknowledging the alarm indicates that you are happy for the new file(s) to be monitored. They will automatically be added to the list of Files to monitor (you can verify this by visiting the Prognostic panel's _Files_ list). If you know about some of the files (perhaps they are new additions) and you don't want to monitor them, select the file(s) and choose _Ignore_. The alarm will be acknowledged but you will not be monitoring the file(s).

If you choose not to acknowledge/ignore some or all of the files, you will continue to be nagged at your designated alarm frequency until you acknowledge the problems or fix the filesystem to its original state. Do bear in mind when configuring the frequency that alerting too often can alienate users and make an alarm situation less effective.

h2(#smd_proghelp_csi). Forensics

*Before* acknowledging alarms, you may choose to send off forensics information to a designated e-mail address. The following information is sent:

* File information about each changed/added file, such as its size, modification time, and user / group ownership
* The contents of the files themselves, BASE-64 encoded in the body of the e-mail
* The names & paths of any deleted files
* Any Textpattern log entries that occurred either side of the alarm condition (logging must be enabled in your _Admin -> Preferences_)

You can select which file information to send off via the check boxes. The ones you choose will remain selected for convenience after the forensics have been sent, so you may immediately _Acknowledge_ the ones you notified.

h2(#smd_proghelp_advice). Advice

Clicking the _Advice_ button will run through a series of checks and offer suggestions on how to harden your installation. The most important one to follow is if you are warned about the prognostics checksums file being in docroot. It is *highly recommended to move it somewhere non-web accessible*.

h2(#smd_proghelp_callbacks). Callbacks

The plugin has a callback of its own allowing you to perform custom SQL injection tests. Hook your own code into it by raising a callback on the event @smd_frognostics@ and step @sql_injection@. This callback fires on every page access if @Protect against SQL injection@ is enabled.

Your code can return:

* -1 to assert "no injection detected at all and do not run the plugin's SQL checks"
* 0 to assert "no injection detected but run the plugin checks as well"
* 1 to assert "injection detected" (plugin checks are bypassed)

In all cases, the plugin will continue to process forensics evidence and HTTP redirection if the options are enabled. Bail out with an @exit()@ or @txp_die()@ if you wish the plugin to terminate instead.

h2(#smd_proghelp_multisite). Multi-site setup

If you are using Textpattern's multi-site feature there are some additional things to note:

# You should set smd_prognostics up on _each_ domain you wish to protect to avoid overloading one domain with checking them all.
# Choose just one of your domains as the 'master' which will monitor the Textpattern core files.
# Consider moving all the domains in the @/sites@ folder outside docroot.
# Ensure you employ a @Unique prefix@ or your checksums files will clash, causing odd behaviour. The recommended method is to use the @Prognostics folder@ setting to move all checksum files to a central location -- outside docroot -- and use the same directory for all domains. The @Unique prefix@ will then distinguish between them.
# The @Admin-side URL@ may well be wrong: you should probably change this on each domain.

h2(#smd_proghelp_better). Help make the plugin better

If smd_prognostics does detect some rogue elements in your filesystem, please consider sending the forensics to prognostics [at] stefdawson [dot] com with as much information as you possibly can. You can either do this automatically from within the plugin (see the setup page, though note the sensitivity of some of the data sent) or copy and paste relevant information into an e-mail. The sort of stuff that might be useful is:

* Textpattern (and/or server) logs for the time of the attack.
* The lines of the file(s) that were affected (or the files in their entirety).
* The content of any additional lines added or altered in the files.
* Your Textpattern, PHP, MySQL and Apache versions.
* Your hoster company name.

and so on. Any and all information will be treated in the strictest confidence of course. Analysing this data may allow me to improve the plugin and perhaps close any security holes in Textpattern itself, or even help make the plugin more pro-active by detecting the various kinds of attack in progress and minimising damage to your file system. Thanks in advance for you help.

h2. Author / credits

Written by "Stef Dawson":https://stefdawson.com/contact. Many thanks to Kevin Potts and Steve Dickinson for beta testing and feature enhancements. Also kudos to Hugo Sousa for the phProtector class.
# --- END PLUGIN HELP ---
-->
<?php
}
?>