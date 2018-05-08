<?php if(empty($vehiclesArr)){ ?>
		<tr>
			<td colspan="8" style="text-align: center;font-weight: 700;font-size: x-large;color: #ccc;padding: 20px;">No Data Found</td>
		</tr>
<?php }else{
		foreach($vehiclesArr as $k => $v){ 
		?>
			<tr>
				<td style="width:15%"><?php echo $v['registration']; ?></a></td>
				<td style="width:20%"><?php echo $v['firstName'].' '.$v['lastName']; ?></td>
				<td style="width:55%"><?php echo $v['description']; ?></td>
				<td style="width:10%"><?php echo $v['total_incidents']; ?></td>
				<td class="text-center">
					<a href="javascript:void(0)" style="font-weight:bold" title="View" data-id="<?php echo base64_encode($v['vehicleGUID']); ?>" class="btn border-warning text-warning btn-flat btn-xs <?php if($v['total_incidents']>0){ echo 'btn_view_incidents'; } ?>">View</a>
				</td>
			</tr>
		<?php 	
		}
	}
?>