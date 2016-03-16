<?php
namespace Xqddd\Presentable;

/**
 * A trait implementing the "toOutput" and "toJson" methods with a basic usage
 *
 * @author Andrei Pirjoleanu <andreipirjoleanu@gmail.com>
 * @package Xqddd\Presentable
 */
trait PresentableTrait
{

    /**
     * Get the string representation of the object
     *
     * @return string
     */
    public abstract function toString();

    /**
     * Get the array representation of the object
     *
     * @param bool $assoc Whether the array returned should be associative or not
     * @return array
     */
    public abstract function toArray($assoc = true);

    /**
     * Get the public representation of the object
     *
     * @param string $structure
     * @param bool $assoc
     * @return array|string
     */
    public function toOutput($structure, $assoc = true)
    {
        switch ($structure) {
            case 'string':
                $output = $this->toString();
                break;
            case 'array':
            default:
                $output = $this->toArray($assoc);
                break;
        }
        return $output;
    }

    /**
     * Get the JSON representation of the object
     *
     * @param int $options
     * @param string $structure
     * @param bool $assoc
     * @return string
     */
    public function toJson($options = 0, $structure, $assoc = true)
    {
        return json_encode(
            $this->toOutput($structure, $assoc),
            $options
        );
    }

    public function __toString()
    {
        return $this->toString();
    }

}
