<?php

use yii\helpers\BaseStringHelper;

$this->title = 'Search';
?>
<div class="container-fluid">
    <h1>Search Result for <?php echo "<span class='label label-success'>" . $query . '</span>' ?></h1>
    <?php
    $result = $dataProvider->getModels();

        echo "<div class='row'>";
        echo '<ol>';
    foreach ($result as $key) {
        $primaryKey = $key['_id'];
            echo '<li><div class="panel panel-default">';

            foreach ($key['_source'] as $key => $value) {
                switch ("$key") {
                    case 'created':
                        echo "<div class='panel-heading'><b>Order Date: " . $value . '</b></div>';
                        break;
                    case 'first_name':
                        echo "<div class='panel-body'><b>Full Name:</b> " . $value;
                        break;
                    case 'last_name':
                        echo ' ' . $value .'<br>';
                        break;
                    case 'brand':
                        echo '<b>Brand:</b> ' . $value .'<br>';
                        break;
                    case 'product':
                        echo '<b>Product:</b> ' . $value .'<br>';
                        break;
                    case 'sum':
                        echo '<b>Sum:</b> ' . $value .'<br>';
                        echo "<a href=\"http://yii2.dev/index.php?r=elastic%2Fview&id={$primaryKey}\"><b>Order Item Link</b></a></div>";
                        break;
                }
            }
            echo '</div></li>';
    }
        echo '</ol></div>';
    ?>

</div>