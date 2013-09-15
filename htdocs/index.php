<?php
session_start();
// chemin pour require_once et include
// pour le dev, a placer dans la conf de PHP
if (file_exists('../core/')) {
	$libdir = getcwd()."/../core/";
	set_include_path(get_include_path().PATH_SEPARATOR.$libdir);
}
if (file_exists('../config.json')) {
	define('CLICNAT_CHEMIN_CONF', getcwd()."/../config.json");
}

require_once('clicnat_element.php');
require_once("smarty3/Smarty.class.php");

$conf = conf();
$sm = new Smarty();
$sm->addTemplateDir(sprintf("%s/%s/smarty/", $conf->theme_dir, $conf->theme));
$sm->compile_dir = "/tmp/clicnat_s_compile";
$sm->cache_dir = "/tmp/clicnat_s_cache";

if (!file_exists($sm->compile_dir)) mkdir($sm->compile_dir);
if (!file_exists($sm->cache_dir)) mkdir($sm->cache_dir);

if (!isset($_SERVER['PATH_INFO']))
	$section = array("index");
elseif ($_SERVER['PATH_INFO'] == '/')
	$section = array("index");
else 
	$section = explode("/", trim($_SERVER['PATH_INFO'],"/"));

if (!file_exists("{$conf->section_dir}/{$section[0]}")) {
	throw new Exception("404");
}

//todo: mieux vérifier que le dossier est bien présent et est une section

require_once("{$conf->section_dir}/{$section[0]}/classes/clicnat_section_{$section[0]}.php");

$sm->addTemplateDir("{$conf->section_dir}/{$section[0]}/smarty/");
$obj_section = call_user_func("clicnat_section_{$section[0]}"); 
$sm->assign("section", $obj_section);
$sm->assign("url_base", $conf->url_base);
$template = $obj_section->exec($section, $sm);
?>
