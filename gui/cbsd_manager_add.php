<?php
require_once 'auth.inc';
require_once 'guiconfig.inc';
require_once("cbsd_manager-lib.inc");

global $configfile;
global $workdir;

$prerequisites_ok = "true";
$pgtitle = array(gtext("Extensions"), "CBSD", "Create");
$pconfig = [];

if(!(isset($pconfig['jailname']))):
	$pconfig['jailname'] = 'jail1';
endif;
if(!(isset($pconfig['ipaddress']))):
	$pconfig['ipaddress'] = '';
endif;

if(!(isset($pconfig['fqdn']))):
	if(file_exists("{$rootfolder}/conf/fqdn")):
		$pconfig['fqdn'] = file_get_contents("{$rootfolder}/conf/fqdn");
	else:
		$pconfig['fqdn'] = 'my.domain';
	endif;
endif;

if(!(isset($pconfig['cpu']))):
	if(file_exists( $configfile )):
		$pconfig['cpu'] = exec("/usr/bin/grep '^last_cpu_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['cpu'])):
			$pconfig['cpu'] = '0';
		endif;
	else:
		$pconfig['cpu'] = '0';
	endif;
endif;

if(!(isset($pconfig['ram']))):
	if(file_exists( $configfile )):
		$pconfig['ram'] = exec("/usr/bin/grep '^last_ram_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['ram'])):
			$pconfig['ram'] = '0';
		endif;
	else:
		$pconfig['ram'] = '0';
	endif;
endif;

if(!(isset($pconfig['imgsize']))):
	if(file_exists( $configfile )):
		$pconfig['imgsize'] = exec("/usr/bin/grep '^last_imgsize_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['imgsize'])):
			$pconfig['imgsize'] = '0';
		endif;
	else:
		$pconfig['imgsize'] = '0';
	endif;
endif;

if(!(isset($pconfig['baserw']))):
	if(file_exists( $configfile )):
		$pconfig['baserw'] = exec("/usr/bin/grep '^last_baserw_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['baserw'])):
			$pconfig['baserw'] = '0';
		endif;
	else:
		$pconfig['baserw'] = '0';
	endif;
endif;

if(!(isset($pconfig['vnet']))):
	if(file_exists( $configfile )):
		$pconfig['vnet'] = exec("/usr/bin/grep '^last_vnet_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['vnet'])):
			$pconfig['vnet'] = '0';
		endif;
	else:
		$pconfig['vnet'] = '0';
	endif;
endif;

if(!(isset($pconfig['allow_mount']))):
	if(file_exists( $configfile )):
		$pconfig['allow_mount'] = exec("/usr/bin/grep '^last_allow_mount_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_mount'])):
			$pconfig['allow_mount'] = '1';
		endif;
	else:
		$pconfig['allow_mount'] = '1';
	endif;
endif;

if(!(isset($pconfig['allow_nullfs']))):
	if(file_exists( $configfile )):
		$pconfig['allow_nullfs'] = exec("/usr/bin/grep '^last_allow_nullfs_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_nullfs'])):
			$pconfig['allow_nullfs'] = '1';
		endif;
	else:
		$pconfig['allow_nullfs'] = '1';
	endif;
endif;

if(!(isset($pconfig['allow_fdescfs']))):
	if(file_exists( $configfile )):
		$pconfig['allow_fdescfs'] = exec("/usr/bin/grep '^last_allow_fdescfs_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_fdescfs'])):
			$pconfig['allow_fdescfs'] = '1';
		endif;
	else:
		$pconfig['allow_fdescfs'] = '1';
	endif;
endif;

if(!(isset($pconfig['allow_procfs']))):
	if(file_exists( $configfile )):
		$pconfig['allow_procfs'] = exec("/usr/bin/grep '^last_allow_procfs_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_procfs'])):
			$pconfig['allow_procfs'] = '0';
		endif;
	else:
		$pconfig['allow_procfs'] = '0';
	endif;
endif;

if(!(isset($pconfig['allow_raw_sockets']))):
	if(file_exists( $configfile )):
		$pconfig['allow_raw_sockets'] = exec("/usr/bin/grep '^last_allow_raw_sockets_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_raw_sockets'])):
			$pconfig['allow_raw_sockets'] = '1';
		endif;
	else:
		$pconfig['allow_raw_sockets'] = '1';
	endif;
endif;

if(!(isset($pconfig['allow_tmpfs']))):
	if(file_exists( $configfile )):
		$pconfig['allow_tmpfs'] = exec("/usr/bin/grep '^last_allow_tmpfs_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_tmpfs'])):
			$pconfig['allow_tmpfs'] = '1';
		endif;
	else:
		$pconfig['allow_tmpfs'] = '1';
	endif;
endif;

if(!(isset($pconfig['allow_zfs']))):
	if(file_exists( $configfile )):
		$pconfig['allow_zfs'] = exec("/usr/bin/grep '^last_allow_zfs_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_zfs'])):
			$pconfig['allow_zfs'] = '0';
		endif;
	else:
		$pconfig['allow_zfs'] = '0';
	endif;
endif;

if(!(isset($pconfig['allow_mlock']))):
	if(file_exists( $configfile )):
		$pconfig['allow_mlock'] = exec("/usr/bin/grep '^last_allow_mlock_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_mlock'])):
			$pconfig['allow_mlock'] = '0';
		endif;
	else:
		$pconfig['allow_mlock'] = '0';
	endif;
endif;

if(!(isset($pconfig['allow_nfsd']))):
	if(file_exists( $configfile )):
		$pconfig['allow_nfsd'] = exec("/usr/bin/grep '^last_allow_nfsd_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['allow_nfsd'])):
			$pconfig['allow_nfsd'] = '0';
		endif;
	else:
		$pconfig['allow_nfsd'] = '0';
	endif;
endif;

if(!(isset($pconfig['mount_fdescfs']))):
	if(file_exists( $configfile )):
		$pconfig['mount_fdescfs'] = exec("/usr/bin/grep '^last_mount_fdescfs_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['mount_fdescfs'])):
			$pconfig['mount_fdescfs'] = '1';
		endif;
	else:
		$pconfig['mount_fdescfs'] = '1';
	endif;
endif;

if(!(isset($pconfig['mount_procfs']))):
	if(file_exists( $configfile )):
		$pconfig['mount_procfs'] = exec("/usr/bin/grep '^last_mount_procfs_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($pconfig['mount_procfs'])):
			$pconfig['mount_procfs'] = '0';
		endif;
	else:
		$pconfig['mount_procfs'] = '0';
	endif;
endif;

if(!(isset($devfs_ruleset))):
	if(file_exists( $configfile )):
		$devfs_ruleset = exec("/usr/bin/grep '^last_devfs_ruleset_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
		if(empty($devfs_ruleset)):
			$devfs_ruleset = '4';
		endif;
	else:
		$devfs_ruleset = '4';
	endif;
endif;

//if(!(isset($pconfig['vnc_bind']))):
//	$pconfig['vnc_bind'] = '127.0.0.1';
//endif;

if(!file_exists("{$workdir}/cmd.subr")):
	$errormsg = gtext('CBSD workdir not initialized yet.')
			. ' '
			. '<a href="' . 'cbsd_manager_config.php' . '">'
			. gtext('Please init CBSD workdir first.')
			. '</a>';
		$prerequisites_ok = false;
else:
//	if(!get_all_release_list()):
//		$errormsg = gtext('No basejail downloaded yet.')
//				. ' '
//				. '<a href="' . 'cbsd_manager_golds.php' . '">'
//				. gtext('Please download a image first.')
//				. '</a>';
//			$prerequisites_ok = false;
//	endif;

//	if(!get_all_pubkey_list()):
//		$errormsg = gtext('No public key added yet.')
//				. ' '
//				. '<a href="' . 'cbsd_manager_pubkey.php' . '">'
//				. gtext('Please add public key first.')
//				. '</a>';
//			$prerequisites_ok = false;
//	endif;
endif;

if($_POST):
	global $jail_dir;
//	global $configfile;
	unset($input_errors);
	$pconfig = $_POST;
	if(isset($_POST['Cancel']) && $_POST['Cancel']):
		header('Location: cbsd_manager_gui.php');
		exit;
	endif;
	if(isset($_POST['Create']) && $_POST['Create']):
		$jname = $pconfig['jailname'];
		$ipaddr = $pconfig['ipaddress'];
		$release = $pconfig['release'];
		$cpu = $pconfig['cpu'];
		$ram = $pconfig['ram'];
		$imgsize = $pconfig['imgsize'];
//		$vnc_bind = $pconfig['vnc_bind'];
		$options = "";
		if ($_POST['interface'] == 'Config'):
			$interface = "";
		else:
			$interface = $pconfig['interface'];
		endif;

		$baserw=$pconfig['baserw'];
		$vnet=$pconfig['vnet'];
		$allow_mount=$pconfig['allow_mount'];
		$allow_nullfs=$pconfig['allow_nullfs'];
		$allow_fdescfs=$pconfig['allow_fdescfs'];
		$allow_procfs=$pconfig['allow_procfs'];
		$allow_raw_sockets=$pconfig['allow_raw_sockets'];
		$allow_tmpfs=$pconfig['allow_tmpfs'];
		$allow_zfs=$pconfig['allow_zfs'];
		$allow_mlock=$pconfig['allow_mlock'];
		$allow_nfsd=$pconfig['allow_nfsd'];
		$mount_fdescfs=$pconfig['mount_fdescfs'];
		$mount_procfs=$pconfig['mount_procfs'];
		//$devfs_ruleset;

//baserw={$baserw} vnet={$vnet} allow_mount={$allow_mount} allow_nullfs={$allow_nullfs} allow_fdescfs={$allow_fdescfs} allow_procfs={$allow_procfs} allow_raw_sockets={$allow_raw_sockets} allow_tmpfs={$allow_tmpfs} allow_zfs={$allow_zfs} allow_mlock={$allow_mlock} allow_nfsd={$allow_nfsd} mount_fdescfs={$mount_fdescfs} mount_procfs={$mount_procfs}


//		$profile_path = sprintf('/usr/local/cbsd/etc/defaults/vm-%1$s.conf',$release);
//		$vm_os_type = exec("/usr/bin/grep '^vm_os_type=' {$profile_path} | /usr/bin/cut -d'\"' -f2");
//		$vm_os_profile = exec("/usr/bin/grep '^vm_profile=' {$profile_path} | /usr/bin/cut -d'\"' -f2");
//		exec("/usr/sbin/sysrc -f {$configfile} last_release_created=\"{$release}\" last_cpu_created=\"{$cpu}\" last_ram_created=\"{$ram}\" last_imgsize_created=\"{$imgsize}\"");

		if (isset($_POST['autostart'])):
			$astart="1";
		else:
			$astart="0";
		endif;


		if (isset($_POST['nowstart'])):
			$cmd .= " runasap=1";
		endif;

		if (isset($_POST['baserw'])):
			$baserw=1;
		else:
			$baserw=0;
		endif;
		if (isset($_POST['vnet'])):
			$vnet=1;
		else:
			$vnet=0;
		endif;
		if (isset($_POST['allow_mount'])):
			$allow_mount=1;
		else:
			$allow_mount=0;
		endif;
		if (isset($_POST['allow_nullfs'])):
			$allow_nullfs=1;
		else:
			$allow_nullfs=0;
		endif;
		if (isset($_POST['allow_fdescfs'])):
			$allow_fdescfs=1;
		else:
			$allow_fdescfs=0;
		endif;
		if (isset($_POST['allow_procfs'])):
			$allow_procfs=1;
		else:
			$allow_procfs=0;
		endif;
		if (isset($_POST['allow_raw_sockets'])):
			$allow_raw_sockets=1;
		else:
			$allow_raw_sockets=0;
		endif;
		if (isset($_POST['allow_tmpfs'])):
			$allow_tmpfs=1;
		else:
			$allow_tmpfs=0;
		endif;
		if (isset($_POST['allow_zfs'])):
			$allow_zfs=1;
		else:
			$allow_zfs=0;
		endif;
		if (isset($_POST['allow_mlock'])):
			$allow_mlock=1;
		else:
			$allow_mlock=0;
		endif;
		if (isset($_POST['allow_nfsd'])):
			$allow_nfsd=1;
		else:
			$allow_nfsd=0;
		endif;
		if (isset($_POST['mount_fdescfs'])):
			$mount_fdescfs=1;
		else:
			$mount_fdescfs=0;
		endif;
		if (isset($_POST['mount_procfs'])):
			$mount_procfs=1;
		else:
			$mount_procfs=0;
		endif;
		if (isset($_POST['devfs_ruleset'])):
			$devfs_ruleset=$_POST['devfs_ruleset'];;
		else:
			$devfs_ruleset=4;
		endif;

		$cmd = "/usr/bin/env NOINTER=1 /usr/local/bin/cbsd jcreate jname={$jname} vmemoryuse=${ram} cpu=${cpu} astart={$astart} ip4_addr={$ipaddr} ver=native inter=0 pkg_bootstrap=0 baserw={$baserw} vnet={$vnet} allow_mount={$allow_mount} allow_nullfs={$allow_nullfs} allow_fdescfs={$allow_fdescfs} allow_procfs={$allow_procfs} allow_raw_sockets={$allow_raw_sockets} allow_tmpfs={$allow_tmpfs} allow_zfs={$allow_zfs} allow_mlock={$allow_mlock} allow_nfsd={$allow_nfsd} mount_fdescfs={$mount_fdescfs} mount_procfs={$mount_procfs} devfs_ruleset={$devfs_ruleset}";

		if (isset($_POST['nowstart'])):
			$cmd .= " runasap=1";
		endif;

		if ($_POST['Create']):
//			if(get_all_release_list()):
				unset($output,$retval);mwexec2($cmd,$output,$retval);
				if($retval == 0):
					header('Location: cbsd_manager_gui.php');
					exit;
				else:
					echo "TEST";
					print_r($output);
					$errormsg .= gtext("Failed to create Jail.");
				endif;
//			else:
//				$errormsg .= gtext(" <<< Failed to create Jail.");
//			endif;
		endif;
	endif;
endif;

include 'fbegin.inc';
?>
<script type="text/javascript">
//<![CDATA[
$(window).on("load",function() {
	$("#iform").submit(function() { spinner(); });
	$(".spin").click(function() { spinner(); });
});
//]]>
</script>
<?php
$document = new co_DOMDocument();
$document->
	add_area_tabnav()->
		push()->
		add_tabnav_upper()->
			ins_tabnav_record('cbsd_manager_gui.php',gettext('Jails'),gettext('Reload page'),true)->
			ins_tabnav_record('cbsd_manager_info.php',gettext('Information'),gettext('Reload page'),true)->
			ins_tabnav_record('cbsd_manager_maintenance.php',gettext('Maintenance'),gettext('Reload page'),true);
$document->render();
?>
<form action="cbsd_manager_add.php" method="post" name="iform" id="iform"><table id="area_data"><tbody><tr><td id="area_data_frame">
<?php
	if(!empty($errormsg)):
		print_error_box($errormsg);
	endif;
	if(!empty($savemsg)):
		print_info_box($savemsg);
	endif;
	if(!empty($input_errors)):
		print_input_errors($input_errors);
	endif;
	if(file_exists($d_sysrebootreqd_path)):
		print_info_box(get_std_save_message(0));
	endif;
?>
	<table class="area_data_settings">
		<colgroup>
			<col class="area_data_settings_col_tag">
			<col class="area_data_settings_col_data">
		</colgroup>
		<thead>
<?php
			html_titleline2(gettext('Create new Jail'));
?>
		</thead>
		<tbody>
<?php
			if($prerequisites_ok != false ):
				exec("/usr/local/bin/cbsd freejname default_jailname=jail",$jname);
				exec("/usr/local/bin/cbsd dhcpd",$ip4_addr);
			else:
				$ip4_addr="";
				$jname="";
			endif;
			$a_action = $l_interfaces;
//			$a_action = [ 'cbsd0' => 'cbsd0' ];
			$b_action = $l_release;
//			$c_action = $l_pubkey;
			$d_action = $l_cpu;
//			$e_action = $l_vnc_bind;

//			if(file_exists("{$rootfolder}/pubkey/default")):
//				$pubkey = file_get_contents("{$rootfolder}/pubkey/default");
//				$pubkey_pieces = explode(' ', $pubkey);
//				$pubkey_comment = "(".array_pop($pubkey_pieces).")";
//			else:
//				$pubkey_comment = '';
//			endif;
			html_inputbox2('jailname',gettext('Jail name'),$jname[0],'',true,20);
			html_inputbox2('host_hostname',gettext('Jail FQDN'),$jname[0].".".$pconfig['fqdn'],'',true,40);

			$cpu_default_option = '1';
			html_combobox2('cpu',gettext("vCPU (Host Core Num: (0 - unlimited))"),array_key_exists($pconfig['cpu'] ?? '',$d_action) ? $pconfig['cpu'] : $cpu_default_options ,$d_action,'',true,false,'type_change()');
			html_inputbox2('ram',gettext('Jail RAM (1g, 4g, .., 0 - unlimited)'),$pconfig['ram'],"",true,20);
//			html_inputbox2('imgsize',gettext('Disk size (20g, 40g, .., 0 - unlimited)'),$pconfig['imgsize'],'',true,20);
			html_inputbox2('ipaddress',gettext('IP Address'),$ip4_addr[0],'',true,20);
			html_checkbox2('vnet',gettext('Enable virtual network stack for jail'),!empty($pconfig['vnet']) ? true : false,gettext('Enable virtual network stack for jail'),'',false);
			if(!(isset($pconfig['cbsd_gw4']))):
				if(file_exists("{$rootfolder}/conf/gw4")):
					$pconfig['cbsd_gw4'] = file_get_contents("{$rootfolder}/conf/gw4");
				else:
					$pconfig['cbsd_gw4'] = '10.0.0.1';
				endif;
			endif;
			html_inputbox2('gw4',gettext('GW IP Address (for VNET jail only)'),$pconfig['cbsd_gw4'],'',true,20);
			html_combobox2('interface',gettext('Network interface'),!empty($pconfig['interface']),$a_action,'',true,false);
//			html_combobox2('vnc_bind',gettext('VNC bind'),!empty($pconfig['vnc_bind']),$l_vnc_bind,'',true,false);

//			if(file_exists( $configfile )):
//				$pconfig['release'] = exec("/usr/bin/grep '^last_release_created=' {$configfile} 2>/dev/null | /usr/bin/cut -d'\"' -f2");
//			endif;

//			html_combobox2('release',gettext('Profile name'),array_key_exists($pconfig['release'] ?? '',$b_action) ? $pconfig['release'] : $default_options ,$b_action,'<a href="cbsd_manager_golds.php"><span>Warm more (Gold image libraries)</span></a>',true,false,'type_change()');
//			html_combobox2('pubkey',  gettext('Pubkey'),!empty($pconfig['pubkey']),$c_action,"{$pubkey_comment}",true,false);
			html_checkbox2('nowstart',gettext('Start after creation'),!empty($pconfig['nowstart']) ? true : false,gettext('Start the Jail after creation.'),'',false);
			html_checkbox2('autostart',gettext('Auto start on boot'),!empty($pconfig['autostart']) ? true : false,gettext('Automatically start the Jail at boot time.'),'',false);
			html_checkbox2('baserw',gettext('Jail base is not read-only (full base copy)'),!empty($pconfig['baserw']) ? true : false,gettext('Jail base is not read-only (full base copy)'),'',false);
			html_checkbox2('vnet',gettext('Enable virtual network stack for jail'),!empty($pconfig['vnet']) ? true : false,gettext('Enable virtual network stack for jail'),'',false);
			html_checkbox2('allow_mount',gettext('Allow privileged users inside the jail mount and unmount file system'),!empty($pconfig['allow_mount']) ? true : false,gettext('Allow privileged users inside the jail mount and unmount file system'),'',false);
			html_checkbox2('allow_nullfs',gettext('Allow privileged users inside the jail mount and unmount NULLFS file system'),!empty($pconfig['allow_nullfs']) ? true : false,gettext('Allow privileged users inside the jail mount and unmount NULLFS file system'),'',false);
			html_checkbox2('allow_fdescfs',gettext('Jail may mount the fdescfs file system'),!empty($pconfig['allow_fdescfs']) ? true : false,gettext('Jail may mount the fdescfs file system'),'',false);
			html_checkbox2('allow_procfs',gettext('Allow privileged users inside the jail mount and unmount PROCFS file system'),!empty($pconfig['allow_procfs']) ? true : false,gettext('Allow privileged users inside the jail mount and unmount PROCFS file system'),'',false);
			html_checkbox2('allow_raw_sockets',gettext('The jail root is allowed to create raw sockets'),!empty($pconfig['allow_raw_sockets']) ? true : false,gettext('The jail root is allowed to create raw sockets'),'',false);
			html_checkbox2('allow_tmpfs',gettext('Allow privileged users inside the jail mount and unmount TMPFS file system'),!empty($pconfig['allow_tmpfs']) ? true : false,gettext('Allow privileged users inside the jail mount and unmount TMPFS file system'),'',false);
			html_checkbox2('allow_zfs',gettext('Privileged users inside the jail will be able to mount and unmount the ZFS file system'),!empty($pconfig['allow_zfs']) ? true : false,gettext('Privileged users inside the jail will be able to mount and unmount the ZFS file system'),'',false);
			html_checkbox2('allow_mlock',gettext('Allow mlock(2) or munlock(2) within jail'),!empty($pconfig['allow_mlock']) ? true : false,gettext('Allow mlock(2) or munlock(2) within jail'),'',false);
			html_checkbox2('allow_nfsd',gettext('Allow mountd(8), nfsd(8), nfsuserd(8), gssd(8), rpc.tlsservd(8) daemons within jail'),!empty($pconfig['allow_nfsd']) ? true : false,gettext('Allow mountd(8), nfsd(8), nfsuserd(8), gssd(8), rpc.tlsservd(8) daemons within jail'),'',false);
			html_checkbox2('mount_fdescfs',gettext('Mount a FDESCFS filesystem on the chrooted /dev/fd directory'),!empty($pconfig['mount_fdescfs']) ? true : false,gettext('Mount a FDESCFS filesystem on the chrooted /dev/fd directory'),'',false);
			html_checkbox2('mount_procfs',gettext('Mount a PROCFS filesystem on the chrooted /proc'),!empty($pconfig['mount_procfs']) ? true : false,gettext('Mount a PROCFS filesystem on the chrooted /proc'),'',false);
			html_inputbox2('devfs_ruleset',gettext('DEVFS ruleset number for jail devfs'),$devfs_ruleset,'',true,4);
?>
		</tbody>
	</table>
<?php
	if($prerequisites_ok != false ):
?>
	<div id="submit">
		<input name="Create" type="submit" class="formbtn" value="<?=gtext('Create');?>"/>
		<input name="Cancel" type="submit" class="formbtn" value="<?=gtext('Cancel');?>" />
	</div>
<?php
	endif;
?>

<?php
	include 'formend.inc';
?>
</td></tr></tbody></table></form>
<script type="text/javascript">
<!--
emptyjail_change();
linuxjail_change();
//-->
</script>
<?php
include 'fend.inc';
?>
