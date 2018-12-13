<?php
namespace App\Transformers;

use App\website;
use League\Fractal\TransformerAbstract;

class WebsiteTransformer extends TransformerAbstract{

protected $availableIncludes = ['category'];

    public function transform(Website $website){
        return [
            'id' => (int) $website -> id,
            'url' => $website -> url,
            'user_id' => $website -> user_id,
            'validated' => $website -> validated,
            'category_id' => $website -> category_id,
            'logo' => $website -> logo,
            'big_logo' => $website -> big_logo,
            'description' => $website -> description,
            'age_restrict' => $website -> age_restrict,
            'parent_site_id' => $website -> parent_site_id,
            'language_id' => $website -> language_id,
            'status' => $website -> status,
        ];
    }
    public function includeCategory(Website $website)
    {
        if($website->category != null)
        {
            return $this->item(
                $website->category,
                new CategoryBriefTransformer
                );
        }
    }
}