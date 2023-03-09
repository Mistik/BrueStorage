<?php
require("includes/core_security_check.php");
?>

				<div id="box_content">
                    <h1>Contact us</h1>
                        <form method="POST" action="#">
                        <div id="small_box">
                            <table>
                                <tr>
                                    <td><p><b>Name</b></p></td><td><input name="Name" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                    <td><p><b>Email</b></p></td><td><input name="Email" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                    <td><p><b>Message</b></p></td><td><textarea name="Message" rows="10" cols="50"></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><input name="processContact" type="submit" value="Send" /></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>