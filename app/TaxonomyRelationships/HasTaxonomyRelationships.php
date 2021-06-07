<?php

namespace App\TaxonomyRelationships;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasTaxonomyRelationships
{
    /**
     * Return the intermediate Taxonomy Relationship for the Model class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxonomyRelationship(): HasMany;

    /**
     * Return the Taxonomy relationship for the Model class.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomies(): BelongsToMany;
}
