<?php

namespace DeGraciaMathieu\LaravelManagerGenerator\PaintRoller;

use DeGraciaMathieu\LaravelManagerGenerator\Stub\Stub;

class PaintRollerService 
{
    public function brush(Stub $stub, array $layers)
    {
        foreach ($layers as $layer) {
            $freshPaint = $this->brushstroke($layer, $stub);
            $stub->setContent($freshPaint);
        }

        return $stub;
    }

    protected function brushstroke(Layer $layer, Stub $stub) :string
    {
        return str_replace($layer->getIdentifier(), $layer->getValue(), $stub->getContent());
    }
}
