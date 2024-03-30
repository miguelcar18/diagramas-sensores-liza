<div class="x_content">
    <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab_content1" id="sensora-tab" role="tab" data-toggle="tab" aria-expanded="true">Sensor A</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="sensorb-tab" data-toggle="tab" aria-expanded="false">Sensor B</a>
            </li>
            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="sensorc-tab2" data-toggle="tab" aria-expanded="false">Sensor C</a>
            </li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="sensora-tab">
                <?php include("contentA.php") ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="sensorb-tab">
                <?php include("contentB.php") ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="sensorc-tab">
                <?php include("contentC.php") ?>
            </div>
        </div>
    </div>
</div>