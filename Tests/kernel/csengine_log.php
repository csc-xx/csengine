<?php
/* This file is part of CSEngine.

CSEngine is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

CSEngine is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with CSEngine.  If not, see <http://www.gnu.org/licenses/>. */

//This is the testfile for the class csengine_log located in kernel.php
//It will test and output basic debug information pertaining to running CSEngine properly.
require('kernel.php');
echo "<html>";
echo "<p> CSEngine Debug : Test/csengine_log.php <hr>";
echo "<br>Starting new instance of class 'csengine_log'....<br>"; //Output for plaintext.
echo "<br>Passing arguments: NOTICE, 'This is a test of the csengine_log class'<br>";
$testlogsubsystem = new csengine_log(NOTICE, "This is a test of the csengine_log class.");
if ($testlogsubsystem == FALSE) {
    echo "[FAILED]";
} else {
        echo "<hr><br>This concludes the CSEngine test module.</p></html>";
}
?>
