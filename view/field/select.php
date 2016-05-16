<select name="<?=esc_attr($this->configData->name);?>"
       class="form-control <?=property_exists($this->configData,'class') ? esc_attr($this->configData->class) : '';?>">
    <?php foreach ($this->getOptions() as $option) :
        if (is_object($option)) {
            $val = $option->value;
            $label = $option->label;
        } else {
            $val = $option;
            $label = $option;
        }
    ?>
        <option value="<?=esc_attr($val);?>"<?php if ($val == $this->getFieldValue()) echo ' selected="selected"';?>><?=esc_html($label);?></option>
    <?php endforeach; ?>
</select>