<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests\Provider;

use Yii\MarkDownEditor\Asset\Npm;

final class NpmAssetProvider
{
    /**
     * @return array array of asset bundles.
     */
    public function assetBundles(): array
    {
        return [
            [
                'Css',
                Npm\MarkDownEditorDevAsset::class,
            ],
            [
                'Js',
                Npm\MarkDownEditorMinAsset::class,
            ],
        ];
    }
}
