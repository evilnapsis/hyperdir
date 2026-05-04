<?php
$p = PostData::getById($_GET["id"]);
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 overflow-hidden">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="display-4 fw-bold mb-4"><?php echo $p->title; ?></h1>
                    <div class="content" style="line-height: 1.8; color: #334155; font-size: 1.1rem;">
                        <?php echo nl2br($p->content); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
