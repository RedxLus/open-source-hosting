<?php

/*
Copyright (c) 2007-2012, Till Brehm, projektfarm Gmbh
All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice,
      this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice,
      this list of conditions and the following disclaimer in the documentation
      and/or other materials provided with the distribution.
    * Neither the name of ISPConfig nor the names of its contributors
      may be used to endorse or promote products derived from this software without
      specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

define('SCRIPT_PATH', dirname($_SERVER["SCRIPT_FILENAME"]));
require SCRIPT_PATH."/lib/config.inc.php";

// Check whether another instance of this script is already running
if (is_file($conf['temppath'] . $conf['fs_div'] . '.ispconfig_cron_lock')) {
	clearstatcache();
	$pid = trim(file_get_contents($conf['temppath'] . $conf['fs_div'] . '.ispconfig_cron_lock'));
	if(preg_match('/^[0-9]+$/', $pid)) {
		if(file_exists('/proc/' . $pid)) {
			if($conf['log_priority'] <= LOGLEVEL_WARN) print @date('d.m.Y-H:i').' - WARNING - There is already an instance of server.php running with pid ' . $pid . '.' . "\n";
			exit;
		}
	}
	if($conf['log_priority'] <= LOGLEVEL_WARN) print @date('d.m.Y-H:i').' - WARNING - There is already a lockfile set, but no process running with this pid (' . $pid . '). Continuing.' . "\n";
}

// Set Lockfile
@file_put_contents($conf['temppath'] . $conf['fs_div'] . '.ispconfig_cron_lock', getmypid());

if($conf['log_priority'] <= LOGLEVEL_DEBUG) print 'Set Lock: ' . $conf['temppath'] . $conf['fs_div'] . '.ispconfig_cron_lock' . "\n";


require SCRIPT_PATH."/lib/app.inc.php";

set_time_limit(0);
ini_set('error_reporting', E_ALL & ~E_NOTICE);

// make sure server_id is always an int
$conf['server_id'] = intval($conf['server_id']);


// Load required base-classes
$app->uses('ini_parser,file,services,getconf,system,cron,functions');
$app->load('libdatetime,cronjob');


// read all cron jobs
$path = SCRIPT_PATH . '/lib/classes/cron.d';
if(!is_dir($path)) die('Cron path missing!');
$files = array();
$d = opendir($path);
while($f = readdir($d)) {
	$file_path = $path . '/' . $f;
	if($f === '.' || $f === '..' || !is_file($file_path)) continue;
	if(substr($f, strrpos($f, '.')) !== '.php') continue;
	$files[] = $f;
}
closedir($d);

// sort in alphabetical order, so we can use prefixes like 000-xxx
sort($files);

foreach($files as $f) {
	$name = substr($f, 0, strpos($f, '.'));
	if(preg_match('/^\d+\-(.*)$/', $name, $match)) $name = $match[1]; // strip numerical prefix from file name

	include $path . '/' . $f;
	$class_name = 'cronjob_' . $name;

	if(class_exists($class_name, false)) {
		$cronjob = new $class_name();
		if(get_parent_class($cronjob) !== 'cronjob') {
			if($conf['log_priority'] <= LOGLEVEL_WARN) print 'Invalid class ' . $class_name . ' not extending class cronjob (' . get_parent_class($cronjob) . ')!' . "\n";
			unset($cronjob);
			continue;
		}
		if($conf['log_priority'] <= LOGLEVEL_DEBUG) print 'Included ' . $class_name . ' from ' . $path . '/' . $f . ' -> will now run job.' . "\n";

		$cronjob->run();

		if($conf['log_priority'] <= LOGLEVEL_DEBUG) print 'run job (' . $class_name . ') done.' . "\n";

		unset($cronjob);
	}
}
unset($files);

// Remove lock
@unlink($conf['temppath'] . $conf['fs_div'] . '.ispconfig_cron_lock');
$app->log('Remove Lock: ' . $conf['temppath'] . $conf['fs_div'] . '.ispconfig_cron_lock', LOGLEVEL_DEBUG);

if($conf['log_priority'] <= LOGLEVEL_DEBUG) die("finished.\n");

?>
