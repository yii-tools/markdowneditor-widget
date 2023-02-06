<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests\Provider;

use Yii\MarkDownEditor\Asset\Cdn\MarkDownEditorAsset;

final class CdnAssetProvider
{
    /**
     * @return array array of asset bundles.
     */
    public function assetBundles(): array
    {
        return [
            [
                'Css',
                MarkDownEditorAsset::class,
            ],
            [
                'Js',
                MarkDownEditorAsset::class,
            ],
        ];
    }
}
