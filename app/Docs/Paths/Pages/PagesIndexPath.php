<?php

namespace App\Docs\Paths\Pages;

use App\Docs\Operations\Pages\IndexPageOperation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;

class PagesIndexPath extends PathItem
{
    /**
     * @param string|null $objectId
     * @throws \GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException
     * @return static
     */
    public static function create(string $objectId = null): BaseObject
    {
        return parent::create($objectId)
            ->route('/information-pages/index')
            ->operations(
                IndexPageOperation::create()
                    ->action(IndexPageOperation::ACTION_POST)
                    ->description(
                        <<<'EOT'
This is an alias of `GET /information-pages` which allows all the query string parameters to be passed
as part of the request body.
EOT
                    )
            );
    }
}