<?php
declare(strict_types=0);

use PHPUnit\Framework\TestCase;
use WPPackageParser\Parser;

final class ParseTest extends TestCase
{
	protected function getReadmeExampleData()
	{
		return [
			'name' => 'Test Plugin',
			'contributors' => ['capevace'],
			'donate' => '',
			'tags' => ['one', 'two'],
			'requires' => '3.8',
			'tested' => '4.9',
			'stable' => '2.0.0',
			'short_description' => 'Plugin short description.',
			'sections' => [
    			'Description' => 'Description here.',
    			'Installation' => 'Installation here.',
    			'Frequently Asked Questions' => "= Question =\n\nAnswer\n\n= Question 2 =\n\nAnswer 2",
    			'Screenshots' => "1. WooCommerce Germanized Settings",
    			'Changelog' => "= 2.0.0 =\n* Improvement\n\n= 1.0.0 =\n* Initial Version",
    			'Upgrade Notice' => "= 2.0.0 =\nUpgrade Notice"
    		]
		];
	}

    public function testDoesParsePlugin()
    {
    	$filepath = __DIR__ . '/resources/test-plugin.zip';

    	$result = Parser::parse($filepath);
    	$this->assertEquals($result, [
    		'header' => [
    			'Name' => 'Test Plugin',
    			'PluginURI'=> 'https://testplugin.com',
			    'Version'=> '1.5.1',
			    'Description' => 'A parser test plugin.',
			    'Author' => 'Capevace',
			    'AuthorURI' => 'https://github.com/Capevace',
			    'TextDomain' => 'test-plugin-domain',
			    'DomainPath' => '',
			    'Network' => false,
			    'Title' => 'Test Plugin'
			],
    		'readme' => $this->getReadmeExampleData(),
    		'pluginFile' => 'test-plugin/test-plugin.php',
    		'stylesheet' => null,
    		'type' => 'plugin'
    	]);
    }

    public function testDoesParseTheme()
    {
    	$filepath = __DIR__ . '/resources/test-theme.zip';

    	$result = Parser::parse($filepath);
    	
    	$this->assertEquals($result, [
    		'header' => [
    			'Name' => 'Test Theme',
    			'ThemeURI'=> 'https://testtheme.com',
			    'Version'=> '1.5.1',
			    'Description' => 'A parser test theme.',
			    'Author' => 'Capevace',
			    'AuthorURI' => 'https://github.com/Capevace',
			    'TextDomain' => 'test-theme-domain',
			    'DomainPath' => '',
			    'Template' => '',
			    'Status' => '',
			    'DetailsURI' => '',
			    'Tags' => ['one', 'two']
			],
    		'readme' => $this->getReadmeExampleData(),
    		'pluginFile' => null,
    		'stylesheet' => 'test-theme/style.css',
    		'type' => 'theme'
    	]);
    }
}

