<?php foreach($dailycheckArr as $k => $v){ ?>
	<tr>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><a href="" style="text-decoration:none"><?php echo $v['firstName'].' '.$v['lastName']; ?></a></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo $v['vehicleReg']; ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo $v['vinDetails']; ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo $v['mileage']; ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo count(explode(':-:',$v['faultType'])); ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo $v['signatureDateTime']; ?></td>
	</tr>
<?php } ?>