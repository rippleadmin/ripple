<?php

namespace WaterAdmin;

use Illuminate\Support\Traits\Macroable;
use InvalidArgumentException;
use WaterAdmin\Concerns\HasWaterDrop;
use WaterAdmin\Concerns\HasWaterModel;

class Page extends PlainPage
{
    use Macroable,
        HasWaterModel,
        HasWaterDrop;

    /**
     * Add the page row content.
     *
     * @param  array|\WaterAdmin\Component  $content
     * @return void
     */
    public function row($content)
    {
        if (is_array($content)) {
            //
        } elseif ($content instanceof Component) {
            //
        } else {
            throw new InvalidArgumentException(
                sprintf('The argument $content must be an instance of %s or array.', Component::class)
            );
        }

        return $this;
    }

    /**
     * Add the page content.
     *
     * @param  \WaterAdmin\Component  $content
     * @return void
     */
    public function content(Component $content)
    {
        //

        return $this;
    }

    // /**
    //  * Get the page model fields.
    //  *
    //  * @return array
    //  */
    // public function getFields()
    // {
    //     if ($this->waterModel instanceof Fieldable) {
    //         return $this->waterModel->getFields();
    //     }
    // }
}
