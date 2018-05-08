<div class="row">
    <?php foreach($podArr[$vehicleGUID]['proofs'] as $k => $v){ ?>
        <div class="col-lg-4">
            <div class="panel panel-flat border-top-lg border-top-warning">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6 class="text-semibold no-margin">Description <small class="display-block"><?= $v['description']; ?></small></h6>
                        </div>
                        <?php 
                            $file_name = 'API/Upload/SignatureImages/'.$v['signature'];
                            if($v['signature']!='' && file_exists($file_name)){
                            ?>
                                <div class="col-lg-12">
                                    <br><img src="<?php echo $file_name; ?>" style="width: auto;height: 50px;"><br>
                                </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
                <?php if($v['is_img']>0){ ?>
                    <a href="javascript:void(0);" class="btn_view_img" data-id="<?= $k; ?>">
                        <div class="panel-heading bg-warning">
                            <h6 class="panel-title text-center">See Images</h6>
                        </div>
                    </a>
                <?php }else{ ?>
                    <a href="javascript:void(0);" style="cursor: no-drop;">
                        <div class="panel-heading bg-flat">
                            <h6 class="panel-title text-center">No Images</h6>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>