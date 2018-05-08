<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered" data-alert="" data-all="189">
            <tbody>
                <?php //p($viewArr,1); ?>
                <tr class="alpha-teal">
                    <th>DepotGUID</th>
                    <td><?php echo $viewArr['depotGUID']; ?></td>
                </tr>
                <tr>
                    <th>Depot Name</th>
                    <td><?php echo $viewArr['depotName'] ?></td>
                </tr>
                <tr class="alpha-teal">
                    <th>Address Line 1</th>
                    <td><?php echo $viewArr['addressLine1'] ?></td>
                </tr>
                <tr>
                    <th>Address Line 2</th>
                    <td><?php echo $viewArr['addressLine2'] ?></td>
                </tr>
                <tr class="alpha-teal">
                    <th>Address Line 3</th>
                    <td><?php echo $viewArr['addressLine3'] ?></td>
                </tr>
                <tr>
                    <th>Postal Code</th>
                    <td><?php echo $viewArr['postcode_zipcode']; ?></td>
                </tr>
                <tr class="alpha-teal">
                    <th>Office Phone No.</th>
                    <td><?php echo $viewArr['officePhone']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>