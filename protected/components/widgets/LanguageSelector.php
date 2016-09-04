<?php
class LanguageSelector extends CWidget
{
    public function run()
    {
        $currentLang = Yii::app()->language;
        $lng = Yii::app()->params->languages;
        ksort($lng);
        $languages = $lng;
        $this->render('languageSelector', array('currentLang' => $currentLang, 'languages'=>$languages));
    }
}
?>