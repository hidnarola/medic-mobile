<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-flat">
            <div class="panel-heading" style="font-size: 16px;letter-spacing: 2px;font-family: Verdana;">Basic Details</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr class="alpha-teal">
                            <th style="width:25%">Operator Name</th>
                            <td><?php echo $dailyCheckArr['firstName'].' '.$dailyCheckArr['lastName']; ?></td>
                        </tr>
                        <tr>
                            <th>Vehicle Reg No.</th>
                            <td><?php echo $dailyCheckArr['vehicleReg']; ?></td>
                        </tr>
                        <tr class="alpha-teal">
                            <th>Vehicle Details</th>
                            <td><?php echo $dailyCheckArr['vinDetails']; ?></td>
                        </tr>
                        <tr>
                            <th>Mileage</th>
                            <td><?php echo $dailyCheckArr['mileage']; ?></td>
                        </tr>
                        <tr class="alpha-teal">
                            <th>Description</th>
                            <td><?php echo $dailyCheckArr['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?php echo $dailyCheckArr['signatureDateTime']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="panel panel-flat">
            <div class="panel-heading" style="font-size: 16px;letter-spacing: 2px;font-family: Verdana;">Fault Details</div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Fault Type</th>
                            <th>Vehicle Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($dailyCheckArr['faultType']==''){
                            ?>
                                <tr>
                                    <td colspan="4" style="text-align: center;font-size: 16px;color: #ccc;font-family: Verdana;">No Data Found</td>
                                </tr>
                            <?php
                            }else{
                                $faultArr = explode(':-:',$dailyCheckArr['faultType']);
                                $vehicleTypeArr = explode(':-:',$dailyCheckArr['vehicleType']);
                                $faultDescArr = explode(':-:',$dailyCheckArr['faultDesc']);
                                foreach($faultArr as $k => $v){
                                ?>
                                    <tr class="alpha-teal">
                                        <td><?php echo $k+1; ?></td>
                                        <td><?php echo $v; ?></td>
                                        <td><?php echo $vehicleTypeArr[$k]; ?></td>
                                        <td><?php echo ($faultDescArr[$k]!='') ? $faultDescArr[$k] : 'N/A'; ?></td>
                                    </tr>        
                                <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>