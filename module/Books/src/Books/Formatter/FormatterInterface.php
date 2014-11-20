<?php

namespace Books\Formatter;

/**
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
interface FormatterInterface {

    public function formatRequestParameters();
    
    public function formatResponseParameters();
    
}
