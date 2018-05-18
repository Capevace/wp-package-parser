WordPress Package Parser
========================

Attention
---------

This library is YahnisElsts's [wp-extension-meta](https://github.com/YahnisElsts/wp-extension-meta) simply put into a composer package to be used in mordern PHP development.
All I've added are some tests and modified some parts, so they'll work as a composer package.

All other credits to [YahnisElsts](https://github.com/YahnisElsts)!


Description
-----------

A PHP library for parsing WordPress plugin and theme metadata. Point it at a ZIP package and it will:

- Tell you whether it contains a plugin or a theme.
- Give you the metadata from the comment header (Version, Description, Author URI, etc).
- Parse readme.txt into a list of headers and sections.
- Convert readme.txt contents from Markdown to HTML (optional).

Usage
=====

To install simply
```
composer require capevace/wp-package-parser
```

Now you're able to use the parser!
```php
use WPPackageParser\Parser;

$filepath = __DIR__ . '/resources/test-plugin.zip';
$result = Parser::parse($filepath);
```

Sample Output
-------------
```
Array
(
    [header] => Array
        (
            [Name] => Plugin Name
            [PluginURI] => http://example.com/
            [Version] => 1.7
            [Description] => This plugin does stuff.
            [Author] => Yahnis Elsts
            [AuthorURI] => http://w-shadow.com/
            [TextDomain] => sample-plugin
            [DomainPath] => 
            [Network] => 
            [Title] => Plugin Name
        )

    [readme] => Array
        (
            [name] => Plugin Name
            [contributors] => Array
                (
                    [0] => whiteshadow
                )

            [tags] => Array
                (
                    [0] => sample
                    [1] => tag
                    [2] => stuff
                )

            [requires] => 3.2
            [tested] => 3.5.1
            [stable] => 1.7
            [short_description] => This is the short description from the readme. 
            [sections] => Array
                (
                    [Description] => This is the <em>Description</em> section of the readme.
                    [Installation] => ...
                    [Changelog] => ...
                )
        )
    [pluginFile] => sample-plugin/sample-plugin.php
    [stylesheet] => 
    [type] => plugin
)
```

Credits
-------
Base code from [YahnisElsts](https://github.com/YahnisElsts).
Partially based on plugin header parsing code from the WordPress core.
