<?php
require("includes/core_security_check.php");
global $core;
?>

				<div id="box_content">
                    <h1>User details</h1>
                        <form method="POST" action="#">
                        <div id="small_box">
                            <table>
                                <tr>
                                    <td><p><b>Username</b></p></td><td><input name="Username" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                    <td><p><b>Password</b></p></td><td><input name="Password" type="password" size="50" /></td>
                                </tr>
                                <tr>
                                    <td><p><b>Confirm Password</b></p></td><td><input name="ConfirmPassword" type="password" size="50" /></td>
                                </tr>
                                <tr>
                                    <td><p><b>Email</b></p></td><td><input name="Email" type="text" size="50" /></td>
                                </tr>
                                <tr>
                                    <td><p><b>Confirm Email</b></p></td><td><input name="ConfirmEmail" type="text" size="50" /></td>
                                </tr>
                                </div>
                                <tr>
	                    			<td><p><b><?php $core->Output($core->generateQuestion()); ?></b></p></td>
	                    			<td><input name="q_answer" type="text" size="50" /></td>
	                    		</tr>
	                    		<tr>
	                    			<td colspan="2" align="center"><input name="processRegister" type="submit" value="Register" /></td>
	                    		</tr>
                            </table>
                            </div>
                        </div>
                    </form>
                </div>