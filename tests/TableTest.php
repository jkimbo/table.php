<?php
/**
 * Table tests
 *
 * @author Jonathan Kim <jonathan.kim@fusepump.com>
 */
require_once __DIR__.'/../src/Table.php';
/**
 * Table tests
 *
 * @author Jonathan Kim <jonathan.kim@fusepump.com>
 */
class TableTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test headers
     *
     * @return void
     */
    public function testHeaders()
    {
        $headers = array(
            'header1',
            'header2'
        );
        $table = new Table($headers);

        $rows = $table->getRows();

        $this->assertEquals($rows[0], $headers);
    }

    /**
     * Test add row
     *
     * @return void
     */
    public function testAddRow()
    {
        $table = new Table();

        $row = array('hello', 'world');

        $table->addRow($row);
        $rows = $table->getRows();

        $this->assertEquals($rows[0], $row);
    }

    /**
     * Test widths
     *
     * @return void
     */
    public function testWidths()
    {
        $padding = 5;
        $table = new Table(array(), $padding);

        $row1 = array('hello', 'world');
        $row2 = array('longer hello', 'longer world');

        $table->addRow($row1);
        $table->addRow($row2);
        $widths = $table->getWidths();

        $this->assertEquals($widths[0], strlen($row2[0]) + $padding);
        $this->assertEquals($widths[1], strlen($row2[1]) + $padding);
    }

    /**
     * Test get total width
     *
     * @return void
     */
    public function testTotalWidth()
    {
        $padding = 5;
        $table = new Table(array(), $padding);

        $row1 = array('hello', 'world');
        $row2 = array('longer hello', 'longer world');

        $table->addRow($row1);
        $table->addRow($row2);

        $this->assertEquals(
            $table->getTotalWidth(),
            (strlen($row2[1]) + $padding) + (strlen($row2[0]) + $padding)
        );
    }

    /**
     * Test add separator
     *
     * @return void
     */
    public function testAddSeparator()
    {
        $table = new Table();
        $table->addSeparator("+");

        $rows = $table->getRows();
        $this->assertEquals("+", $rows[0]);
    }

    /**
     * Test pad string
     *
     * @return void
     */
    public function testPadString()
    {
        $table = new Table();

        $string = $table->padString("test", 50, " ");
        $this->assertEquals(strlen($string), 50);
    }

    /**
     * Test print row
     *
     * @return void
     */
    public function testPrintRow()
    {
        $padding = 5;
        $table = new Table(array(), $padding);

        $row = array('hello', 'world');
        $table->addRow($row);

        $this->assertEquals(
            (strlen($row[0]) + $padding) + 2 + (strlen($row[1]) + $padding),
            strlen($table->printRow(0))
        );

        $this->assertEquals(
            $row[0]."     "."| ".$row[1]."     ",
            $table->printRow(0)
        );
    }

    /**
     * Test print row exception
     *
     * @return void
     */
    public function testPrintRowException()
    {
        $table = new Table();

        $this->setExpectedException(
            'Exception', 'Row 1 does not exist'
        );

        $table->printRow(1);
    }
}
