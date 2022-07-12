# DebugKitErrorLog

Show errors from `error.log` file in a DebugKit panel fro CakePHP 4.

## Installation
Use the dependancy mananger [composer] to install

```bash
composer require kcsoft/debug-kit-error-log
```

In your `src/Application.php` file add the panel to [DebugKit] v4:

```php
    Configure::write('DebugKit.panels', ['DebugKitErrorLog.ErrorLog']);
    $this->addPlugin('DebugKit', ['bootstrap' => true]);
```

## License
[MIT]

[composer]: https://getcomposer.org/
[DebugKit]: https://github.com/cakephp/debug_kit
[mit]: https://choosealicense.com/licenses/mit/
