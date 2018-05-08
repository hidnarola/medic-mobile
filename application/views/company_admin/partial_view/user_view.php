<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered" data-alert="" data-all="189">
            <tbody>
                <?php //p($viewArr,1); ?>
                <tr class="alpha-teal">
                    <th>Full Name</th>
                    <td colspan="3"><?php echo $viewArr['firstName'].' '.$viewArr['lastName']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td colspan="3"><?php echo $viewArr['email']; ?></td>
                </tr>
                <tr class="alpha-teal">
                    <th>Office Number</th>
                    <td><?php echo $viewArr['officeNumber']; ?></td>
                    <th>Mobile Number</th>
                    <td><?php echo $viewArr['mobileNumber']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>