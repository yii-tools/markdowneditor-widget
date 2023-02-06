<?php

declare(strict_types=1);

namespace Yii\MarkDownEditor\Tests\Support;

use Yii\Support\Assert;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetLoader;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetPublisher;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Test\Support\Container\SimpleContainer;
use Yiisoft\Test\Support\EventDispatcher\SimpleEventDispatcher;
use Yiisoft\Translator\Translator;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;
use Yiisoft\Widget\WidgetFactory;

trait TestTrait
{
    protected AssetPublisher $assetPublisher;
    private Aliases $aliases;
    private AssetManager $assetManager;
    private WebView $webView;

    /**
     * @throws InvalidConfigException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->aliases = new Aliases(
            [
                '@root' => dirname(__DIR__, 2),
                '@npm' => '@root/node_modules',
                '@assetsUrl' => '/',
                '@assets' => __DIR__ . '/runtime',
            ],
        );
        $this->assetManager = new AssetManager($this->aliases, new AssetLoader($this->aliases, false, []));
        $this->assetPublisher = new AssetPublisher($this->aliases);
        $this->webView = new WebView(dirname(__DIR__) . '/runtime', new SimpleEventDispatcher());
        $this->assetManager = $this->assetManager->withPublisher($this->assetPublisher);

        $container = new SimpleContainer(
            [
                AssetManager::class => $this->assetManager,
                TranslatorInterface::class => new Translator('en'),
                WebView::class => $this->webView,
            ],
        );

        WidgetFactory::initialize($container);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        Assert::removeFilesFromDirectory($this->aliases->get('@assets'));
    }
}
