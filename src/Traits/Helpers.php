<?php

namespace GoSuccess\Enhance\Traits;

use DateTime;
use ReflectionProperty;
use stdClass;

trait Helpers
{
    /**
     * Convert String to DateTime.
     * 
     * @param mixed $datetime
     * @return \DateTime|null
     */
    public function string_to_datetime( ?string $datetime ): ?DateTime
    {
        return ( $datetime === null || empty( trim( $datetime ) ) ) ? null : new DateTime( $datetime );
    }

    /**
     * Possible boolean values.
     * 
     * @param mixed $string
     * @return bool|null
     */
    public function string_to_bool( ?string $string ): ?bool
    {
        return $string === null ? null : match ( trim( $string ) )
        {
            '1', 'true' => true,
            '0', 'false' => false,
            default => null,
        };
    }

    /**
     * Convert String to Integer.
     * 
     * @param mixed $string
     * @return int|null
     */
    public function string_to_int( ?string $string ): ?int
    {
        return is_numeric( $string ) ? (int) $string : null;
    }

    /**
     * Convert String to Float.
     * 
     * @param mixed $string
     * @return float|null
     */
    public function string_to_float( ?string $string ): ?float
    {
        return is_numeric( $string ) ? (float) $string : null;
    }

    /**
     * Get the property type of a class by the property name.
     * 
     * @param object|string $class
     * @param string $name
     * @return string
     */
    public function get_property_type( object|string $class, string $name ): string
    {
        $rp = new ReflectionProperty( $class, $name );
        $property_type =  $rp->getType()->getName();

        return $property_type;
    }

    /**
     * Get all property attributes for a specific property.
     * 
     * @param object|string $class
     * @param string $property_name
     * @return array
     */
    public function get_property_attributes( object|string $class, string $property_name ): array
    {
        $rc = new ReflectionProperty( $class, $property_name );
        $attributes = $rc->getAttributes();

        $attr = [];
        foreach( $attributes as $attribute )
        {
            $attr[$attribute->getName()] = $attribute->getArguments();
        }

        return $attr;
    }

    /**
     * Get an array with typed elements.
     * 
     * @param array $property_array
     * @param object|string $item_object
     * @param string $item_type class, enum
     * @return array
     */
    public function property_array_map( array $property_array, object|string $item_object, string $item_type = 'class' ): array
    {
        return array_map(
            function( stdClass $item ) use ( $item_object, $item_type )
            {
                return match( $item_type )
                {
                    'class' => new $item_object( $item ),
                    'enum' => $item_object::tryFrom( $item ),
                    default => null
                };
            },
            $property_array
        );
    }
}
