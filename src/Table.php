<?php
/**
 * Represents a table
 *
 * @author Jonathan Kim <jkimbo@gmail.com>
 */
/**
 * Represents a table
 *
 * @author Jonathan Kim <jkimbo@gmail.com>
 */
class Table
{
    protected $rows = array();
    protected $widths = array();
    protected $headers = array();

    /**
     * Constructor
     *
     * @param array   $headers   - array of headers
     * @param integer $padding   - padding around rows [default: 5]
     * @param string  $separator - column separator [default: "|"]
     */
    public function __construct($headers = array(), $padding = 5, $separator = "|")
    {
        $this->headers = $headers;
        $this->padding = $padding; // set cell padding
        $this->seperator = $separator; // set cell padding
        if (!empty($headers)) {
            $this->addRow($headers);
        }
    }

    /**
     * Add row
     *
     * @param array $row - new row
     *
     * @return $this
     */
    public function addRow($row)
    {
        $this->rows[] = $row;
        $count = 0;
        foreach ($row as $column) {
            $size = strlen($column) + $this->padding;

            if (!array_key_exists($count, $this->widths)) {
                $this->widths[$count] = 0;
            }

            if ($size > $this->widths[$count]) {
                $this->widths[$count] = $size;
            }
            $count++;
        }

        return $this;
    }

    /**
     * Get rows
     *
     * @return array rows
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Get widths
     *
     * @return array widths
     */
    public function getWidths()
    {
        return $this->widths;
    }

    /**
     * Add separator
     *
     * @param string $filler - string to separate with
     *
     * @return $this
     */
    public function addSeparator($filler = "-")
    {
        $this->rows[] = $filler;

        return $this;
    }

    /**
     * Print row
     *
     * @param integer $id - row id
     *
     * @return string
     */
    public function printRow($id)
    {
        if (!array_key_exists($id, $this->rows)) {
            throw new Exception('Row '.$id.' does not exist');
        }

        $row = $this->rows[$id];

        if (!is_array($row)) {
            // separator

            // Get total width
            return $this->padString("", $this->getTotalWidth(), $row);
        }

        $output = "";

        $count = 0;
        foreach ($row as $column) {
            $width = $this->widths[$count];

            $output .= $this->padString($column, $width);

            $count++;
            if ($count != count($row)) {
                $output .= $this->seperator." ";
            }
        }

        return $output;
    }

    /**
     * Pad string
     *
     * @param string  $string - string to pad
     * @param integer $width  - width to pad to
     * @param string  $filler - filler to pad with
     *
     * @return string
     */
    public function padString($string, $width, $filler = " ")
    {
        $length = strlen($string);
        if ($length < $width) {
            $diff = $width - $length;

            for ($i = 0; $i < $diff; $i++) {
                $string = $string . $filler;
            }
        }

        return $string;
    }

    /**
     * Get total width
     *
     * @return integer total width of the table
     */
    public function getTotalWidth()
    {
        $totalWidth = 0;
        foreach ($this->widths as $width) {
            $totalWidth += $width;
        }

        return $totalWidth;
    }

    /**
     * To string
     *
     * @return string table representation
     */
    public function toString()
    {
        $output = "";
        foreach ($this->rows as $key => $row) {
            $output .= $this->printRow($key).PHP_EOL;
            if (!empty($this->headers) && $key == 0) {
                $output .= $this->padString("", $this->getTotalWidth(), "-").PHP_EOL;
            }
        }

        return $output;
    }
}
