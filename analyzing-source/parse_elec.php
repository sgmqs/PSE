<?php

// Load the ELEC.txt to read out the structure
$handle = fopen("../json_files/ELEC.txt","r");
$types = array();
$fields = array();
$curr_line = 0;

echo "current line: ".$curr_line++.PHP_EOL;
while(($buffer = fgets($handle)) !== FALSE) {

	preg_match('!^{"series_id":"ELEC\.(GEN|SALE)!',$buffer,$match);
  
	if(isset($match[1])) {
		echo $buffer;
		continue;
		$type = $match[1];
		if($type == 'series_id') {
			echo $buffer;
		}
		continue;
		
		$object = (array) json_decode($buffer);
		echo $object['name'].PHP_EOL;
		continue;
		
		if(isset($types[$type])) {	   
			$types[$type]++;
		} else {
		  $types[$type] = 1;
		  $object = (array) json_decode($buffer);
		  
		  $fields[$type] = var_export($object,TRUE);
		  echo "FIELDS FOR $type ===================================".PHP_EOL;
		  foreach(array_keys($object) as $key) {
		  echo "      <field>
        <name>$key</name>
        <path>$key</path>
        <type>String</type>
        <format/>
        <currency/>
        <decimal/>
        <group/>
        <length>-1</length>
        <precision>-1</precision>
        <trim_type>none</trim_type>
        <repeat>N</repeat>
      </field>".PHP_EOL;
		  }
		}	
	}
	else {
		//echo "Wat?!".PHP_EOL;
		//print_r($buffer);
	}
}

fclose($handle);

//print_r($types);
//echo "=====================".PHP_EOL;
//echo "FIELDS: ".PHP_EOL;
//print_r($fields);