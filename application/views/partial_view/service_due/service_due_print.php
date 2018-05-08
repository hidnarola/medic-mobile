<?php foreach($vehiclesArr as $k => $v){ ?>
	<tr>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo $v['registration']; ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo $v['odoReading'].' '.$v['odo_measurment']; ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo $v['description']; ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo date('d-m-Y',strtotime($v['lastInspectionDate'])); ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo $v['lastInspectionODO']; ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;"><?php echo date('d-m-Y',strtotime($v['nextInspectionDue'])); ?></td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">N/A</td>
		<td style="font-size:12px;border:1px solid #000000ad;padding:2px;border-width:1px 1px 1px 1px;">
			<?php if($txt_date > $v['nextServiceDue']){ ?>
				<label style="font-weight:700;font-size:15px">PENDING</label>
			<?php } else { ?>
				<label style="color:red;font-weight:700;font-size:15px">OVERDUE</label>
			<?php } ?>
		</td>
	</tr>
<?php } ?>