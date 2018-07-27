<?php

namespace App\Models\Relationships;

use App\Models\File;
use App\Models\Organisation;
use App\Models\Referral;
use App\Models\ServiceCriterion;
use App\Models\ServiceLocation;
use App\Models\ServiceTaxonomy;
use App\Models\SocialMedia;
use App\Models\Taxonomy;
use App\Models\UsefulInfo;

trait ServiceRelationships
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function logoFile()
    {
        return $this->belongsTo(File::class, 'logo_file_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seoImageFile()
    {
        return $this->belongsTo(File::class, 'seo_image_file_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviceLocations()
    {
        return $this->hasMany(ServiceLocation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function serviceCriterion()
    {
        return $this->hasOne(ServiceCriterion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usefulInfos()
    {
        return $this->hasMany(UsefulInfo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviceTaxonomies()
    {
        return $this->hasMany(ServiceTaxonomy::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomies()
    {
        return $this->belongsToMany(Taxonomy::class, (new ServiceTaxonomy())->getTable());
    }
}