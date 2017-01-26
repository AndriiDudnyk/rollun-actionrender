#ResponseRendererAbstractFactory

**LazyLoad** фабрика которая относительно ожидаемого типа ответа(Accept in request Header), 
 достанет по имени сервиса **Middleware** из **SM** и передаст ему управление.
 
 Настраивается с помощью конфига 
 Пример:
```php
 ResponseRendererAbstractFactory::KEY_RESPONSE_RENDERER => [
    'simpleHtmlJsonRenderer' => [
        ResponseRendererAbstractFactory::KEY_ACCEPT_TYPE_PATTERN => [
            //pattern => middleware
            '/application\/json/' => \rollun\utils\ActionRender\Renderer\Json\JsonRendererAction::class,
            '/text\/html/' => 'htmlReturner'
        ]
    ] 
 ],
```

Ключ массива `ResponseRendererAbstractFactory::KEY_RESPONSE_RENDERER` указыват на имя сервиса по которому 
сможем получить **lazyLoad** звгрузку терубемых конфигураций.

А в самой конфигурации в массиве `ResponseRendererAbstractFactory::KEY_ACCEPT_TYPE_PATTERN` мы ключем указываем паттерн определения **accept**, 
а занчением имя сервиса по которому из **SM** сможем получить **Middleware**.
> В данном случае конфигурация называется `'simpleHtmlJsonRenderer'`

## Renderer

Предоставляется набор стандартных Renderer для созания отображение.

### Json

Для отображение Json существует JsonRendererAction он берет данные из атрибута `responceData` и отдает их в виде json.

### Html

Для отображения в html используются два middleware 

HtmlParamResolver - получает из response имя роута и кладет его в атрибут запроса `templateName` c префиксом `'app::'` .

HtmlRendererAction - используя шаблонизатор, рендерит результат используя в качестве имени шаблона атрибут `templateName`,
а `responceData` - данных.