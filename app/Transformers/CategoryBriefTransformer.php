<?php
namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryBriefTransformer extends TransformerAbstract
{
	protected $availableIncludes = ['branches', 'websites'];

	public function transform(Category $category)
	{
		return[
			'title' => $category->title,
			'id' => $category->id,
			'parent_id' => $category->parent_id,
		];
	}

	public function includeBranches(Category $category)
    {
        if($category->branches != null)
        {
            return $this->collection(
                $category->branches,
                new CategoryBriefTransformer
                );
        }
	}
	
	    public function includeWebsites(Category $category)
    {
        if($category->websites != null)
        {
            return $this->collection(
                $category->websites,
                new WebsiteTransformer
                );
        }
    }
}