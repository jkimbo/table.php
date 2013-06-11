# Table CLI

A simple class to output a nice text table to the cli.

[![Build Status](https://travis-ci.org/jkimbo/table.php.png?branch=master)](https://travis-ci.org/jkimbo/table.php)

## Example

```php
$table = new Table(array('Product', 'Price')); // new table with 2 headers

$table->addRow(array('Bread', 3.40)); // add a new row
$table->addRow(array('Butter', 4.99)); // add a new row

$table->addSeperator(); // add a separator

$table->addRow(array('Total', 8.39));

echo $table->toString(); 
// ->
// Product     | Price     
// ----------------------
// Bread       | 3.40      
// Butter      | 4.99      
// ----------------------
// Total       | 8.39      

```

## Tests 

To run tests:
    
    phpunit

## License

MIT
