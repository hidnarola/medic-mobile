<tr>
    <td>
        <p><h2>Hello, <?php echo $firstName; ?></h2></p>
    </td>
</tr>
<tr>
    <td style="padding: 0px 0 15px 0;">
        <p>Your account has been created and following are your login details.</p>
    </td>
</tr>
<tr>
    <td>
        <p><span style="width:20%;float:left;"><strong>Username</strong>:</span><span style="width:80%;float:left;word-break: break-all;"><?php echo $username; ?></span> </p>
        <p style="clear:both"><span style="width:20%;float:left;"><strong>Email</strong>:</span><span style="width:80%;float:left;  word-break: break-all;"><?php echo $emailAddress; ?></span> </p>
        <p style="clear:both"><span style="width:20%;float:left;"><strong>Password</strong>:</span><span style="width:80%;float:left;  word-break: break-all;"><?php echo $password; ?></span> </p>
    </td>
</tr>