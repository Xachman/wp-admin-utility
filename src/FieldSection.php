<?php

/*
 * The MIT License
 *
 * Copyright 2016 DJ Walker <donwalker1987@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace dwalkr\WPAdminUtility;

/**
 * Description of MetaBox
 *
 * @author DJ
 */
class FieldSection {

    private $configData;
    public $fields = array();
    private $templateHandler;

    public function __construct($data, $templateHandler, $optionData) {
        $this->configData = $data;
        $this->templateHandler = $templateHandler;

        foreach ($this->configData->fields as $fieldData) {
            $data = null;
            if (array_key_exists($fieldData->name, $optionData)) {
                $data = $optionData[$fieldData->name];
            } else if (property_exists($fieldData, 'default')) {
                $data = $fieldData->default;
            }
            $this->fields[] = Field::create($fieldData, $this->templateHandler, $data);
        }
    }

    public function getTitle() {
        return $this->configData->title;
    }


    public function display() {
        require $this->templateHandler->getView('fieldsection/start');
        foreach ($this->fields as $field) {
            $field->render();
        }
        require $this->templateHandler->getView('fieldsection/end');
    }
}
