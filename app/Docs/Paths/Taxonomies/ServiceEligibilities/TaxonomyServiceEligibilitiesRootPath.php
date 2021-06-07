<?php

namespace App\Docs\Paths\Taxonomies\ServiceEligibilities;

use App\Docs\Operations\Taxonomies\ServiceEligibilities\IndexTaxonomyServiceEligibilityOperation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;

class TaxonomyServiceEligibilitiesRootPath extends PathItem
{
    /**
     * @param string|null $objectId
     * @throws \GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException
     * @return static
     */
    public static function create(string $objectId = null): BaseObject
    {
        return parent::create($objectId)
            ->route('/taxonomies/service-eligibilities')
            ->operations(
                IndexTaxonomyServiceEligibilityOperation::create()
            );
    }
}
