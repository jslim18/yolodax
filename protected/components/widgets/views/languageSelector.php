<?php echo CHtml::form(); ?>
    <div id="language-select">
        <?php 
        /*
        if(sizeof($languages) < 4) {
            $lastElement = end($languages);
            foreach($languages as $key=>$lang) {
                if($key != $currentLang) {
                    echo CHtml::ajaxLink($lang,'',
                        array(
                            'type'=>'post',
                            'data'=>'_lang='.$key.'&YII_CSRF_TOKEN='.Yii::app()->request->csrfToken,
                            'success' => 'function(data) {window.location.reload();}'
                        ),
                        array()
                    );
                } else echo '<b>'.$lang.'</b>';
                if($lang != $lastElement) echo ' | ';
            }
        }
        else {*/
            echo CHtml::dropDownList('_lang', $currentLang, $languages,
                array(
                    'submit' => '',
                    'csrf'=>true,
                    'style'=>"width:100px;padding:0px;border:none; background: none repeat scroll 0 0 #666666 !important; font-weight:bold; color:#FFCC33 !important;",
                    'class'=>"input1 inputnon"
                )
            ); 
        //}
        ?>
    </div>
<?php echo CHtml::endForm(); ?>