<?php
require("includes/core_security_check.php");
?>

				<div id="box_content">
                    <h1>Login to your account</h1>
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
                                    <td><p><b>Remember</b></p></td><td><input name="Remember" type="checkbox" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><input name="processLogin" type="submit" value="Login" /></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                    <div id="small_box">
                    	<p><a href="#">Lost password?</a></p>
                    </div>
                </div>