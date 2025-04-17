<?php

namespace Botble\Documentation\PanelSections;

use Botble\Base\PanelSections\PanelSection;

class DocumentationPanelSection extends PanelSection
{
    public function setup(): void
    {
        $this
            ->setId('settings.{id}')
            ->setTitle('{title}')
            ->withItems([
                //
            ]);
    }
}
