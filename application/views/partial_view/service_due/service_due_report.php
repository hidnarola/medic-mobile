<?php if(empty($vehiclesArr)){ ?>
		<tr>
			<td colspan="8" style="text-align: center;font-weight: 700;font-size: x-large;color: #ccc;padding: 20px;">No Data Found</td>
		</tr>
<?php }else{
		foreach($vehiclesArr as $k => $v){ 
		?>
			<tr>
				<td style="width:15%"><?php echo $v['registration']; ?></a></td>
				<td style="width:10%"><?php echo $v['odoReading'].' '.$v['odo_measurment']; ?></td>
				<td style="width:30%"><?php echo $v['description']; ?></td>
				<td style="width:10%"><?php echo date('d-m-Y',strtotime($v['lastInspectionDate'])); ?></td>
				<td style="width:10%"><?php echo $v['lastInspectionODO']; ?></td>
				<td style="width:10%"><?php echo date('d-m-Y',strtotime($v['nextInspectionDue'])); ?></td>
				<td style="width:5%"></td>
				<td style="width:20%">
					<?php if($txt_date > $v['nextServiceDue']){ ?>
						<label style="font-weight:700;font-size:15px">PENDING</label>
					<?php } else { ?>
						<label style="color:red;font-weight:700;font-size:15px">OVERDUE</label>
					<?php } ?>
				</td>
				<td class="text-center">
					<a href="<?php echo site_url('settings/manage_vehicles/edit/'.base64_encode($v['vehicleGUID'])); ?>" style="font-weight:bold" title="View" data-id="<?php echo base64_encode($v['vehicleGUID']); ?>" class="btn border-warning text-warning btn-flat btn-xs btn_view_service_due">View</a>
				</td>
			</tr>
		<?php 	
		}
	}
?>