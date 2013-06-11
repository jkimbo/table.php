<?php
/**
 * Example script
 *
 * @author Jonathan Kim <jkimbo@gmail.com>
 */
require __DIR__.'/../src/Table.php';

$table = new Table(array('Product', 'Price')); // new table with 2 headers

$table->addRow(array('Bread', '3.40')); // add a new row
$table->addRow(array('Butter', '4.99')); // add a new row

$table->addSeparator(); // add a separator

$table->addRow(array('Total', '8.39'));

echo $table->toString();
