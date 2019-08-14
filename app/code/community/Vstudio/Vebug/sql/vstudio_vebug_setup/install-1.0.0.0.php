<?php
$setupHints = Mage::getModel('core/config');

$setupHints->saveConfig('dev/debug/template_hints', "0", 'default', 0);
$setupHints->saveConfig('dev/debug/template_hints_blocks', "0", 'default', 0);
