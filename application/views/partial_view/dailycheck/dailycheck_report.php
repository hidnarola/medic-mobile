<?php if(empty($dailycheckArr)){ ?>
		<tr>
			<td colspan="8" style="text-align: center;font-weight: 700;font-size: x-large;color: #ccc;padding: 20px;">No Data Found</td>
		</tr>
<?php }else{
		foreach($dailycheckArr as $k => $v){ 
		?>
			<tr>
				<td style="width:15%"><a href="javascript:void(0)"><?php echo $v['firstName'].' '.$v['lastName']; ?></a></td>
				<td style="width:15%"><?php echo $v['vehicleReg']; ?></td>
				<td style="width:15%"><?php echo $v['vinDetails']; ?></td>
				<td style="width:15%"><?php echo $v['mileage']; ?></td>
				<td style="width:10%"><?php echo ($v['faultType']=='') ? '0' : count(explode(':-:',$v['faultType'])); ?></td>
				<td style="width:20%"><?php echo $v['signatureDateTime']; ?></td>
				<td class="text-center">
					<a href="javascript:void(0);" style="font-weight:bold" title="View" data-id="<?php echo base64_encode($v['dailyCheckID']); ?>" class="btn border-warning text-warning btn-flat btn-xs btn_view_dailycheck">View</a>
				</td>
			</tr>
		<?php 	
		}
	} 
?>