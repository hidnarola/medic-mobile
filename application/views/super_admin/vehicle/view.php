<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered" data-alert="" data-all="189">
            <tbody>
                <tr>
                    <th>Company</th>
                    <td><?php echo $viewArr['companyName']; ?></td>
                </tr>
                <tr>
                    <th>Base Depot.</th>
                    <td><?php echo $viewArr['depotName'] ?></td>
                </tr>
                <tr>
                    <th>Reg No.</th>
                    <td><?php echo $viewArr['registration'] ?></td>
                </tr>
                <tr>
                    <th>Telematics ID</th>
                    <td><?php echo $viewArr['deviceGUID'] ?></td>
                </tr>
                <tr>
                    <th>Vehicle Description</th>
                    <td><?php echo $viewArr['description'] ?></td>
                </tr>
                <tr>
                    <th>VIN No.</th>
                    <td><?php echo $viewArr['vin'] ?></td>
                </tr>
                <tr>
                    <th>Fuel Type</th>
                    <td><?php echo $viewArr['fuelType'] ?></td>
                </tr>
                <tr>
                    <th>Current ODO Reading</th>
                    <td><?php echo $viewArr['odoReading'] ?></td>
                </tr>
                <tr>
                    <th>Licence Type</th>
                    <td><?php echo $viewArr['licenceType']; ?></td>
                </tr>
                <tr>
                    <th>Service Intervals</th>
                    <td><?php echo $viewArr['serviceIntervals']; ?></td>
                </tr>
                <tr>
                    <th>Inspection Intervals</th>
                    <td><?php echo $viewArr['inspectionIntervals']; ?></td>
                </tr>
                <tr>
                    <th>Last Service Date</th>
                    <td><?php echo $viewArr['lastServiceDate']; ?></td>
                </tr>
                <tr>
                    <th>Last Inspection Date</th>
                    <td><?php echo $viewArr['lastInspectionDate']; ?></td>
                </tr>
                <tr>
                    <th>Last Service ODO</th>
                    <td><?php echo $viewArr['lastServiceODO']; ?></td>
                </tr>
                <tr>
                    <th>Last Inspection ODO</th>
                    <td><?php echo $viewArr['lastInspectionODO']; ?></td>
                </tr>
                <tr>
                    <th>Next Service Due</th>
                    <td><?php echo $viewArr['nextServiceDue']; ?></td>
                </tr>
                <tr>
                    <th>Next Inspection Due</th>
                    <td><?php echo $viewArr['nextInspectionDue']; ?></td>
                </tr>
                <tr>
                    <th>Road Duty Due</th>
                    <td><?php echo $viewArr['roadDutyDue']; ?></td>
                </tr>
                <tr>
                    <th>Insurance Due</th>
                    <td><?php echo $viewArr['insuranceDue']; ?></td>
                </tr>
                <tr>
                    <th>Re-set Counter Service</th>
                    <td><?php echo ($viewArr['resetServiceCounter'] == 1) ? "Yes" : "No"; ?></td>
                </tr>
                <tr>
                    <th>Google Route</th>
                    <td><?php echo ($viewArr['is_google_route'] == 1) ? "Yes" : "No"; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>