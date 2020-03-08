<?php
/*
Copyright (c) 2008, Till Brehm, projektfarm Gmbh
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


/******************************************
* Begin Form configuration
******************************************/

$tform_def_file = "form/server_config.tform.php";

/******************************************
* End Form configuration
******************************************/

require_once '../../lib/config.inc.php';
require_once '../../lib/app.inc.php';

//* Check permissions for module
$app->auth->check_module_permissions('admin');
$app->auth->check_security_permissions('admin_allow_server_config');


// Loading classes
$app->uses('tpl,tform,tform_actions');
$app->load('tform_actions');

class page_action extends tform_actions {

	function onShowEdit() {
		global $app, $conf;

		if($_SESSION["s"]["user"]["typ"] != 'admin') die('This function needs admin priveliges');

		if($app->tform->errorMessage == '') {
			$app->uses('ini_parser,getconf');

			$section = $this->active_tab;
			$server_id = $this->id;

			$this->dataRecord = $app->getconf->get_server_config($server_id, $section);
		}

		$record = $app->tform->getHTML($this->dataRecord, $this->active_tab, 'EDIT');

		$record['id'] = $this->id;
		$app->tpl->setVar($record);
	}

	function onShowEnd() {
		global $app;

		$app->tpl->setVar('server_name', $app->functions->htmlentities($app->db->queryOneRecord("SELECT server_name FROM server WHERE server_id = ? AND ((SELECT COUNT(*) FROM server) > 1)", $this->id)['server_name']));

		parent::onShowEnd();
	}

	function onUpdateSave($sql) {
		global $app, $conf;

		if($_SESSION["s"]["user"]["typ"] != 'admin') die('This function needs admin priveliges');
		$app->uses('ini_parser,getconf');

		if($conf['demo_mode'] != true) {
			$section = $app->tform->getCurrentTab();
			$server_id = $this->id;

			$server_config_array = $app->getconf->get_server_config($server_id);

			foreach($app->tform->formDef['tabs'][$section]['fields'] as $key => $field) {
				if ($field['formtype'] == 'CHECKBOX') {
					if($this->dataRecord[$key] == '') {
						// if a checkbox is not set, we set it to the unchecked value
						$this->dataRecord[$key] = $field['value'][0];
					}
				}
			}

			if($app->tform->errorMessage == '') {
				$server_config_array[$section] = $app->tform->encode($this->dataRecord, $section);
				$server_config_str = $app->ini_parser->get_ini_string($server_config_array);

				$app->db->datalogUpdate('server', array("config" => $server_config_str), 'server_id', $server_id);
			} else {
				$app->error('Security breach!');
			}
		}
	}

}

$app->tform_actions = new page_action;
$app->tform_actions->onLoad();


?>
