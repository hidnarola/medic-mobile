<div class="row">
    <div class="col-lg-12">
        <div>
             <div style="font-size: 15px;letter-spacing: 2px;">
                <div class="row">
                    <div class="col-md-6">
                        <label><b>Vehicle:</b> <?php echo $faultsArr[$vehicleGUID]['registration']; ?></label>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-6">
                        <label><b>Operator:</b> <?php echo $faultsArr[$vehicleGUID]['firstName'].' '.$faultsArr[$vehicleGUID]['lastName']; ?></label>
                    </div>
                </div>
            </div>
            <div>
                <?php if(!empty($faultsArr[$vehicleGUID]) && isset($faultsArr[$vehicleGUID]['faults'])){ ?>
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th>Fault Type</th>
                                <th>Description</th>
                                <th>Pictures</th>
                                <th>Signature</th>
                            </tr>
                            <?php foreach($faultsArr[$vehicleGUID]['faults'] as $k => $v){ ?>
                                <tr>
                                    <td><?= $v['faultType']; ?></td>
                                    <td><?= $v['description']; ?></td>
                                    <td>
                                        <?php
                                            $file_name = FAULT_IMG_PATH.$v['image'];
                                            if($v['image']!='' && file_exists($file_name)){?>
                                                <img src="<?php echo $file_name; ?>" style="height:50px;width:auto">
                                            <?php
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $file_name = '';
                                            $file_name = SIGNATURE_IMG_PATH.$v['signatureImage'];
                                            if($v['signatureImage']!='' && file_exists($file_name)){?>
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