<?php

namespace Botble\PluginUploader\PanelSections;

use Botble\Base\PanelSections\PanelSection;

class PluginUploaderPanelSection extends PanelSection
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
