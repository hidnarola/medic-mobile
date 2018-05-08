<div class="row">
    <div class="col-lg-12">
        <div>
            <div style="font-size: 15px;letter-spacing: 2px;">
                <div class="row">
                    <div class="col-md-6">
                        <label><b>Vehicle:</b> <?php echo $incidentsArr[$vehicleGUID]['registration']; ?></label>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <label><b>Operator:</b> <?php echo $incidentsArr[$vehicleGUID]['firstName'].' '.$incidentsArr[$vehicleGUID]['lastName']; ?></label>
                    </div>
                </div>
            </div>
            <div>
                <?php if(!empty($incidentsArr[$vehicleGUID]) && isset($incidentsArr[$vehicleGUID]['incidents'])){ ?>
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th>Sr No.</th>
                                <th>RTC</th>
                                <th>Building</th>
                                <th>NonVehicular</th>
                                <th>Casualties</th>
                                <th>VehicleDamage</th>
                                <th>NonVehicleDamage</th>
                                <th>Description</th>
                                <th>Images</th>
                            </tr>
                            <?php foreach($incidentsArr[$vehicleGUID]['incidents'] as $k => $v){ ?>
                                <tr>
                                    <td><?php echo $k+1; ?></td>
                                    <td><?php if($v['rtc']==1){ echo 'Yes'; }else{ echo 'No'; }; ?></td>
                                    <td><?php if($v['building']==1){ echo 'Yes'; }else{ echo 'No'; }; ?></td>
                                    <td><?php if($v['nonVehicular']==1){ echo 'Yes'; }else{ echo 'No'; }; ?></td>
                                    <td><?php if($v['casualties']==1){ echo 'Yes'; }else{ echo 'No'; }; ?></td>
                                    <td><?php if($v['vehicleDamage']==1){ echo 'Yes'; }else{ echo 'No'; }; ?></td>
                                    <td><?php if($v['nonVehicleDamage']==1){ echo 'Yes'; }else{ echo 'No'; }; ?></td>
                                    <td><?php echo $v['description']; ?></td>
                                    <td>
                                        <?php
                                            $file_name = '';
                                            $file_name = 'API/Upload/IncidentImages/'.$v['image'];
                                            if($v['image']!='' && file_exists($file_name)){?>
                                                <img src="<?php echo $file_name; ?>" style="height:70px;width:auto">
                                            <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php }else{ ?>
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td colspan="8" style="text-align: center;font-weight: 700;font-size: x-large;color: #ccc;padding: 20px;">No Data Found</td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>