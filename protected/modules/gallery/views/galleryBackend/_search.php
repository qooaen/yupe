<?php
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'action'      => Yii::app()->createUrl($this->route),
        'method'      => 'get',
        'type'        => 'vertical',
        'htmlOptions' => array('class' => 'well'),
    )
); ?>
<fieldset>
    <div class="row">
        <div class="col-sm-5">
            <?php echo $form->textFieldGroup($model, 'name'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <?php echo $form->textAreaGroup($model, 'description'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-5">
            <?php echo $form->dropDownListGroup(
                $model,
                'status',
                array(
                    'widgetOptions' => array(
                        'data' => $model->getStatusList(),
                    ),
                )
            ); ?>
        </div>
    </div>
</fieldset>

<?php $this->widget(
    'bootstrap.widgets.TbButton',
    array(
        'context'     => 'primary',
        'encodeLabel' => false,
        'buttonType'  => 'submit',
        'label'       => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t(
                'GalleryModule.gallery',
                'Find gallery'
            ),
    )
); ?>

<?php $this->endWidget(); ?>
