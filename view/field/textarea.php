<textarea name="<?=esc_attr($this->configData->name);?>"
          class="form-control <?=property_exists($this->configData,'class') ? esc_attr($this->configData->class) : '';?>">
    <?=esc_html($this->getFieldValue());?>
</textarea>