# DebugKitErrorLog

Show errors from `error.log` file in a DebugKit panel.

## Installation
Use the dependancy mananger [composer] to install

```bash
composer require kcsoft/debug-kit-error-log
```

In your `bootstrap.php` file add the panel to [DebugKit] 3:

```php
Configure::write('DebugKit.panels', ['DebugKitErrorLog.ErrorLog']);
Plugin::load('DebugKit', ['bootstrap' => true]);
```

## License
[MIT]

[composer]: https://getcomposer.org/
[DebugKit]: https://github.com/cakephp/debug_kit
[mit]: https://choosealicense.com/licenses/mit/
