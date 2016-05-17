<div class="ptconfig-form-field field <?=$this->getConfigData('class');?>">
    <?php if (property_exists($this->configData, 'label')) : ?>
    <label><?=esc_html($this->configData->label);?></label>
    <?php endif;?>
    <?php if (property_exists($this->configData, 'description')) : ?>
    <div class="field-description ui blue compact message"><?=esc_html($this->configData->description);?></div>
    <?php endif; ?>

