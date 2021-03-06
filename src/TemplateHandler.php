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
 * Description of TemplateHandler
 *
 * @author DJ
 */
class TemplateHandler {
    private $baseFolder;  // default folder to look for views
    private $templateHandle; // Folder where overrides for views can be stored. File/folder hierarchy for overrides should match contents of $baseFolder
    private $canOverride; //whether or not views can be overridden in theme. Recommend setting this to false for admin views.

    public function __construct($baseFolder, $templateHandle, $canOverride = true) {
        $this->baseFolder = $baseFolder;
        $this->templateHandle = $templateHandle;
        $this->canOverride = $canOverride;
    }

    /**
     * Get path for view. if $canOverride is true it will
     * check for template overrides in theme
     *
     * {theme root}/{$this->templateHandle}/{handle}.php
     * translates to
     * {$this->baseFolder}/{handle}.php
     *
     * @param string $handle filename without .php
     * @param string $mode typically front or admin, default front
     * @return string full path to file for include
     * @throws \Exception
     */
    public function getView($handle) {
        if ($this->canOverride === true) {
            $view = locate_template("{$this->templateHandle}/{$handle}.php");
            if (file_exists($view)) {
                return $view;
            }
        }

        if (file_exists("{$this->baseFolder}/{$handle}.php")) {
            return "{$this->baseFolder}/{$handle}.php";
        } else {
            throw new \InvalidArgumentException("View '$handle' not found");
        }
    }
}
