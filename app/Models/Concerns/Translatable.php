<?php

namespace App\Models\Concerns;

trait Translatable
{
    /**
     * Get a field in the current locale with English fallback.
     * e.g. $model->getField('title') returns title_sw when locale = sw and it is filled.
     */
    public function getField(string $field): mixed
    {
        $sw = $field . '_sw';
        if (app()->getLocale() === 'sw' && !empty($this->$sw)) {
            return $this->$sw;
        }
        return $this->$field;
    }
}
