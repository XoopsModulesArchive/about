<?php

include '../../mainfile.php';
include '../../header.php';

global $xoopsDB, $xoopsConfig, $xoopsTheme, $xoopsUser;

include 'header.php';

//	make_cblock();  // This options make that the center top blocks are shown
//	$xoopsOption['show_rblock'] =1;  // This options make that the right blocks are shown

//	open the pointer to a file asigned to the var $fd2 to open the page about.html in the about module folder.
$fd2 = fopen($xoopsConfig['root_path'] . 'modules/about/about.html', 'rb');

// we make sure that the var buffer2 is clean, is not necesary here but is a good practice
$buffer2 = '';

// I read all the file content.
while (!feof($fd2)) {
    $buffer2 .= fgets($fd2, 4096);
}

// I have readed the file and i close it as fast as i don´t need it more
fclose($fd2);

//I make here a little replacements, this his basically how the template system works, this is i replace a predefined tag for a php value, in this case for the xoops url start
//Note: I can use $xoopsConfig["xoops_url"] because i have defined before in the global row $xoopsConfig, else it could be an error.

$buffer2 = str_replace('{XOOPSSTART}', $xoopsConfig['xoops_url'], $buffer2);

//I am going to insert here the user name, i could know it only if the user is logger else i assign to it the name that i want.
if ('' == $xoopsUser) {
    $aboutuser = 'Oh sorry, I didn´t remember your name.';
} else {
    $aboutuser = 'Pleased to see you here again <b><i>' . $xoopsUser->uname() . '</i></b>.';
}

// I replace here {USER} for the $aboutuser var to make if more friendly.
$buffer2 = str_replace('{USER}', $aboutuser, $buffer2);

// I have yet all ready so i print it
echo $buffer2;

include '../../footer.php';



