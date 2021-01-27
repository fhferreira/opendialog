<?php

namespace App\Bot\Contexts;

use OpenDialogAi\ContextEngine\Contexts\Custom\AbstractCustomContext;
use OpenDialogAi\ContextEngine\Facades\AttributeResolver;
use OpenDialogAi\Core\Attribute\AttributeInterface;
use OpenDialogAi\Core\Attribute\StringAttribute;

/**
 * Generic context
 *
 */
class GlobalContext extends AbstractCustomContext
{
    public static $name = 'global';

    /**
     * A function to load all custom attributes from any external sources into this custom context.
     *
     * All attributes should be added using @see AbstractContext::addAttribute()
     */
    public function loadAttributes(): void
    {
        \App\GlobalContext::all()->each(function (\App\GlobalContext $context) {
            $this->addAttribute($this->createAttribute($context));
        });
    }

    /**
     * @param \App\GlobalContext $context
     * @return AttributeInterface
     */
    private function createAttribute(\App\GlobalContext $context)
    {
        return AttributeResolver::getAttributeFor($context->name, $context->value);
    }
}
